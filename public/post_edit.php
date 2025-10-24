<?php
require_once __DIR__ . '/../src/db.php';
require_once __DIR__ . '/../src/auth.php';
require_once __DIR__ . '/../src/helpers.php';
require_auth();

$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare('SELECT * FROM posts WHERE id=? AND user_id=?');
$stmt->execute([$id, current_user_id()]);
$post = $stmt->fetch();
if (!$post) { $_SESSION['flash'] = 'პოსტი არ მოიძებნა.'; redirect('/'); }

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = trim($_POST['title'] ?? '');
  $body  = trim($_POST['body'] ?? '');
  $csrf  = $_POST['csrf'] ?? '';

  if (!check_csrf($csrf)) $errors[] = 'არასწორი CSRF token.';
  if ($title === '') $errors[] = 'სათაური სავალდებულოა.';
  if ($body === '') $errors[] = 'ტექსტი სავალდებულოა.';

  if (!$errors) {
    $stmt = $pdo->prepare('UPDATE posts SET title=?, body=? WHERE id=? AND user_id=?');
    $stmt->execute([$title, $body, $id, current_user_id()]);
    $_SESSION['flash'] = 'პოსტი განახლდა!';
    redirect('/');
  }
}
include __DIR__ . '/partials/header.php';
?>
<h1 class="h3">რედაქტირება</h1>
<?php foreach ($errors as $err): ?><div class="alert alert-danger"><?php echo e($err); ?></div><?php endforeach; ?>
<form method="post" class="vstack gap-3">
  <input type="hidden" name="csrf" value="<?php echo e($csrf); ?>">
  <div>
    <label class="form-label">სათაური</label>
    <input class="form-control" type="text" name="title" value="<?php echo e($post['title']); ?>" required>
  </div>
  <div>
    <label class="form-label">ტექსტი</label>
    <textarea class="form-control" name="body" rows="8" required><?php echo e($post['body']); ?></textarea>
  </div>
  <button class="btn btn-primary" type="submit">შენახვა</button>
</form>
<?php include __DIR__ . '/partials/footer.php';
