<?php
require_once('../config.php');
require_once(BASE_PATH . '/logic/postsLogic.php');
require_once(BASE_PATH . '/logic/auth.php');
$id = $_REQUEST['id'];
if(getUserId() == 0) {
    header('Location:' . BASE_PATH . 'login.php');
    die();
}
likeComment($id, getUserId());
echo true;