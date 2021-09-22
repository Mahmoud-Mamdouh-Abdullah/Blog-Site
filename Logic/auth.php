<?php
require_once(BASE_PATH . '/DAL/basic_dal.php');

function tryLogin($username, $password)
{
    $user = getUser($username, $password);
    if ($user != null && $user['active'] == 1) {
        addUserToSession($user);
        return 1;
    }
    if ($user != null && $user['active'] == 0) {
        return 2;
    }
    return 3;
}

function register($data)
{
    $sql = "INSERT INTO users (id,name,username,password,email,phone) values (null, ?, ?, md5(?), ?, ?)";
    return addData($sql, 'sssss', [
        $data['name'],
        $data['username'],
        $data['password'],
        $data['email'],
        $data['phone']
    ], false);
}

function getUser($username, $password)
{
    $sql = "SELECT * FROM users WHERE username=? and password =md5(?) limit 1;";
    return getRow($sql, 'ss', [$username, $password]);
}

function addUserToSession($user)
{
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
    $_SESSION['user'] = $user;
}

function logOut()
{
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
    session_destroy();
    header('Location:' . BASE_URL . '/index.php');
    die();
}

function getUserId()
{
    if (session_status() != PHP_SESSION_ACTIVE) session_start();
    if (isset($_SESSION['user'])) return $_SESSION['user']['id'];
    return 0;
}
