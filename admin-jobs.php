<?php
require_once __DIR__ . '/auth.php';
requireRole('employer');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AgriLink - Manage Jobs</title>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.1/fonts/remixicon.css" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&family=Montserrat:ital,wght@0,400..900;1,400..900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="admin-dashboard.css">
  <link rel="stylesheet" href="admin-jobs.css">
</head>

<body>

  <div class="dashboard-wrapper">

    <?php require 'admin-sidebar.php'; ?>

    <div class="main-content">

      <div class="jobs-page">

        <div class="jobs-topbar">
          <div class="search-box">
            <i class="ri-search-line"></i>
            <input type="text" placeholder="Search" aria-label="Search jobs">
          </div>
          <button type="button" class="bell-btn" aria-label="Notifications" title="Notifications"><i
              class="ri-notification-3-line"></i></button>
        </div>

        <div class="jobs-heading">
          <h1>Manage Jobs</h1>
          <p>View, edit, approve or delete job posting</p>
        </div>

        <div class="jobs-toolbar">
          <div class="filter-tabs">
            <a href="#" class="filter-tab active-tab">All jobs <span class="count count-solid">12</span></a>
            <a href="#" class="filter-tab">Active <span class="count">7</span></a>
            <a href="#" class="filter-tab">Pending <span class="count">7</span></a>
            <a href="#" class="filter-tab">Closed <span class="count">7</span></a>
          </div>

          <a href="#" class="btn-add-job"><i class="ri-add-line"></i> Add new jobs</a>
        </div>

        <div class="jobs-table-card">
          <table class="jobs-table">
            <thead>
              <tr>
                <th>Job Title</th>
                <th>Company</th>
                <th>Location</th>
                <th>Date Posted</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>

              <tr>
                <td>
                  <div class="job-cell">
                    <div class="company-logo"><i class="ri-seedling-line"></i></div>
                    <span>Crop Management Specialist</span>
                  </div>
                </td>
                <td>Dole Philippines</td>
                <td><i class="ri-map-pin-line"></i> Polomolok</td>
                <td>May 20, 2026</td>
                <td><span class="badge badge-active">Active</span></td>
                <td>
                  <div class="actions">
                    <a href="#" class="action-btn" title="View"><i class="ri-eye-line"></i></a>
                    <a href="#" class="action-btn" title="Edit"><i class="ri-edit-line"></i></a>
                    <a href="#" class="action-btn" title="Delete"><i class="ri-delete-bin-line"></i></a>
                  </div>
                </td>
              </tr>

              <tr>
                <td>
                  <div class="job-cell">
                    <div class="company-logo"><i class="ri-truck-line"></i></div>
                    <span>Field Operation Specialist</span>
                  </div>
                </td>
                <td>Del Monte Philippines</td>
                <td><i class="ri-map-pin-line"></i> Cagayan de Oro City</td>
                <td>August 23, 2026</td>
                <td><span class="badge badge-pending">Pending</span></td>
                <td>
                  <div class="actions">
                    <a href="#" class="action-btn" title="View"><i class="ri-eye-line"></i></a>
                    <a href="#" class="action-btn" title="Edit"><i class="ri-edit-line"></i></a>
                    <a href="#" class="action-btn" title="Delete"><i class="ri-delete-bin-line"></i></a>
                  </div>
                </td>
              </tr>

              <tr>
                <td>
                  <div class="job-cell">
                    <div class="company-logo"><i class="ri-truck-line"></i></div>
                    <span>Crop Hauler Truck Driver</span>
                  </div>
                </td>
                <td>Lopez Sugar Corporation</td>
                <td><i class="ri-map-pin-line"></i> Barangay Paraiso, Cadiz City, Negros Occidental</td>
                <td>August 2, 2026</td>
                <td><span class="badge badge-active">Active</span></td>
                <td>
                  <div class="actions">
                    <a href="#" class="action-btn" title="View"><i class="ri-eye-line"></i></a>
                    <a href="#" class="action-btn" title="Edit"><i class="ri-edit-line"></i></a>
                    <a href="#" class="action-btn" title="Delete"><i class="ri-delete-bin-line"></i></a>
                  </div>
                </td>
              </tr>

              <tr>
                <td>
                  <div class="job-cell">
                    <div class="company-logo"><i class="ri-drop-line"></i></div>
                    <span>Irrigation Technician</span>
                  </div>
                </td>
                <td>Green Fields Agri Corp</td>
                <td><i class="ri-map-pin-line"></i> San Carlos City, Negros Occidental</td>
                <td>August 2, 2026</td>
                <td><span class="badge badge-closed">Closed</span></td>
                <td>
                  <div class="actions">
                    <a href="#" class="action-btn" title="View"><i class="ri-eye-line"></i></a>
                    <a href="#" class="action-btn" title="Edit"><i class="ri-edit-line"></i></a>
                    <a href="#" class="action-btn" title="Delete"><i class="ri-delete-bin-line"></i></a>
                  </div>
                </td>
              </tr>

              <tr>
                <td>
                  <div class="job-cell">
                    <div class="company-logo"><i class="ri-settings-5-line"></i></div>
                    <span>Farm Equipment Operator</span>
                  </div>
                </td>
                <td>Sweet Harvest Farms</td>
                <td><i class="ri-map-pin-line"></i> La Carlota City, Negros Occidental</td>
                <td>May 10, 2026</td>
                <td><span class="badge badge-active">Active</span></td>
                <td>
                  <div class="actions">
                    <a href="#" class="action-btn" title="View"><i class="ri-eye-line"></i></a>
                    <a href="#" class="action-btn" title="Edit"><i class="ri-edit-line"></i></a>
                    <a href="#" class="action-btn" title="Delete"><i class="ri-delete-bin-line"></i></a>
                  </div>
                </td>
              </tr>

              <tr>
                <td>
                  <div class="job-cell">
                    <div class="company-logo"><i class="ri-clipboard-line"></i></div>
                    <span>Quality Assurance Officer</span>
                  </div>
                </td>
                <td>Agri Best Solutions</td>
                <td><i class="ri-map-pin-line"></i> Bacolod City, Negros Occidental</td>
                <td>May 6, 2026</td>
                <td><span class="badge badge-pending">Pending</span></td>
                <td>
                  <div class="actions">
                    <a href="#" class="action-btn" title="View"><i class="ri-eye-line"></i></a>
                    <a href="#" class="action-btn" title="Edit"><i class="ri-edit-line"></i></a>
                    <a href="#" class="action-btn" title="Delete"><i class="ri-delete-bin-line"></i></a>
                  </div>
                </td>
              </tr>

            </tbody>
          </table>

          <div class="table-footer">
            <span>Showing 1 to 6 of 12 jobs</span>
            <div class="pagination">
              <a href="#" class="page-btn" aria-label="Previous page"><i class="ri-arrow-left-s-line"></i></a>
              <a href="#" class="page-btn page-current">1</a>
              <a href="#" class="page-btn">2</a>
              <a href="#" class="page-btn" aria-label="Next page"><i class="ri-arrow-right-s-line"></i></a>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <?php require 'footer.php'; ?>

</body>

</html>