<?php
require_once('../config.php');
require_once(BASE_PATH . '/layout/header.php');
require_once(BASE_PATH . '/logic/postsLogic.php');

if (!isset($_REQUEST['id'])) {
  header('Location:' . BASE_URL . 'posts.php');
  die();
}
$post = getPostByID($_REQUEST['id']);
$user_id = null;
if (isset($_SESSION['user'])) {
  $user_id = $_SESSION['user']['id'];
}


function likedByMe($likes, $user_id)
{
  for ($i = 0; $i < count($likes); $i++) {
    if ($likes[$i]['liked_by'] == $user_id) {
      return true;
    }
  }
  return false;
}
?>
<!-- ***** Preloader End ***** -->

<!-- Header -->

<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="heading-page header-text mb-5">
  <section class="page-heading">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="text-content">
            <h4>Post Details</h4>
            <h2>Single blog post</h2>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Banner Ends Here -->


<section class="blog-posts grid-system mb-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="all-blog-posts">
          <div class="row">
            <div class="col-lg-12">
              <div class="blog-post">
                <div class="blog-thumb">
                  <img src="<?= $post['image']?>" alt="">
                </div>
                <div class="down-content">
                  <span><?= $post['category_name'] ?></span>
                  <a href="<?= BASE_URL . 'post-details/post-details.php?id=' . $post['id'] ?>">
                    <h4><?= $post['title'] ?></h4>
                  </a>
                  <ul class="post-info">
                    <li><a href="<?= BASE_URL . 'user/user-details.php?user_id=' . $post['user_id'] ?>"><?= $post['username'] ?></a></li>
                    <li><a href="#"><?= $post['publish_date'] ?></a></li>
                    <li><a href="#"><?= $post['comment_count'] ?> Comments</a></li>
                  </ul>
                  <p>
                    <?= $post['content'] ?>
                  </p>
                  <div class="post-options">
                    <div class="row">
                      <div class="col-6">
                        <ul class="post-tags">
                          <li><i class="fa fa-tags"></i></li>
                          <?php
                          $i = 0;
                          foreach ($post['tags'] as $tag) {
                          ?>
                            <li><a href="#"><?= $tag['name'] ?></a><?= ($i < count($post['tags']) - 1) ? ',' : '' ?></li>
                          <?php
                            $i++;
                          }
                          ?>
                        </ul>
                      </div>
                      <div class="col-6">
                        <ul class="post-share">
                          <li><i class="fa fa-share-alt"></i></li>
                          <li><a href="#">Facebook</a>,</li>
                          <li><a href="#"> Twitter</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="sidebar-item comments">
                <div class="sidebar-heading">
                  <h2><?= $post['comment_count'] ?> comments</h2>
                </div>
                <div class="content row">
                  <ul>
                    <?php
                    foreach ($post['comments'] as $comment) {
                    ?>
                      <li class="col-lg-12">
                        <div class="author-thumb">
                          <img src="../assets/images/comment-author-01.jpg" alt="">
                        </div>
                        <div class="right-content">
                          <h4><?= $comment['name'] ?><span><?= $comment['comment_date'] ?></span></h4>
                          <p><?= $comment['comment'] ?></p>
                          <p class="row ml-1 mb-3"><span id="likes_count_<?= $comment['id'] ?>"><?= $comment['likes_count'] ?></span>&nbspLikes</p>
                          <div class="row">
                            <?php
                            if (($user_id != null && $post['user_id'] == $user_id) || (($user_id != null && $comment['user_id'] == $user_id))) {
                            ?>
                              <form action="<?= BASE_URL . 'post-details/delete-comment.php' ?>" method="POST">
                                <input hidden name="id" value="<?= $comment['id'] ?>">
                                <input hidden name="post_id" value="<?= $post['id'] ?>">
                                <button class="btn btn-danger text-white ml-3"> Delete</button>
                              </form>

                            <?php
                            }
                            ?>
                            <?= ($user_id != null) ? '<button type="button" onclick="likePostComment(' . $comment['id'] . ')" id="likes_btn_' . $comment['id'] . '"class="btn btn-info ml-3 ' . ((likedByMe($comment['likes'], $user_id)) ? 'd-none' : '') . '">Like</button> <button onclick="unlikePostComment(' . $comment['id'] . ')" id="unlikes_btn_' . $comment['id'] . '"class="btn btn-info ml-3 ' . ((likedByMe($comment['likes'], $user_id)) ? '' : 'd-none')  . '">Unlike</button>' : '' ?>
                          </div>
                        </div>
                      </li>
                    <?php
                    }
                    ?>

                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="sidebar-item submit-comment">
                <div class="sidebar-heading">
                  <h2>Your comment</h2>
                </div>
                <div class="content">
                  <form action="<?= BASE_URL . 'post-details/addcomment.php' ?>" method="POST">
                    <input hidden name="post_id" value="<?= $post['id'] ?>">
                    <div class="row">
                      <div class="col-lg-12">
                        <fieldset>
                          <textarea name="message" rows="6" id="message" placeholder="Type your comment" required=""></textarea>
                        </fieldset>
                      </div>
                      <div class="col-lg-12">
                        <fieldset>
                          <button type="submit" id="form-submit" class="main-button">Submit</button>
                        </fieldset>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<?= require_once(BASE_PATH . '/layout/footer.php') ?>