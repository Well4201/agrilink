<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AgriLink - Select Account Type</title>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.1/fonts/remixicon.css" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&family=Montserrat:ital,wght@0,400..900;1,400..900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="signuprole.css">

</head>

<body>

  <header>
    <a href="index.php" class="logo-container">
      <div class="logo-icon"><i class="ri-leaf-line"></i></div>
      AgriLink
    </a>
  </header>

  <main class="container">
    <div class="info-section">
      <h1>First, tell us<br>who you are.</h1>
      <p>This sets up the right account type, you will not be asked again after signing up.</p>
    </div>

    <div class="card-section">
      <div class="role-card">
        <h2>Sign up as...</h2>

        <a href="signup.php?role=employee" class="btn-role btn-employee">Employee</a>

        <div class="divider">— or —</div>

        <a href="signup.php?role=employer" class="btn-role btn-employer">Employer</a>
      </div>
    </div>
  </main>

  <?php require 'footer.php'; ?>

</body>

</html>