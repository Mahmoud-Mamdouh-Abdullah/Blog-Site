<?php
require_once('config.php');
require_once('layout/header.php'); 
require_once('helpers/createpost.php');
require_once(BASE_PATH . '/logic/categories.php');
require_once(BASE_PATH . '/logic/tags.php');
require_once(BASE_PATH . '/logic/postsLogic.php');
require_once(BASE_PATH . '/logic/auth.php');
$posts = getPosts(4, 1, null, null, null, null, 'publish_date', 'desc', getUserId());

?>
<!-- Page Content -->
<!-- Banner Starts Here -->


<section class="blog-posts main-container">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="all-blog-posts">
          <div class="row">

            <?php
            foreach($posts as $post) {
             ?>
              <div class="col-lg-12">
                <?php include(BASE_PATH . '/views/posts-view.php') ?>
              </div>
              <?php
            }
            ?>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="sidebar">
          <div class="row">
            <div class="col-lg-12">
              <div class="sidebar-item search">
                <form id="search_form" name="gs" method="GET" action="posts.php">
                  <input type="text" name="q" class="searchText" placeholder="type to search..." autocomplete="on">
                </form>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="sidebar-item categories">
                <div class="sidebar-heading">
                  <h2>Categories</h2>
                </div>
                <div class="content">
                  <ul>
                    <?php
                    foreach(getCategories() as $cat) {
                    ?>
                      <li><a href="<?= BASE_URL . 'posts.php?category_id=' . $cat['id'] ?>">- <?= $cat['name'] ?></a></li>
                    <?php
                    }
                    ?>
                  </ul>
                </div>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="sidebar-item tags">
                <div class="sidebar-heading">
                  <h2>Tag Clouds</h2>
                </div>
                <div class="content">
                  <ul>
                    <?php
                    foreach(getTags() as $tag) {
                      ?>
                      <li><a href="<?= BASE_URL . '/posts.php?tag_id=' . $tag['id'] ?>"><?=$tag['name']?></a></li>
                      <?php
                    }
                    ?>
                  </ul>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
</section>


<?php require_once('layout/footer.php'); ?>