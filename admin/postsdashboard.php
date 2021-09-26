<?php
require_once('../config.php');
require_once(BASE_PATH . '/logic/postsLogic.php');
require_once(BASE_PATH . '/layout/header.php');
$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
$page_size = 10;
$order_field = isset($_REQUEST['order_field']) ? $_REQUEST['order_field'] : 'id';
$order_by = isset($_REQUEST['order_by']) ? $_REQUEST['order_by'] : 'asc';
$q = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';

function getUrl($page, $q, $order_field, $order_by)
{
    return "admin.php?page=$page&q=$q&order_field=$order_field&order_by=$order_by";
}
function getSortingUrl($field, $oldOrderField, $oldOrderBy, $q)
{
    if ($field == $oldOrderField && $oldOrderBy == 'asc') {
        return "admin.php?page=1&q=$q&order_field=$field&order_by=desc";
    }
    if ($field == $oldOrderField && $oldOrderBy == 'desc') {
        return "admin.php?page=1&q=$q";
    }
    return  "admin.php?page=1&q=$q&order_field=$field&order_by=asc";
}

function getSortFlag($field, $oldOrderField, $oldOrderBy)
{
    if ($field == $oldOrderField && $oldOrderBy == 'asc') {
        return "<i class='fa fa-sort-up'></i>";
    }
    if ($field == $oldOrderField && $oldOrderBy == 'desc') {
        return "<i class='fa fa-sort-down'></i>";
    }
    return  "";
}
function getUserId()
{
    if (session_status() != PHP_SESSION_ACTIVE) session_start();
    if (isset($_SESSION['user'])) return $_SESSION['user']['id'];
    return 0;
}

$posts = getMyPosts($page_size, $page, null, $q, $order_field, $order_by);
$page_count = ceil($posts['count'] / $page_size);
/*
$posts = ['data'=>[],'count'=>100,'order_field'=>'title','order_by'=>'asc']
*/

?>
<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="heading-page header-text">
    <section class="page-heading">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-content">
                        <h4>Posts Dashboard</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Banner Ends Here -->
<section class="main-container">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="all-blog-posts">
                    <div class="row">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><a href="<?= getSortingUrl('title', $order_field, $order_by, $q) ?>">Title <?= getSortFlag('title', $order_field, $order_by) ?></a></th>
                                    <th><a href="<?= getSortingUrl('category_name', $order_field, $order_by, $q) ?>">Category <?= getSortFlag('category_name', $order_field, $order_by) ?></a></th>
                                    <th>Tags</th>
                                    <th>Image</th>
                                    <th><a href="<?= getSortingUrl('publish_date', $order_field, $order_by, $q) ?>">Publish Date <?= getSortFlag('publish_date', $order_field, $order_by) ?></a></th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($posts['data'] as $post) {
                                    $tags = '';
                                    foreach ($post['tags'] as $tag) {
                                        $tags .= "<span class='tag'>{$tag['name']}</tag>";
                                    }
                                    $img_src = BASE_URL . '/post_images/' . $post['image'];
                                    echo "<tr>
                                    <td>$i</td>
                                    <td>{$post['title']}</td>
                                    <td>{$post['category_name']}</td>
                                    <td>{$tags}</td>
                                    <td><img src='{$img_src}' width='200' height='200'/></td>
                                    <td>{$post['publish_date']}</td>
                                    <td>
                                    <a onclick='return confirm(\"Are you sure ?\")' href='deletepost.php?id={$post['id']}' class='btn btn-danger'>Delete</a>
                                    </td>
                                    </tr>";
                                    $i++;
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12">
                        <ul class="page-numbers">
                            <?php
                            $prevUrl = getUrl($page - 1, $q, $order_field, $order_by);
                            $nxtUrl = getUrl($page + 1, $q, $order_field, $order_by);

                            if ($page > 1) echo "<li><a href='{$prevUrl}'><i class='fa fa-angle-double-left'></i></a></li>";

                            for ($i = 1; $i <= $page_count; $i++) {
                                $url = getUrl($i, $q, $order_field, $order_by);
                                echo "<li class=" . ($i == $page ? "active" : "") . "><a href='{$url}'>{$i}</a></li>";
                            }

                            if ($page < $page_count) echo "<li><a href='{$nxtUrl}'><i class='fa fa-angle-double-right'></i></a></li>";
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once(BASE_PATH . '/layout/footer.php') ?>