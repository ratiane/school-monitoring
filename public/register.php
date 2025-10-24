<?php
require_once __DIR__ . '/../src/db.php';
require_once __DIR__ . '/../src/auth.php';
require_once __DIR__ . '/../src/helpers.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email'] ?? '');
  $pass  = $_POST['password'] ?? '';
  $csrf  = $_POST['csrf'] ?? '';

  if (!check_csrf($csrf)) $errors[] = 'არასწორი CSRF token.';
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'არასწორი ელფოსტა.';
  if (strlen($pass) < 6) $errors[] = 'პაროლი უნდა იყოს მინ. 6 სიმბოლო.';

  if (!$errors) {
    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
      $errors[] = 'ეს ელფოსტა უკვე რეგისტრირებულია.';
    } else {
      $hash = password_hash($pass, PASSWORD_DEFAULT);
      $stmt = $pdo->prepare('INSERT INTO users (email, password_hash) VALUES (?, ?)');
      $stmt->execute([$email, $hash]);
      $_SESSION['flash'] = 'რეგისტრაცია წარმატებულია! ახლა დაელოგინდი.';
      redirect('/login.php');
    }
  }
}
include __DIR__ . '/partials/header.php';
?>
<h1 class="h3">რეგისტრაცია</h1>
<?php foreach ($errors as $err): ?><div class="alert alert-danger"><?php echo e($err); ?></div><?php endforeach; ?>
<form method="post" class="vstack gap-3" style="max-width: 420px;">
  <input type="hidden" name="csrf" value="<?php echo e($csrf); ?>">
  <div>
    <label class="form-label">ელფოსტა</label>
    <input class="form-control" type="email" name="email" required>
  </div>
  <div>
    <label class="form-label">პაროლი</label>
    <input class="form-control" type="password" name="password" required>
  </div>
  <button class="btn btn-primary" type="submit">რეგისტრაცია</button>
</form>
<?php include __DIR__ . '/partials/footer.php';
