<?php
session_start();
require_once 'koneksi.php';
require_once 'models/Users.php';

$username = $_POST['username'];
$password = $_POST['password'];

$obj = new Users();
$data = [$username, $password];

$user = $obj->cekLogin($data);

if($user){
    $_SESSION['user'] = $user['username'];
    header("Location: index.php");
    exit;
} else {
    // 🔥 redirect ke login dengan pesan error
    header("Location: index.php?hal=login&error=1");
    exit;
}