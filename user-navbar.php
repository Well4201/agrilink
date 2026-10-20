<link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.1/fonts/remixicon.css" rel="stylesheet">
<link
  href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&family=Montserrat:ital,wght@0,400..900;1,400..900&display=swap"
  rel="stylesheet">
<link rel="stylesheet" href="user-navbar.css">

<?php
$currentPage = basename($_SERVER['PHP_SELF'] ?? '');

$nav = [
  'home' => ['Home', 'user-dashboard.php'],
  'jobs' => ['Jobs', 'user-jobs.php'],
  'messages' => ['Messages', 'user-messages.php'],
  'profile' => ['Profile', 'profile.php'],
];

$icons = [
  'home' => 'ri-home-2-line',
  'jobs' => 'ri-briefcase-2-line',
  'messages' => 'ri-chat-1-line',
  'profile' => 'ri-user-line',
];
?>

<header class="user-navbar">
  <div class="user-navbar-left">
    <a href="user-dashboard.php" class="user-navbar-logo">
      <i class="ri-leaf-line"></i>
    </a>
    <div class="user-navbar-search">
      <i class="ri-search-2-line"></i>
      <input type="text" name="search" placeholder="Search">
    </div>
  </div>

  <nav class="user-navbar-right">
    <?php foreach ($nav as $key => [$label, $href]): ?>
      <a href="<?= $href ?>" class="user-navbar-icon<?= $currentPage === basename($href) ? ' active' : '' ?>"
        title="<?= $label ?>">
        <i class="fa-solid <?= $icons[$key] ?>"></i>
      </a>
    <?php endforeach; ?>
    <!-- <button type="button" class="user-navbar-icon" title="Notifications" aria-label="Notifications">
      <i class="ri-notification-2-line"></i>
    </button> -->
    <a href="logout.php" class="user-navbar-icon" title="Logout" aria-label="Logout">
      <i class="ri-logout-circle-r-line"></i>
    </a>
  </nav>
</header>