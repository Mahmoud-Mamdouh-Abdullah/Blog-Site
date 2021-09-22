<?php
function createPost($data)
{
?>
  <div class="col-lg-12">
    <div class="blog-post">
      <div class="blog-thumb">
        <img src="assets/images/blog-post-01.jpg" alt="">
      </div>
      <div class="down-content">
        <span><?= $data["category_name"] ?> </span>
        <a href="post-details.html">
          <h4><?= $data["title"] ?></h4>
        </a>
        <ul class="post-info">
          <li><a href="#"><?= $data['username'] ?></a></li>
          <li><a href="#"><?= $data['publish_date'] ?></a></li>
          <li><a href="#"><?= $data['number_of_comment'] ?> Comments</a></li>
        </ul>
        <p><?= $data['content'] ?></p>
        <div class="post-options">
          <div class="row">
            <div class="col-6">
              <ul class="post-tags">
                <li><i class="fa fa-tags"></i></li>
                <?php
                $tags = $data['tags'];
                for ($i = 0; $i < count($tags); $i++) {
                  if ($i == count($tags) - 1) {
                ?>
                    <li><a href="<?= BASE_URL . '/posts.php?tag_id=' . $tags[$i]['id'] ?>"><?= $tags[$i]['name'] ?></a></li>
                  <?php
                    continue;
                  }
                  ?>
                  <li><a href="<?= BASE_URL . '/posts.php?tag_id=' . $tags[$i]['id'] ?>"><?= $tags[$i]['name'] ?></a>,</li>
                <?php
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
<?php
}
