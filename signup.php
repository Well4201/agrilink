<?php
session_start();
require 'db.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $first_name = trim($_POST['first_name'] ?? '');
  $last_name = trim($_POST['last_name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $phone = trim($_POST['phone'] ?? '');
  $password = $_POST['password'] ?? '';
  $role = $_POST['role'] ?? 'employee';

  if ($first_name === '' || $last_name === '' || $email === '' || $phone === '' || $password === '') {
    $errors[] = "All fields are required.";
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email address.";
  }
  if (!in_array($role, ['employee', 'employer'], true)) {
    $role = 'employee';
  }
  if (strlen($password) < 6) {
    $errors[] = "Password must be at least 6 characters.";
  }

  if (empty($errors)) {
    $stmt = $conn->prepare("SELECT ID FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
      $errors[] = "An account with that email already exists.";
    }
    $stmt->close();
  }

  if (empty($errors)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare(
      "INSERT INTO users (fname, lname, email, phone, password, role) VALUES (?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("ssssss", $first_name, $last_name, $email, $phone, $hashed_password, $role);

    if ($stmt->execute()) {
      $_SESSION['user_id'] = $stmt->insert_id;
      $_SESSION['fname'] = $first_name;
      $_SESSION['role'] = $role;
      $_SESSION['auth_action'] = 'signup';
      $stmt->close();
      $conn->close();
      $dashboard = ($role === 'employer') ? 'admin-dashboard.php' : 'user-dashboard.php';
      header("Location: $dashboard");
      exit();
    } else {
      $errors[] = "Something went wrong. Please try again.";
    }
    $stmt->close();
  }
}

$conn->close();

$role = isset($_POST['role']) ? $_POST['role'] : (isset($_GET['role']) ? $_GET['role'] : 'employee');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AgriLink - Create Account</title>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.1/fonts/remixicon.css" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&family=Montserrat:ital,wght@0,400..900;1,400..900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="signup.css">

</head>

<body>

  <header>
    <a href="login.php" class="logo-container">
      <div class="logo-icon"><i class="ri-leaf-line"></i></div>
      AgriLink
    </a>
  </header>

  <main class="container">
    <div class="info-section">
      <h1>Create Account</h1>
      <p>to get started now!</p>
    </div>

    <div class="card-section">
      <div class="signup-card">

        <?php if (!empty($errors)): ?>
          <div class="error-box">
            <ul>
              <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>

        <form method="POST" action="signup.php">
          <input type="hidden" name="role" value="<?php echo htmlspecialchars($role); ?>">

          <div class="name-row">
            <div class="input-group">
              <label>First Name</label>
              <div class="input-wrapper">
                <i class="ri-user-line"></i>
                <input type="text" name="first_name" placeholder="John"
                  value="<?php echo htmlspecialchars($_POST['first_name'] ?? ''); ?>" required>
              </div>
            </div>

            <div class="input-group">
              <label>Last Name</label>
              <div class="input-wrapper">
                <i class="ri-user-line"></i>
                <input type="text" name="last_name" placeholder="Doe"
                  value="<?php echo htmlspecialchars($_POST['last_name'] ?? ''); ?>" required>
              </div>
            </div>
          </div>

          <div class="input-group">
            <label>Email</label>
            <div class="input-wrapper">
              <i class="ri-mail-line"></i>
              <input type="email" name="email" placeholder="email@gmail.com"
                value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
            </div>
          </div>

          <div class="input-group">
            <label>Phone Number</label>
            <div class="input-wrapper">
              <i class="ri-phone-line"></i>
              <input type="tel" name="phone" placeholder="09XXXXXXXXX" minlength="11" maxlength="11"
                value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>" required>
            </div>
          </div>

          <div class="input-group">
            <label>Password</label>
            <div class="input-wrapper">
              <i class="ri-lock-line"></i>
              <input type="password" name="password" placeholder="••••••••" required>
            </div>
          </div>

          <button type="submit" class="btn-submit">Sign Up</button>
        </form>

        <div class="divider">— or continue with —</div>

        <div class="social-login">
          <button class="social-btn google" type="button"><i class="ri-google-fill"></i></button>
          <button class="social-btn facebook" type="button"><i class="ri-facebook-fill"></i></i></button>
        </div>

        <div class="login-redirect">
          Already Registered? <a href="login.php">Login here</a>
        </div>
      </div>
    </div>
  </main>

  <?php require 'footer.php'; ?>

</body>

</html>