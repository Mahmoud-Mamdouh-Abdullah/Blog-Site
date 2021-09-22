<?php
require_once('../config.php');
require_once(BASE_PATH . '/logic/users.php');
if(isset($_REQUEST['user_id'])) {
    $id = $_REQUEST['user_id'];
    $sucess = blockUser($id);
    if($sucess) {
        header('Location:' . BASE_URL . 'admin/usersdashboard.php');
    }
}