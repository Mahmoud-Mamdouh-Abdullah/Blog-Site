<?php
include_once(BASE_PATH . '/DAL/basic_dal.php');

function getUsers()
{
    $sql = "SELECT * FROM users WHERE type = 0";
    return getRows($sql);
}

function blockUser($user_id)
{
    $sql = "UPDATE users SET active = 0 WHERE id = ?;";
    return editData($sql, 'i', [$user_id]);
}

function unBlockUser($user_id)
{
    $sql = "UPDATE users SET active = 1 WHERE id = ?;";
    return editData($sql, 'i', [$user_id]);
}

function removeUser($user_id)
{
    $sql = "DELETE FROM users WHERE id = ?;";
    deleteData($sql, 'i', [$user_id]);
}