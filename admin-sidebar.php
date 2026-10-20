<link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.1/fonts/remixicon.css" rel="stylesheet">
<link
    href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&family=Montserrat:ital,wght@0,400..900;1,400..900&display=swap"
    rel="stylesheet">
<link rel="stylesheet" href="admin-sidebar.css">

<?php
$currentPage = basename($_SERVER['PHP_SELF'] ?? '');

$nav = [
    'dashboard' => ['My Dashboard', 'admin-dashboard.php'],
    'jobs' => ['Add Jobs', 'admin-jobs.php'],
    'messages' => ['Messages', 'admin-messages.php'],
    'profile' => ['Profile', 'profile.php'],
];

$icons = [
    'dashboard' => 'ri-home-2-line',
    'jobs' => 'ri-briefcase-2-line',
    'messages' => 'ri-chat-1-line',
    'profile' => 'ri-user-line',
];
?>

<aside class="sidebar">
    <div class="sidebar-logo">
        <div class="logo-icon"><i class="ri-leaf-line"></i></div>
        AgriLink
    </div>

    <nav class="sidebar-nav">
        <?php foreach ($nav as $key => [$label, $href]): ?>
            <a href="<?= $href ?>" class="<?= $currentPage === basename($href) ? 'active' : '' ?>">
                <i class="fa-solid <?= $icons[$key] ?>"></i>
                <?= $label ?>
            </a>
        <?php endforeach; ?>
    </nav>

    <div class="sidebar-logout">
        <a href="login.php"><i class="ri-logout-box-line"></i> Logout</a>
    </div>
</aside>