<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function isLoggedIn(): bool
{
    return isset($_SESSION['user_id'])
        && filter_var($_SESSION['user_id'], FILTER_VALIDATE_INT) !== false
        && (int) $_SESSION['user_id'] > 0;
}

function requireLogin(): void
{
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

function requireRole(string $requiredRole): void
{
    requireLogin();

    $roleDashboards = [
        'employer' => 'admin-dashboard.php',
        'employee' => 'user-dashboard.php'
    ];
    $sessionRole = $_SESSION['role'] ?? '';

    if ($sessionRole !== $requiredRole) {
        header('Location: ' . ($roleDashboards[$sessionRole] ?? 'login.php'));
        exit;
    }
}
