<?php
require_once('../config.php');
require_once(BASE_PATH . '/logic/postsLogic.php');
require_once(BASE_PATH . '/logic/auth.php');
$id = $_REQUEST['id'];
likePost($id, getUserId());
echo true;