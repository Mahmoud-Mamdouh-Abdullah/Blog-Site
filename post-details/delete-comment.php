<?php
require_once('../config.php');
require_once(BASE_PATH . '/logic/postsLogic.php');

if(!isset($_REQUEST['id'])) {
    header('Location:' . BASE_URL . 'posts.php');
    die();
}

deleteComment($_REQUEST['id']);
header('Location:' . BASE_URL . 'post-details/post-details.php?id=' . $_REQUEST['post_id']);