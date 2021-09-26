<?php 
require_once('../config.php');
require_once(BASE_PATH . '/logic/postsLogic.php');

if(session_status() != PHP_SESSION_ACTIVE || session_status() == PHP_SESSION_DISABLED) {
    session_start();
}

if(!isset($_SESSION['user'])) {
    header('Location:' . BASE_URL . 'login.php');
    die();
}

$res = addComment($_REQUEST['post_id'], $_SESSION['user']['id'], $_REQUEST['message']);
if($res) {
    header('Location:' . BASE_URL . 'post-details/post-details.php?id='. $_REQUEST['post_id']);
}?>