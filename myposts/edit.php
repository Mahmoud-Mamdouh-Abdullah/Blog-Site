<?php
require_once('../config.php');
require_once(BASE_PATH . '/logic/postsLogic.php');
require_once(BASE_PATH . '/logic/tags.php');
require_once(BASE_PATH . '/logic/categories.php');

$tags = getTags();
$categories = getCategories();

$post;
$post_id;
if (isset($_REQUEST['id'])) {
    $post = getPostByID($_REQUEST['id']);
    $post_id = $_REQUEST['id'];
}

if (!checkIfUserCanEditPost($post)) {
    header('Location:index.php');
    die();
}


if (isset($_REQUEST['title'])) {
    editPost($post_id, $_REQUEST, getUploadedImage($_FILES));
    header('Location:index.php');
    die();
}

function ifTagExist($tag, $postTags)
{
    foreach ($postTags as $postTag) {
        if ($tag['id'] == $postTag['tag_id'])
            return true;
    }
    return false;
}



require_once(BASE_PATH . '/layout/header.php');
?>
<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="heading-page header-text">
    <section class="page-heading">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-content">
                        <h4>Edit Post</h4>
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
                        <div class="col-sm-12">
                            <form method="POST" enctype="multipart/form-data">
                                <input name="id" type="hidden" value="<?= $_REQUEST['id'] ?>">
                                <input name="title" placeholder="title" class="form-control mb-3" value="<?= $post['title'] ?>" />
                                <textarea name="content" placeholder="content" class="form-control mb-3"><?= $post['content'] ?></textarea>
                                <label>Upload Image </br><input type="file" name="image" class="mb-3" /></label><br />
                                <label>Publish date<input type="date" name="publish_date" class="form-control mb-3" value="<?= $post['publish_date'] ?>"></label>
                                <select name="category_id" class="form-control mb-3">
                                    <option value="">Select category</option>
                                    <?php
                                    foreach ($categories as $category) {
                                        echo "<option " . ($category['id'] == $post['category_id'] ? "selected" : "") . " value='{$category['id']}'>{$category['name']}</option>";
                                    }
                                    ?>
                                </select>
                                <select name="tags[]" multiple class="form-control mb-5">
                                    <?php
                                    foreach ($tags as $tag) {
                                        echo "<option " . (ifTagExist($tag, $post['tags']) ? "selected" : "") . " value='{$tag['id']}'>{$tag['name']}</option>";
                                    }
                                    ?>
                                </select>
                                <button class="btn btn-success">Edit Post</button>
                                <a href="index.php" class="btn btn-danger">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once(BASE_PATH . '/layout/footer.php') ?>