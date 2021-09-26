<?php

use function PHPSTORM_META\type;

require_once(BASE_PATH . '/DAL/basic_dal.php');

function getPosts(
    $page_size,
    $page = 1,
    $category_id = null,
    $tag_id = null,
    $user_id = null,
    $q = null,
    $order_field = "publish_date",
    $order_by = "desc",
    $like_by_user_id = null
) {

    $offset = ($page - 1) * $page_size;

    $sql = "SELECT p.*,c.name AS category_name,u.name AS username FROM posts p
    INNER JOIN categories c ON c.id=p.category_id
    INNER JOIN users u ON u.id=p.user_id
    WHERE 1=1";

    $types = '';
    $vals = [];
    $sql = addWhereConditions($sql, $category_id, $tag_id, $user_id, $q, $types, $vals);
    $sql .= " ORDER BY $order_field $order_by limit $offset,$page_size";

    $posts =  getRows($sql, $types, $vals);
    for ($i = 0; $i < count($posts); $i++) {
        $posts[$i]['number_of_comment'] = getPostCommentsCount($posts[$i]['id']);
        $posts[$i]['tags'] = getPostTags($posts[$i]['id']);
        $posts[$i]['likes_count'] = getLikesCount($posts[$i]['id']);
        if ($like_by_user_id) {
            $posts[$i]['liked_by_me'] = getIfLikedByMe($posts[$i]['id'], $like_by_user_id);
        } else
            $posts[$i]['liked_by_me'] = false;
    }

    return $posts;
}

function getIfLikedByMe($post_id, $user_id)
{
    $sql = "SELECT id FROM likes WHERE post_id=? and user_id=?";
    return getRow($sql, 'ii', [$post_id, $user_id]) != null;
}

function getPostCount($category_id = null, $tag_id = null, $user_id = null, $q = null)
{
    $sql = "SELECT COUNT(0) AS posts_counts FROM posts p
    WHERE 1=1";
    $types = '';
    $vals = [];
    $sql = addWhereConditions($sql, $category_id, $tag_id, $user_id, $q, $types, $vals);
    $result = getRow($sql, $types, $vals);
    if ($result == null) return 0;
    return $result['posts_counts'];
}

function addWhereConditions($sql, $category_id = null, $tag_id = null, $user_id = null, $q = null, &$types, &$vals)
{
    if ($category_id != null) {
        $types .= 'i';
        array_push($vals, $category_id);
        $sql .= " AND category_id=?";
    }
    if ($user_id != null) {
        $types .= 'i';
        array_push($vals, $user_id);
        $sql .= " AND user_id=?";
    }
    if ($tag_id != null) {
        $types .= 'i';
        array_push($vals, $tag_id);
        $sql .= " AND p.id IN (SELECT post_id FROM post_tags WHERE tag_id=?)";
    }
    if ($q != null) {
        $types .= 'ss';
        array_push($vals, '%' . $q . '%');
        array_push($vals, '%' . $q . '%');
        $sql .= " AND (title like ? OR content like ?)";
    }
    return $sql;
}

function getMyPosts($page_size, $page, $user_id, $q, $order_field, $order_by)
{
    return [
        'data' => getPosts($page_size, $page, null, null, $user_id, $q, $order_field, $order_by),
        'count' => getPostCount(null, null, $user_id, $q)
    ];
}


function getPostCommentsCount($post_id)
{
    $sql = "SELECT COUNT(0) AS number_of_comment FROM comments WHERE post_id = $post_id;";
    $result = getRow($sql);
    if ($result == null) return 0;
    return $result['number_of_comment'];
}

function getLikesCount($postId)
{
    $sql = "SELECT COUNT(0) as cnt FROM likes WHERE post_id=$postId";
    $result = getRow($sql);
    if ($result == null) return 0;
    return $result['cnt'];
}

function getPostComments($post_id)
{
    $sql = "SELECT c.*, u.name FROM comments c
    JOIN users u ON u.id = c.user_id
    WHERE post_id = ?;";
    $comments = getRows($sql, 'i', [$post_id]);
    for ($i = 0; $i < count($comments); $i++) {
        $comments[$i]['likes_count'] = getCommentsLikesCount($comments[$i]['id']);
        $comments[$i]['likes'] = getCommentLikes($comments[$i]['id']);
    }
    return $comments;
}

function getCommentsLikesCount($comment_id)
{
    $sql = "SELECT COUNT(0) as likes_count FROM comment_likes WHERE comment_id = ?;";
    return getRow($sql, 'i', [$comment_id])['likes_count'];
}

