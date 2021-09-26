<?php
include_once(BASE_PATH . '/DAL/basic_dal.php');

function getUsers()
{
    $sql = "SELECT * FROM users WHERE type = 0";
    return getRows($sql);
}

function getUserByID($user_id) {
    $sql = "SELECT * FROM users WHERE id = ?;";
    return getRow($sql, 'i', [$user_id]);
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

function followUser($following_id, $follower_id) {
    $sql = "INSERT INTO follows (follower_id, following_id) VALUES (?,?)";
    return editData($sql, 'ii', [$follower_id, $following_id]);
}

function unFollowUser($following_id, $follower_id) {
    $sql = "DELETE FROM follows WHERE follower_id = ? AND following_id = ?;";
    editData($sql, 'ii', [$follower_id, $following_id]);
}


function getFollowerCount($user_id)
{
    $sql = "SELECT COUNT(0) as follower_count FROM `follows` WHERE following_id = ?";
    return getRow($sql, 'i', [$user_id])['follower_count'];
}

function ifIFllow($following_id, $follower_id)
{
    $sql = "SELECT id FROM follows WHERE follower_id = ? AND following_id = ?;";
    return getRow($sql, 'ii', [$follower_id, $following_id]);
}