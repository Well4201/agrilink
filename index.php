<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AgriLink - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.1/fonts/remixicon.css" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&family=Montserrat:ital,wght@0,400..900;1,400..900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="indexx.css">
</head>

<body>

  <img src="Lsugarcane.png" alt="" class="side-decor side-decor-left">
  <img src="Rsugarcane.png" alt="" class="side-decor side-decor-right">

  <header>
    <a href="index.php" class="logo-container">
      <div class="logo-icon"><i class="ri-leaf-line"></i></div>
      AgriLink
    </a>
    <div class="auth-buttons">
      <a href="login.php" class="btn btn-login-outline">Login</a>
      <a href="signuprole.php" class="btn btn-signup-solid">Sign Up</a>
    </div>
  </header>

  <main class="hero-section">
    <div class="hero-eyebrow">
      <span>PHILIPPINE AGRICULTURE</span>
    </div>

    <div class="hero-body">
      <div class="hero-content">
        <h1>Where Philippine agriculture finds its workforce.</h1>
        <p>AgriLink connects farms, agribusinesses, and rural workers directly.</p>
      </div>
    </div>

  </main>

  <?php require 'footer.php'; ?>

</body>

</html>