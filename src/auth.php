<?php
$config = require __DIR__ . '/../config.php';
session_name($config['app']['session_name']);
session_start();

function current_user_id(): ?int {
  return $_SESSION['user_id'] ?? null;
}

function require_auth(): void {
  if (!current_user_id()) {
    $_SESSION['flash'] = 'გთხოვ, დაელოგინდე.';
    header('Location: /login.php');
    exit;
  }
}

function set_csrf(): string {
  if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
  }
  return $_SESSION['csrf'];
}

function check_csrf(string $token): bool {
  return isset($_SESSION['csrf']) && hash_equals($_SESSION['csrf'], $token);
}
