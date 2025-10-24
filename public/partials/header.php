<?php
require_once __DIR__ . '/../../src/auth.php';
$config = require __DIR__ . '/../../config.php';
$base = rtrim($config['app']['base_url'], '/');
$csrf = set_csrf();
?>
<!doctype html>
<html lang="ka">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Magdoni</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/styles.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary mb-4 shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/">Magdoni</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <?php if (current_user_id()): ?>
          <li class="nav-item"><a class="nav-link" href="/post_create.php">+ ახალი პოსტი</a></li>
          <li class="nav-item"><a class="nav-link" href="/logout.php">გასვლა</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="/login.php">შესვლა</a></li>
          <li class="nav-item"><a class="nav-link" href="/register.php">რეგისტრაცია</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
