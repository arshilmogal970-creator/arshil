<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function setFlash(string $type, string $message): void {
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function showFlash(): void {
    $flash = $_SESSION['flash'] ?? null;
    if (!$flash) {
        return;
    }
    unset($_SESSION['flash']);
    echo '<div class="alert alert-' . htmlspecialchars($flash['type'], ENT_QUOTES, 'UTF-8') . ' alert-dismissible fade show" role="alert">' . htmlspecialchars($flash['message'], ENT_QUOTES, 'UTF-8') . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}
