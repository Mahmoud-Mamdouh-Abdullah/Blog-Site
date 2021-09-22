<?php
require_once(BASE_PATH . '/DAL/basic_dal.php');

function getCategories() {
    $sql = "SELECT * FROM `categories`;";
    return getRows($sql);
}