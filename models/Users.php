<?php
require_once __DIR__ . '/../koneksi.php';

class Users
{
    public function cekLogin($data)
    {
        global $dbh;

        [$username, $password] = $data;

        $stmt = $dbh->prepare('SELECT * FROM users WHERE username = ? LIMIT 1');
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return false;
        }

        $storedPassword = $user['password'] ?? '';

        if (password_verify($password, $storedPassword) || $storedPassword === $password) {
            return $user;
        }

        return false;
    }
}
