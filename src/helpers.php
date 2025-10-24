<?php
function redirect(string $to): void {
  header('Location: ' . $to);
  exit;
}

function e(string $value): string {
  return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
