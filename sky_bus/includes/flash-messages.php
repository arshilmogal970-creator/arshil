<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function loginUser(array $user): void {
    session_regenerate_id(true);
    $_SESSION['user_id'] = (int) $user['id'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['user_role'] = $user['role'];
    $_SESSION['user_email'] = $user['email'];
}

function logoutUser(): void {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
    session_destroy();
}

function isLoggedIn(): bool {
    return !empty($_SESSION['user_id']);
}

function isAdmin(): bool {
    return !empty($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}

function requireLogin(): void {
    if (!isLoggedIn()) {
        setFlash('danger', 'Please login to continue.');
        redirect(APP_URL . '/auth/login.php');
    }
}

function requireAdmin(): void {
    if (!isAdmin()) {
        setFlash('danger', 'Access denied.');
        redirect(APP_URL . '/admin/login.php');
    }
}
