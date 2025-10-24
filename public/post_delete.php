<?php
require_once __DIR__ . '/../src/db.php';
require_once __DIR__ . '/../src/auth.php';
require_once __DIR__ . '/../src/helpers.php';
require_auth();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = (int)($_POST['id'] ?? 0);
  $csrf = $_POST['csrf'] ?? '';
  if (!check_csrf($csrf)) { $_SESSION['flash'] = 'CSRF შეცდომა.'; redirect('/'); }

  $stmt = $pdo->prepare('DELETE FROM posts WHERE id=? AND user_id=?');
  $stmt->execute([$id, current_user_id()]);
  $_SESSION['flash'] = 'პოსტი წაიშალა (ან უკვე წაშლილი იყო).';
}
redirect('/');
