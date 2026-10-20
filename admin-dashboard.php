<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AgriLink - Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.1/fonts/remixicon.css" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&family=Montserrat:ital,wght@0,400..900;1,400..900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="admin-dashboard.css">
</head>

<body>

  <div class="dashboard-wrapper">

    <?php require 'admin-sidebar.php'; ?>

    <div class="main-content">

      <div class="topbar">
        <div>
          <h1>My Dashboard</h1>
          <p class="welcome">Welcome, <span>Admin</span></p>
        </div>
        <div class="bell-btn"><i class="ri-notification-3-line"></i></div>
      </div>

      <div class="company-banner">
        <h3>Your Company</h3>
        <p>3 active jobs - 3 employees</p>
      </div>

      <div class="cards-row">

        <div class="card">
          <div class="card-header">
            <h3>My Jobs</h3>
            <a href="admin-jobs.php">Add job +</a>
          </div>

          <div class="list-item">
            <div class="list-icon" style="background: #4a5d34;">
              <i class="ri-seedling-line"></i>
            </div>
            <div>
              <div class="item-title">Crop Management</div>
              <div class="item-sub">Polomolok, South Cotabato</div>
            </div>
          </div>

          <div class="list-item">
            <div class="list-icon" style="background: #7e9460;">
              <i class="ri-truck-line"></i>
            </div>
            <div>
              <div class="item-title">Field Operations Specialist</div>
              <div class="item-sub">Bugo, Cagayan de Oro City</div>
            </div>
          </div>

          <div class="list-item">
            <div class="list-icon" style="background: #98ad7a;">
              <i class="ri-truck-line"></i>
            </div>
            <div>
              <div class="item-title">Crop Hauler Truck Driver</div>
              <div class="item-sub">Barangay Paraiso, Sagay City, Negros Occidental</div>
            </div>
          </div>

        </div>

        <div class="card">
          <div class="card-header">
            <h3>Employees</h3>
          </div>

          <div class="list-item">
            <div class="list-icon" style="background: #4a5d34;">
              <i class="ri-user-line"></i>
            </div>
            <div>
              <div class="item-title">Employee 1</div>
              <div class="item-sub">Crop Management</div>
            </div>
          </div>

          <div class="list-item">
            <div class="list-icon" style="background: #4a5d34;">
              <i class="ri-user-line"></i>
            </div>
            <div>
              <div class="item-title">Employee 2</div>
              <div class="item-sub">Field Operations Specialist</div>
            </div>
          </div>

          <div class="list-item">
            <div class="list-icon" style="background: #4a5d34;">
              <i class="ri-user-line"></i>
            </div>
            <div>
              <div class="item-title">Employee 3</div>
              <div class="item-sub">Crop Hauler Truck Driver</div>
            </div>
          </div>

        </div>

      </div>

    </div>

  </div>

  <?php require 'footer.php'; ?>

</body>

</html>