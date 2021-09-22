<?php
require_once(BASE_PATH . '/DAL/basic_dal.php');

function getTags()
{
    $sql = "SELECT * FROM `tags`;";
    return getRows($sql);
}