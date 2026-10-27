<?php
require_once __DIR__ . '/auth.php';
requireRole('employee');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AgriLink - User Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.1/fonts/remixicon.css" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&family=Montserrat:ital,wght@0,400..900;1,400..900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="user-dashboard.css">
</head>

<body>

  <?php require 'user-navbar.php'; ?>

  <div class="dashboard-container">

    <h1>My Dashboard</h1>
    <p class="welcome">Welcome, Jiara Martins</p>

    <div class="dashboard-grid">

      <div class="card summary-card">
        <div class="summary-avatar landscape"></div>
        <div class="summary-info">
          <div class="name">Jiara Martins</div>
          <div class="meta">3 active jobs</div>
          <div class="meta">Your recent activity</div>
        </div>
      </div>

      <div class="card stat-card">
        <div class="stat-number">36</div>
        <div class="stat-label">People viewed your profile in the past day</div>
      </div>

      <div class="card profile-card">
        <div class="profile-cover landscape">
          <div class="profile-avatar landscape"></div>
        </div>
        <h3>Jiara Martins</h3>
        <p class="desc">Description</p>
        <div class="profile-links">
          <a href="#">Profile views</a>
          <a href="#">Saved Items</a>
        </div>
      </div>

      <div class="card links-card">
        <a href="#">Account Settings</a>
        <a href="#">Activity Log</a>
      </div>

      <div class="card jobs-card">
        <div class="card-header">
          <h3>My Jobs</h3>
          <a href="user-jobs.php">See all +</a>
        </div>

        <div class="list-item">
          <div class="list-icon" style="background: #4a5d34;">GF</div>
          <div>
            <div class="item-title">Crop Management</div>
            <div class="item-sub">Polomolok, South Cotabato</div>
          </div>
        </div>

        <div class="list-item">
          <div class="list-icon" style="background: #a9522f;">AC</div>
          <div>
            <div class="item-title">Field Operations Specialist</div>
            <div class="item-sub">Bugo, Cagayan de Oro City</div>
          </div>
        </div>

        <div class="list-item">
          <div class="list-icon" style="background: #4a6f9a;">RT</div>
          <div>
            <div class="item-title">Crop Hauler Truck Driver</div>
            <div class="item-sub">Barangay Paraiso, Sagay City, Negros Occidental</div>
          </div>
        </div>

      </div>

      <div class="card ads-card">
        <div class="card-header">
          <h3>Ads you may be interested in</h3>
        </div>

        <div class="ad-item">
          <div class="ad-thumb"></div>
          <div>
            <div class="ad-title">Power KnapSack Sprayer</div>
            <div class="ad-desc">Suitable for ALL CROPS with a 20L Capacity! Make your work faster and easier and order
              now!</div>
          </div>
        </div>

        <div class="ad-item">
          <div class="ad-thumb"></div>
          <div>
            <div class="ad-title">Activator</div>
            <div class="ad-desc">Don't panic, it's organic! Buy 1 and get 1 free on your first purchase.</div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <?php require 'footer.php'; ?>

</body>

</html>