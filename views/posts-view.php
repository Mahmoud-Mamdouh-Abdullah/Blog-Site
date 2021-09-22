<div class="blog-post">
    <div class="blog-thumb">
        <img src="<?= BASE_URL . '/post_images/' . $post['image'] ?>" alt="">
    </div>
    <div class="down-content">
        <span><?= $post['category_name'] ?></span>
        <a href="<?= BASE_URL . '/post-details.php?id=' . $post['id'] ?>">
            <h4><?= $post['title'] ?></h4>
        </a>
        <ul class="post-info">
            <li><a href="#"><?= $post['username'] ?></a></li>
            <li><a href="#"><?= $post['publish_date'] ?></a></li>
            <li><a href="#"><?= $post['number_of_comment'] ?> Comments</a></li>
        </ul>
        <p><?= $post['content'] ?></p>
        <?php
        if ($post['tags']) {
        ?>
            <div class="post-options">
                <div class="row">
                    <div class="col-6">
                        <ul class="post-tags">
                            <li><i class="fa fa-tags"></i></li>
                            <?php
                            foreach ($post['tags'] as $tag) {
                            ?>
                                <li><a href="<?= BASE_URL . "/posts.php?tag_id={$tag['id']}" ?>"><?= $tag['name'] ?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        <div class="row">
            <div class="col-md-6">
                <span id="likes_count_<?= $post['id'] ?>"><?= $post['likes_count']; ?></span> Likes
            </div>
            <div class="col-md-6">
                <button id="likes_btn_<?= $post['id'] ?>" class="btn" type="button" onclick="likePost(<?= $post['id']; ?>)" style="display:<?= !$post['liked_by_me'] ? "block" : "none" ?>">Like</button>
                <button id="unlikes_btn_<?= $post['id'] ?>" class="btn" type="button" onclick="unLikePost(<?= $post['id']; ?>)" style="display:<?= !$post['liked_by_me'] ? "none" : "block" ?>">UnLike</button>
            </div>
        </div>
    </div>
</div>