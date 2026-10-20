<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$isEmployer = ($_SESSION['role'] ?? '') === 'employer';
$fname = '';
$lname = '';
$email = '';
$phone = '';

$stmt = $conn->prepare("SELECT fname, lname, email, phone FROM users WHERE ID = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$stmt->bind_result($fname, $lname, $email, $phone);
$stmt->fetch();
$stmt->close();

$fullName = $fname . ' ' . $lname;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriLink - Profile</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.1/fonts/remixicon.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&family=Montserrat:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
    <?php if ($isEmployer): ?>
        <link rel="stylesheet" href="admin-dashboard.css">
    <?php endif; ?>
    <link rel="stylesheet" href="profile.css">
</head>

<body class="profile-page">

    <?php if ($isEmployer): ?>
        <div class="dashboard-wrapper">
            <?php require 'admin-sidebar.php'; ?>
            <main class="main-content">
            <?php else: ?>
                <?php require 'user-navbar.php'; ?>
            <?php endif; ?>

            <div class="grid-container">

                <div class="left-column">
                    <div class="profile-card">
                        <div id="profile-photo" class="pfp" role="img" aria-label="Profile photo placeholder"><i
                                class="ri-user-line"></i></div>
                        <p class="fullName"><?php echo htmlspecialchars($fullName); ?></p>
                        <input type="text" class="profession" id="profession" name="profession"
                            placeholder="Enter your profession here...">

                        <div class="info-container">
                            <input type="text" class="info" name="location"
                                placeholder="Enter your address (e.g. City, Province, Country)">
                            <input type="text" class="info" name="contact"
                                value="<?= htmlspecialchars($phone, ENT_QUOTES, 'UTF-8') ?>"
                                placeholder="Enter your contact details">
                        </div>
                    </div>

                    <div class="bio-card">
                        <h3>About</h3>
                        <input type="text" class="info" name="bio" placeholder="Enter your bio here...">
                    </div>
                </div>

                <div class="settings-container">
                    <ul class="menu-card">
                        <li class="menu-item"><a href="#">Account Settings</a></li>
                        <li class="menu-item"><a href="#">Activity Log</a></li>
                        <li class="menu-item"><a href="#">Help and Support</a></li>
                        <li class="menu-item"><a href="#">Settings and Privacy</a></li>
                        <li class="menu-item"><a href="#">Share my profile</a></li>
                    </ul>

                    <a class="logout-btn" href="logout.php">Log Out</a>
                </div>
            </div>

            <?php if ($isEmployer): ?>
            </main>
        </div>
    <?php endif; ?>

    <?php require 'footer.php'; ?>
</body>

</html>