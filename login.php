<?php
session_start();
require 'db.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = trim($_POST['email'] ?? '');
  $password = $_POST['password'] ?? '';
  $role = $_POST['role'] ?? '';

  if ($email === '' || $password === '') {
    $error = "Please enter both email/phone and password.";
  } else {
    $stmt = $conn->prepare("SELECT ID, fname, password, role FROM users WHERE email = ? OR phone = ?");
    $stmt->bind_param("ss", $email, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
      $user = $result->fetch_assoc();

      if (password_verify($password, $user['password'])) {
        if ($user['role'] !== $role) {
          $error = "That account isn't registered as a(n) " . htmlspecialchars($role) . ".";
        } else {
          $_SESSION['user_id'] = $user['ID'];
          $_SESSION['fname'] = $user['fname'];
          $_SESSION['role'] = $user['role'];
          $_SESSION['auth_action'] = 'login';

          $stmt->close();
          $conn->close();
          $dashboard = ($user['role'] === 'employer') ? 'admin-dashboard.php' : 'user-dashboard.php';
          header("Location: $dashboard");
          exit();
        }
      } else {
        $error = "Incorrect email/phone or password.";
      }
    } else {
      $error = "Incorrect email/phone or password.";
    }
    $stmt->close();
  }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AgriLink - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.1/fonts/remixicon.css" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&family=Montserrat:ital,wght@0,400..900;1,400..900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="login.css">

</head>

<body>

  <header>
    <a href="index.php" class="logo-container">
      <div class="logo-icon"><i class="ri-leaf-line"></i></div>
      AgriLink
    </a>
  </header>

  <div class="login-container">
    <div class="login-card">
      <h2>Welcome,<br>Glad to see you!</h2>
      <div class="subtitle">New Here? <a href="signuprole.php">Sign Up</a></div>

      <?php if ($error): ?>
        <div class="error-box"><?php echo htmlspecialchars($error); ?></div>
      <?php endif; ?>

      <form id="loginForm" method="POST" action="login.php">
        <div class="input-group">
          <label>Email</label>
          <div class="input-wrapper">
            <i class="ri-mail-line"></i>
            <input type="text" name="email" placeholder="email@gmail.com"
              value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
          </div>
        </div>

        <div class="input-group">
          <label>Password</label>
          <div class="input-wrapper">
            <i class="ri-lock-line"></i>
            <input type="password" name="password" placeholder="••••••••" required>
          </div>
        </div>

        <div class="login-options">
          <label>
            <input type="checkbox" name="remember"> Remember me
          </label>
          <a href="#">Forgot Password?</a>
        </div>

        <button type="submit" name="role" value="employee" class="btn-submit btn-employee">Login as Employee</button>
        <button type="submit" name="role" value="employer" class="btn-submit btn-employer">Login as Employer</button>
      </form>

      <div class="divider">or continue with</div>

      <div class="social-login">
        <button class="social-btn google"><i class="ri-google-fill"></i></button>
        <button class="social-btn facebook"><i class="ri-facebook-fill"></i></button>
      </div>

      <div class="terms">
        By logging in, you agree to our<br>
        <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
      </div>
    </div>
  </div>

  <?php require 'footer.php'; ?>

</body>

</html>