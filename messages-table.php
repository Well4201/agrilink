<?php

if (!isset($conn) || !($conn instanceof mysqli)) {
    throw new RuntimeException('The messages table requires an active database connection.');
}

$createMessagesTable = "
    CREATE TABLE IF NOT EXISTS messages (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        sender_id BIGINT UNSIGNED NOT NULL,
        receiver_id BIGINT UNSIGNED NOT NULL,
        message TEXT NOT NULL,
        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        INDEX idx_messages_conversation (sender_id, receiver_id, id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
";

if (!$conn->query($createMessagesTable)) {
    throw new RuntimeException('Unable to create the messages table: ' . $conn->error);
}