function getCommentLikes($comment_id)
{
    $sql = "SELECT user_id as liked_by FROM comment_likes WHERE comment_id = ?;";
    return getRows($sql, 'i', [$comment_id]);
}

function getPostTags($post_id)
{
    $sql = "SELECT t.id, t.name FROM post_tags pt
            JOIN tags t 
            ON t.id = pt.tag_id
            WHERE pt.post_id = $post_id;";

    return getRows($sql);
}

function getPostByID($post_id)
{
    $sql = "SELECT p.*, u.name as username, c.name as category_name FROM posts p 
    JOIN categories c ON c.id = p.category_id
    JOIN users u ON u.id = p.user_id
    WHERE p.id=?;";
    $post = getRow($sql, 'i', [$post_id]);
    $sql = "SELECT * FROM post_tags WHERE post_id=?";
    $post['tags'] = getPostTags($post_id);
    $post['comment_count'] = getPostCommentsCount($post_id);
    $post['comments'] = getPostComments($post_id);
    return $post;
}

function validatePostCreate($request)
{
    $errors = [];
    return $errors;
}
function addNewPost($request, $user_id, $image)
{
    $sql = "INSERT INTO posts(id,title,content,image,publish_date,category_id,user_id)
    VALUES (null,?,?,?,?,?,?)";
    $post_id = addData($sql, 'ssssii', [
        $request['title'],
        $request['content'],
        $image,
        $request['publish_date'],
        $request['category_id'],
        $user_id
    ]);
    if ($post_id) {
        if (isset($request['tags'])) {
            foreach ($request['tags'] as $tag_id) {
                addData(
                    "INSERT INTO post_tags (post_id,tag_id) VALUES (?,?)",
                    'ii',
                    [$post_id, $tag_id]
                );
            }
        }
        return true;
    }
    return false;
}

function editPost($post_id, $request, $image)
{
    $sql = "UPDATE `posts` SET title = ?, content = ?, publish_date = ?, category_id = ?";
    $types = 'sssi';
    $vals = [
        $request['title'],
        $request['content'],
        $request['publish_date'],
        $request['category_id']
    ];
    if ($image != null) {
        $sql .= ", image = ?";
        $types .= 's';
        array_push($vals, $image);
    }
    $sql .= " WHERE id = ?;";
    $types .= 'i';
    array_push($vals, $post_id);
    editData($sql, $types, $vals);

    $sql = "DELETE FROM `post_tags` WHERE post_id = ?";
    deleteData($sql, 'i', [$post_id]);

    if (isset($request['tags'])) {
        foreach ($request['tags'] as $tag_id) {
            addData(
                "INSERT INTO post_tags (post_id,tag_id) VALUES (?,?)",
                'ii',
                [$post_id, $tag_id]
            );
        }
    }
}

function checkIfUserCanEditPost($post)
{
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
    if (!isset($_SESSION['user']))
        return false;
    return $_SESSION['user']['type'] == 1 || $_SESSION['user']['id'] == $post['user_id'];
}

function getUploadedImage($files)
{
    move_uploaded_file($files['image']['tmp_name'], BASE_PATH . '/post_images/' . $files['image']['name']);
    return $files['image']['name'];
}

function deletePost($id)
{
    $sql = "DELETE FROM posts WHERE id=?";
    execute($sql, 'i', [$id]);
}
function likePost($id, $user_id)
{
    $sql = "INSERT INTO likes (id,post_id,user_id) VALUES (null,?,?)";
    execute($sql, 'ii', [$id, $user_id]);
}
function unlikePost($id, $user_id)
{
    $sql = "DELETE FROM likes WHERE post_id=? AND user_id=?";
    execute($sql, 'ii', [$id, $user_id]);
}

function addComment($post_id, $user_id, $message)
{
    $sql = "INSERT INTO comments (comment, post_id, user_id) VALUES (?,?,?);";
    return editData($sql, 'sii', [$message, $post_id, $user_id]);
}

function deleteComment($comment_id)
{
    $sql = "DELETE FROM comments WHERE id = ?;";
    deleteData($sql, 'i', [$comment_id]);
}

function likeComment($comment_id, $user_id) {
    $sql = "INSERT INTO comment_likes (comment_id, user_id) VALUES (?,?);";
    return editData($sql, 'ii', [$comment_id, $user_id]);
}

function unlikeComment($comment_id, $user_id) {
    $sql = "DELETE FROM comment_likes WHERE comment_id =? AND user_id = ?;";
    deleteData($sql, 'ii', [$comment_id, $user_id]);
}