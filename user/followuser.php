<?php
require_once('../config.php');
require_once(BASE_PATH . '/logic/users.php');
if (session_status() != PHP_SESSION_ACTIVE || session_status() == PHP_SESSION_DISABLED) {
    session_start();
}

if(!isset($_SESSION['user'])) {
    header('Location:' . BASE_URL . 'login.php');
    die();
}

if(!isset($_REQUEST['follower_id'])) {
    header('Location:' . BASE_URL . 'index.php');
    die();
}

$state = followUser($_REQUEST['following_id'], $_REQUEST['follower_id']);
header('Location:' . BASE_URL . 'user/user-details.php?user_id=' . $_REQUEST['following_id']);