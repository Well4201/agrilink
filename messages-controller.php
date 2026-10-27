<?php
require_once __DIR__ . '/auth.php';

requireRole($expectedRole);

require 'db.php';
require 'messages-table.php';

$chatUserId = (int) $_SESSION['user_id'];
$messageError = '';
$chatMessages = [];
$selectedChatUser = null;

if (empty($_SESSION['messages_csrf_token'])) {
    $_SESSION['messages_csrf_token'] = bin2hex(random_bytes(32));
}

$chatUsersStatement = $conn->prepare(
    "SELECT u.ID, u.fname,
        (SELECT m.message
         FROM messages m
         WHERE (m.sender_id = ? AND m.receiver_id = u.ID)
            OR (m.sender_id = u.ID AND m.receiver_id = ?)
         ORDER BY m.id DESC
         LIMIT 1) AS last_message,
        (SELECT m.sender_id
         FROM messages m
         WHERE (m.sender_id = ? AND m.receiver_id = u.ID)
            OR (m.sender_id = u.ID AND m.receiver_id = ?)
         ORDER BY m.id DESC
         LIMIT 1) AS last_sender_id
     FROM users u
     WHERE u.role = ? AND u.ID <> ?
     ORDER BY u.ID"
);
$chatUsersStatement->bind_param(
    'iiiisi',
    $chatUserId,
    $chatUserId,
    $chatUserId,
    $chatUserId,
    $otherRole,
    $chatUserId
);
$chatUsersStatement->execute();
$chatUsersResult = $chatUsersStatement->get_result();
$chatUsers = $chatUsersResult->fetch_all(MYSQLI_ASSOC);
$chatUsersStatement->close();

$requestedChatUserId = filter_input(INPUT_GET, 'with', FILTER_VALIDATE_INT);
if ($requestedChatUserId === false || $requestedChatUserId === null) {
    $requestedChatUserId = 0;
}

foreach ($chatUsers as $chatUser) {
    if ((int) $chatUser['ID'] === (int) $requestedChatUserId) {
        $selectedChatUser = $chatUser;
        break;
    }
}

if ($selectedChatUser === null && count($chatUsers) > 0) {
    $selectedChatUser = $chatUsers[0];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postedToken = $_POST['csrf_token'] ?? '';
    $postedChatUserId = filter_input(INPUT_POST, 'with', FILTER_VALIDATE_INT);

    if (!is_string($postedToken) || !hash_equals($_SESSION['messages_csrf_token'], $postedToken)) {
        $messageError = 'Your session token expired. Refresh the page and try again.';
    } elseif ($postedChatUserId === false || $postedChatUserId === null) {
        $messageError = 'Choose a valid conversation before sending or deleting a message.';
    } else {
        $isValidChatUser = false;
        foreach ($chatUsers as $chatUser) {
            if ((int) $chatUser['ID'] === (int) $postedChatUserId) {
                $selectedChatUser = $chatUser;
                $isValidChatUser = true;
                break;
            }
        }

        if (!$isValidChatUser) {
            $messageError = 'That conversation is not available.';
        } else {
            try {
                if (($_POST['action'] ?? '') === 'send') {
                    $rawMessageText = $_POST['message'] ?? '';
                    if (!is_string($rawMessageText)) {
                        $messageError = 'Enter a valid text message.';
                    } else {
                        $messageText = trim($rawMessageText);
                        if ($messageText === '') {
                            $messageError = 'Enter a message before sending.';
                        } elseif (mb_strlen($messageText, 'UTF-8') > 2000) {
                            $messageError = 'Messages must be 2000 characters or fewer.';
                        } else {
                            $insertStatement = $conn->prepare(
                                'INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)'
                            );
                            $receiverId = (int) $selectedChatUser['ID'];
                            $insertStatement->bind_param('iis', $chatUserId, $receiverId, $messageText);
                            $insertStatement->execute();
                            $insertStatement->close();
                        }
                    }
                } elseif (($_POST['action'] ?? '') === 'delete') {
                    $messageId = filter_input(INPUT_POST, 'message_id', FILTER_VALIDATE_INT);
                    if ($messageId === false || $messageId === null || $messageId < 1) {
                        $messageError = 'Choose a valid message to delete.';
                    } else {
                        $receiverId = (int) $selectedChatUser['ID'];
                        $deleteStatement = $conn->prepare(
                            'DELETE FROM messages
                             WHERE id = ?
                               AND ((sender_id = ? AND receiver_id = ?)
                                 OR (sender_id = ? AND receiver_id = ?))'
                        );
                        $deleteStatement->bind_param(
                            'iiiii',
                            $messageId,
                            $chatUserId,
                            $receiverId,
                            $receiverId,
                            $chatUserId
                        );
                        $deleteStatement->execute();
                        if ($deleteStatement->affected_rows !== 1) {
                            $messageError = 'That message could not be found in this conversation.';
                        }
                        $deleteStatement->close();
                    }
                } else {
                    $messageError = 'Choose a valid message action.';
                }
            } catch (mysqli_sql_exception $exception) {
                error_log('Message action failed: ' . $exception->getMessage());
                $messageError = 'The message could not be saved. Please try again.';
            }
        }
    }

    if ($messageError === '') {
        header('Location: ' . $messagePage . '?with=' . (int) $selectedChatUser['ID']);
        exit;
    }
}

if ($selectedChatUser !== null) {
    $receiverId = (int) $selectedChatUser['ID'];
    $messagesStatement = $conn->prepare(
        'SELECT id, sender_id, receiver_id, message, created_at
         FROM messages
         WHERE (sender_id = ? AND receiver_id = ?)
            OR (sender_id = ? AND receiver_id = ?)
         ORDER BY id'
    );
    $messagesStatement->bind_param('iiii', $chatUserId, $receiverId, $receiverId, $chatUserId);
    $messagesStatement->execute();
    $messagesResult = $messagesStatement->get_result();
    $chatMessages = $messagesResult->fetch_all(MYSQLI_ASSOC);
    $messagesStatement->close();
}

$escapeMessageHtml = static function ($value): string {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};
