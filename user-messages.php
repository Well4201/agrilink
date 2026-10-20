<?php
$expectedRole = 'employee';
$otherRole = 'employer';
$otherLabel = 'Employer';
$messagePage = 'user-messages.php';
require 'messages-controller.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriLink - Messages</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.1/fonts/remixicon.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&family=Montserrat:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="user-messages.css">
</head>

<body>

    <?php require 'user-navbar.php'; ?>

    <div class="dashboard-wrapper">

        <main class="main-content">
            <div class="messages-layout">

                <section class="conversation-list">
                    <div class="list-header">
                        <h1>Messages</h1>
                        <i class="ri-notification-2-fill"></i>
                    </div>

                    <div class="conversations">
                        <?php foreach ($chatUsers as $chatUser): ?>
                            <?php
                            $conversationId = (int) $chatUser['ID'];
                            $conversationName = trim((string) ($chatUser['fname'] ?? '')) ?: $otherLabel . ' #' . $conversationId;
                            $preview = $chatUser['last_message'] ?? '';
                            $isSelected = $selectedChatUser !== null && (int) $selectedChatUser['ID'] === $conversationId;
                            ?>
                            <a class="conversation<?php echo $isSelected ? ' active' : ''; ?>"
                                href="user-messages.php?with=<?php echo $conversationId; ?>">
                                <div class="avatar"><i class="ri-account-circle-fill"></i></div>
                                <div class="conversation-details">
                                    <div class="name"><?php echo $escapeMessageHtml($conversationName); ?></div>
                                    <div class="preview">
                                        <?php if ($preview !== ''): ?>
                                            <?php echo (int) $chatUser['last_sender_id'] === $chatUserId ? 'You: ' : ''; ?>
                                            <?php echo $escapeMessageHtml($preview); ?>
                                        <?php else: ?>
                                            No messages yet
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                        <?php if (count($chatUsers) === 0): ?>
                            <p class="empty-conversations">No employers are available to message.</p>
                        <?php endif; ?>
                    </div>
                </section>

                <section class="chat-panel">
                    <div class="chat-header">
                        <div class="avatar"><i class="ri-account-circle-fill"></i></div>
                        <div class="chat-name">
                            <?php echo $selectedChatUser ? $escapeMessageHtml(trim((string) ($selectedChatUser['fname'] ?? '')) ?: $otherLabel . ' #' . (int) $selectedChatUser['ID']) : 'No conversation'; ?>
                        </div>
                        <button class="chat-menu" aria-label="More options"><i class="ri-more-line"></i></button>
                    </div>

                    <div class="chat-body">
                        <?php if ($messageError !== ''): ?>
                            <div class="message-error" role="alert"><?php echo $escapeMessageHtml($messageError); ?></div>
                        <?php endif; ?>
                        <?php if ($selectedChatUser === null): ?>
                            <div class="chat-intro"><p>Create an employer account to start a conversation.</p></div>
                        <?php elseif (count($chatMessages) === 0): ?>
                            <div class="chat-intro">
                                <div class="avatar"><i class="ri-account-circle-fill"></i></div>
                                <p>Your conversation with <?php echo $escapeMessageHtml(trim((string) ($selectedChatUser['fname'] ?? '')) ?: $otherLabel); ?> starts here.<br>DO NOT SHARE YOUR PASSWORDS WITH ANYONE!</p>
                            </div>
                        <?php endif; ?>
                        <?php foreach ($chatMessages as $chatMessage): ?>
                            <?php $isSender = (int) $chatMessage['sender_id'] === $chatUserId; ?>
                            <div class="message <?php echo $isSender ? 'sender' : 'receiver'; ?>">
                                <?php if (!$isSender): ?>
                                    <div class="avatar"><i class="ri-account-circle-fill"></i></div>
                                <?php endif; ?>
                                <div class="bubble"><?php echo nl2br($escapeMessageHtml($chatMessage['message'])); ?></div>
                                <form class="message-actions" method="post" action="user-messages.php?with=<?php echo (int) $selectedChatUser['ID']; ?>">
                                    <input type="hidden" name="csrf_token" value="<?php echo $escapeMessageHtml($_SESSION['messages_csrf_token']); ?>">
                                    <input type="hidden" name="with" value="<?php echo (int) $selectedChatUser['ID']; ?>">
                                    <input type="hidden" name="message_id" value="<?php echo (int) $chatMessage['id']; ?>">
                                    <input type="hidden" name="action" value="delete">
                                    <button type="submit" class="delete-message" aria-label="Delete message" title="Delete message">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </form>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if ($selectedChatUser !== null): ?>
                        <form class="chat-input" method="post" action="user-messages.php?with=<?php echo (int) $selectedChatUser['ID']; ?>">
                            <input type="hidden" name="csrf_token" value="<?php echo $escapeMessageHtml($_SESSION['messages_csrf_token']); ?>">
                            <input type="hidden" name="with" value="<?php echo (int) $selectedChatUser['ID']; ?>">
                            <input type="hidden" name="action" value="send">
                            <input type="text" name="message" placeholder="Write a message..." maxlength="2000" required aria-label="Message">
                            <button class="send-btn" type="submit" aria-label="Send message"><i class="ri-send-ins-fill"></i></button>
                        </form>
                    <?php endif; ?>
                </section>

            </div>
        </main>
    </div>

    <?php require 'footer.php'; ?>
</body>

</html>