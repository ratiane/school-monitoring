<?php
require_once __DIR__ . '/../src/db.php';
require_once __DIR__ . '/../src/auth.php';
require_once __DIR__ . '/../src/helpers.php';

$stmt = $pdo->query('SELECT p.*, u.email AS author_email FROM posts p JOIN users u ON u.id=p.user_id ORDER BY p.created_at DESC');
$posts = $stmt->fetchAll();

include __DIR__ . '/partials/header.php';
?>
<?php if (!empty($_SESSION['flash'])): ?>
  <div class="alert alert-info"><?php echo e($_SESSION['flash']); unset($_SESSION['flash']); ?></div>
<?php endif; ?>

<div class="d-flex align-items-center justify-content-between mb-3">
  <h1 class="h3 m-0">პოსტები</h1>
  <?php if (current_user_id()): ?>
    <a class="btn btn-primary" href="/post_create.php">+ ახალი</a>
  <?php endif; ?>
</div>

<?php if (!$posts): ?>
  <div class="text-muted">ჯერ არ არის პოსტები.</div>
<?php else: ?>
  <div class="vstack gap-3">
    <?php foreach ($posts as $post): ?>
      <div class="card">
        <div class="card-body">
          <h2 class="h5 mb-2"><?php echo e($post['title']); ?></h2>
          <div class="text-muted small mb-2">
            ავტორი: <?php echo e($post['author_email']); ?> · <?php echo e($post['created_at']); ?>
          </div>
          <p class="mb-3"><?php echo nl2br(e(mb_strimwidth($post['body'], 0, 400, '…'))); ?></p>
          <div class="d-flex gap-2">
            <a class="btn btn-outline-secondary btn-sm" href="/post_edit.php?id=<?php echo (int)$post['id']; ?>">რედაქტირება</a>
            <form method="post" action="/post_delete.php" onsubmit="return confirm('წავშალოთ?');">
              <input type="hidden" name="id" value="<?php echo (int)$post['id']; ?>">
              <input type="hidden" name="csrf" value="<?php echo e($csrf); ?>">
              <button class="btn btn-outline-danger btn-sm" type="submit">წაშლა</button>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<?php include __DIR__ . '/partials/footer.php';
