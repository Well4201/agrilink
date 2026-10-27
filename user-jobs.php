<?php
require_once __DIR__ . '/auth.php';
requireRole('employee');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AgriLink - Available Jobs</title>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.1/fonts/remixicon.css" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&family=Montserrat:ital,wght@0,400..900;1,400..900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="admin-dashboard.css">
  <link rel="stylesheet" href="user-jobs.css">
</head>

<body>

  <?php require 'user-navbar.php'; ?>

  <div class="uj-page">

    <div class="uj-header">
      <div class="uj-heading">
        <h1>Available Jobs</h1>
        <p>Browse and apply for job opportunities</p>
      </div>
      <button type="button" class="bell-btn" aria-label="Notifications" title="Notifications"><i
          class="ri-notification-2-line"></i></button>
    </div>

    <div class="uj-filters">
      <div class="uj-search">
        <i class="ri-search-2-line"></i>
        <input type="text" placeholder="Search jobs, company, or keywords..." aria-label="Search jobs">
      </div>

      <div class="uj-select">
        <select aria-label="Category">
          <option>All Categories</option>
          <option>Crop Management</option>
          <option>Field Operations</option>
          <option>Transport</option>
        </select>
        <i class="ri-arrow-down-s-line"></i>
      </div>

      <div class="uj-select">
        <select aria-label="Location">
          <option>All Location</option>
          <option>Polomolok</option>
          <option>Cagayan de Oro City</option>
          <option>Cadiz City</option>
        </select>
        <i class="ri-arrow-down-s-line"></i>
      </div>

      <a href="#" class="uj-filter-btn"><i class="ri-filter-line"></i>Filter</a>
    </div>

    <div class="uj-list">

      <article class="uj-card">
        <div class="uj-logo"><span>Dole</span></div>

        <div class="uj-info">
          <h2>Crop Management Specialist</h2>
          <p class="uj-company">Dole Philippines</p>
          <p class="uj-meta">
            <span>Full-time</span>
            <span class="uj-sep">:</span>
            <span><i class="ri-map-pin-line"></i> Polomolok, South Cotabato</span>
            <span class="uj-posted">Posted May 20, 2026</span>
          </p>
          <p class="uj-desc">Responsible for overseeing crop production, monitoring plant health and ensuring
            high-quality yield through proper agricultural practices.</p>
        </div>

        <div class="uj-actions">
          <a href="#" class="uj-view-btn">View Details</a>
          <a href="#" class="uj-bookmark" aria-label="Save job"><i class="ri-bookmark-line"></i></a>
        </div>
      </article>

      <article class="uj-card">
        <div class="uj-logo"><span>Del Monte</span></div>

        <div class="uj-info">
          <h2>Field Operation Specialist</h2>
          <p class="uj-company">Del Monte Philippines</p>
          <p class="uj-meta">
            <span>Full-time</span>
            <span class="uj-sep">:</span>
            <span><i class="ri-map-pin-line"></i> Cagayan de Oro City</span>
            <span class="uj-posted">Posted May 10, 2026</span>
          </p>
          <p class="uj-desc">Supervise daily field operations including planting, fertilizing and harvesting activities
            to ensure productivity and safety.</p>
        </div>

        <div class="uj-actions">
          <a href="#" class="uj-view-btn">View Details</a>
          <a href="#" class="uj-bookmark" aria-label="Save job"><i class="ri-bookmark-line"></i></a>
        </div>
      </article>

      <article class="uj-card">
        <div class="uj-logo"><span>Lopez Sugar</span></div>

        <div class="uj-info">
          <h2>Crop Hauler Truck Driver</h2>
          <p class="uj-company">Lopez Sugar Corporation</p>
          <p class="uj-meta">
            <span>Full-time</span>
            <span class="uj-sep">:</span>
            <span><i class="ri-map-pin-line"></i> Barangay Paraiso, Cadiz City, Negros Occidental</span>
            <span class="uj-posted">Posted May 16, 2026</span>
          </p>
          <p class="uj-desc">Transport harvested crops safely and efficiently to designated locations following company
            policies.</p>
        </div>

        <div class="uj-actions">
          <a href="#" class="uj-view-btn">View Details</a>
          <a href="#" class="uj-bookmark" aria-label="Save job"><i class="ri-bookmark-line"></i></a>
        </div>
      </article>

    </div>

    <div class="uj-footer">
      <span>Showing 1 to 3 of 15 jobs</span>
      <div class="uj-pagination">
        <a href="#" class="uj-page-btn" aria-label="Previous page"><i class="ri-arrow-left-s-line"></i></a>
        <a href="#" class="uj-page-btn uj-current">1</a>
        <a href="#" class="uj-page-btn">2</a>
        <a href="#" class="uj-page-btn">3</a>
        <span class="uj-page-btn uj-dots">...</span>
        <a href="#" class="uj-page-btn">5</a>
        <a href="#" class="uj-page-btn" aria-label="Next page"><i class="ri-arrow-right-s-line"></i></a>
      </div>
    </div>

  </div>

  <?php require 'footer.php'; ?>

</body>

</html>