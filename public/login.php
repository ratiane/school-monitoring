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

  if (!$errors) {
    $stmt = $pdo->prepare('SELECT id, password_hash FROM users WHERE email=? LIMIT 1');
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user && password_verify($pass, $user['password_hash'])) {
      $_SESSION['user_id'] = (int)$user['id'];
      $_SESSION['flash'] = 'მოგესალმები!';
      redirect('/');
    } else {
      $errors[] = 'ელფოსტა ან პაროლი არასწორია.';
    }
  }
}
include __DIR__ . '/partials/header.php';
?>
<h1 class="h3">შესვლა</h1>
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
  <button class="btn btn-primary" type="submit">შესვლა</button>
</form>
<?php include __DIR__ . '/partials/footer.php';
