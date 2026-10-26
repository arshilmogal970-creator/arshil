<?php
session_start();

define('APP_NAME', 'SKY BUS');
define('APP_URL', 'http://localhost/sky_bus');
define('BASE_PATH', __DIR__ . '/..');

define('UPLOAD_PATH', BASE_PATH . '/storage');

function db(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $config = require __DIR__ . '/config/app.php';
        $db = $config['db'];
        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', $db['host'], $db['name'], $db['charset']);
        $pdo = new PDO($dsn, $db['user'], $db['pass'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    }
    return $pdo;
}

function e(string $value): string {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function redirect(string $path): void {
    header('Location: ' . $path);
    exit;
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

function currentUser(): ?array {
    if (empty($_SESSION['user_id'])) {
        return null;
    }
    return db()->prepare('SELECT * FROM users WHERE id = :id LIMIT 1')->execute(['id' => $_SESSION['user_id']]) ? null : null;
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
        setFlash('danger', 'Unauthorized access.');
        redirect(APP_URL . '/admin/login.php');
    }
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
    if (empty($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'] ?? '', $_POST['csrf_token'])) {
        http_response_code(419);
        setFlash('danger', 'Security validation failed. Please try again.');
        redirect(APP_URL . $_SERVER['REQUEST_URI']);
    }
}

function formatMoney($amount): string {
    return '₹' . number_format((float) $amount, 2);
}

function generatePnr(): string {
    do {
        $code = 'SB' . strtoupper(bin2hex(random_bytes(3)));
        $stmt = db()->prepare('SELECT id FROM bookings WHERE pnr = :pnr LIMIT 1');
        $stmt->execute([':pnr' => $code]);
    } while ($stmt->fetch());
    return $code;
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

function safeDate(string $date): string {
    return $date ? date('d M Y', strtotime($date)) : 'N/A';
}

function safeTime(string $time): string {
    return $time ? date('h:i A', strtotime('2000-01-01 ' . $time)) : 'N/A';
}

function getCityMap(): array {
    $stmt = db()->query('SELECT id, name FROM cities ORDER BY name');
    $rows = $stmt->fetchAll();
    $map = [];
    foreach ($rows as $row) {
        $map[(int)$row['id']] = $row['name'];
    }
    return $map;
}

function getOperatorMap(): array {
    $stmt = db()->query('SELECT id, name FROM bus_operators ORDER BY name');
    $rows = $stmt->fetchAll();
    $map = [];
    foreach ($rows as $row) {
        $map[(int)$row['id']] = $row['name'];
    }
    return $map;
}

function getRouteName(int $routeId): string {
    $stmt = db()->prepare('SELECT CONCAT(c1.name, " -> ", c2.name) AS route_name FROM routes r JOIN cities c1 ON c1.id = r.source_city_id JOIN cities c2 ON c2.id = r.destination_city_id WHERE r.id = :id');
    $stmt->execute([':id' => $routeId]);
    $row = $stmt->fetch();
    return $row['route_name'] ?? 'Unknown';
}

function showFlash(): void {
    $flash = getFlash();
    if (!$flash) {
        return;
    }
    echo '<div class="alert alert-' . e($flash['type']) . ' alert-dismissible fade show" role="alert">' . e($flash['message']) . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}

function paginatedQuery(string $sql, array $params = [], int $page = 1, int $perPage = 10): array {
    $offset = ($page - 1) * $perPage;
    $stmt = db()->prepare($sql . ' LIMIT :limit OFFSET :offset');
    foreach ($params as $key => $value) {
        $stmt->bindValue(':' . $key, $value);
    }
    $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll();
    $countStmt = db()->prepare(str_replace('SELECT *', 'SELECT COUNT(*) as total', $sql));
    foreach ($params as $key => $value) {
        $countStmt->bindValue(':' . $key, $value);
    }
    $countStmt->execute();
    $count = $countStmt->fetch()['total'] ?? 0;
    return ['rows' => $rows, 'total' => $count];
}
