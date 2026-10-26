<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function getCurrentUser(): ?array {
    if (empty($_SESSION['user_id'])) {
        return null;
    }
    $stmt = db()->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
    $stmt->execute([':id' => $_SESSION['user_id']]);
    $user = $stmt->fetch();
    return $user ?: null;
}

function isUserLoggedIn(): bool {
    return !empty($_SESSION['user_id']);
}

function isAdminLoggedIn(): bool {
    return !empty($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}

function requireUserLogin(): void {
    if (!isUserLoggedIn()) {
        setFlash('danger', 'Please login to continue.');
        redirect(APP_URL . '/auth/login.php');
    }
}

function requireAdminLogin(): void {
    if (!isAdminLoggedIn()) {
        setFlash('danger', 'Unauthorized access.');
        redirect(APP_URL . '/admin/login.php');
    }
}

function setFlash(string $type, string $message): void {
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function getFlash(): ?array {
    if (!isset($_SESSION['flash'])) {
        return null;
    }
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $flash;
}

function csrfToken(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrfField(): string {
    return '<input type="hidden" name="csrf_token" value="' . e(csrfToken()) . '">';
}

function verifyCsrf(): void {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return;
    }
    $token = $_POST['csrf_token'] ?? '';
    if (!hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
        http_response_code(419);
        setFlash('danger', 'Invalid form submission.');
        redirect(APP_URL . $_SERVER['REQUEST_URI']);
    }
}

function e(string $value): string {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function redirect(string $url): void {
    header('Location: ' . $url);
    exit;
}

function formatMoney(float $amount): string {
    return '₹' . number_format($amount, 2);
}

function generatePnr(): string {
    do {
        $pnr = 'SB' . strtoupper(bin2hex(random_bytes(4)));
        $stmt = db()->prepare('SELECT id FROM bookings WHERE pnr = :pnr LIMIT 1');
        $stmt->execute([':pnr' => $pnr]);
    } while ($stmt->fetch());
    return $pnr;
}

function createNotification(int $userId, string $title, string $message, string $type = 'info'): void {
    $stmt = db()->prepare('INSERT INTO notifications (user_id, title, message, type, is_read, created_at) VALUES (:user_id, :title, :message, :type, 0, NOW())');
    $stmt->execute([
        ':user_id' => $userId,
        ':title' => $title,
        ':message' => $message,
        ':type' => $type,
    ]);
}

function getCityOptions(): array {
    $stmt = db()->query('SELECT id, name FROM cities WHERE is_active = 1 ORDER BY name');
    return $stmt->fetchAll();
}
