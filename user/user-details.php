<?php
require_once('../config.php');
require_once(BASE_PATH . '/layout/header.php');
require_once(BASE_PATH . '/logic/users.php');

if (session_status() != PHP_SESSION_ACTIVE || session_status() == PHP_SESSION_DISABLED) {
    session_start();
}

$follower_id = $_SESSION['user']['id'];

if (!isset($_REQUEST['user_id'])) {
    header('Location:' . BASE_URL . 'index.php');
}
$user_id = $_REQUEST['user_id'];
$user = getUserByID($user_id);
?>
<!-- ***** Preloader End ***** -->

<!-- Header -->

<!-- Page Content -->



<section class="blog-posts main-container">
    <div class="mt-4 mb-4 p-3 d-flex justify-content-center">
        <div class="card p-5 container">
            <div class=" image d-flex flex-column justify-content-center align-items-center">
                <img src="<?= BASE_URL . 'assets/images/comment-author-01.jpg' ?>" class="author-thumb">
                <h3 class="mt-3"><?= $user['name'] ?></h3>
                <span>@<?= $user['username'] ?></span>
                <div class="d-flex flex-row justify-content-center align-items-center mt-3">
                    <span class="number"><?= getFollowerCount($user_id) ?>
                        <span>Follower(s)</span>
                    </span>
                </div>
                <div class="text mt-3"><?= $user['email'] ?></div>
                <?php
                if ($user_id != $follower_id) {
                ?>
                    <div class=" d-flex mt-2">
                        <?php
                        $follow = ifIFllow($user_id, $follower_id);
                        if ($follow == null) {
                        ?>
                            <a <?= (!isset($_SESSION['user']) ? 'hidden' : '') ?> href="<?= BASE_URL . 'user/followuser.php?following_id=' . $user_id . '&follower_id=' . $follower_id ?>" class="btn text-white" style="background-color: #f48840;">Follow</a>
                        <?php
                        } else if ($follow['id'] > 0) {
                        ?>
                            <a <?= (!isset($_SESSION['user']) ? 'hidden' : '') ?> href="<?= BASE_URL . 'user/unfollowuser.php?following_id=' . $user_id . '&follower_id=' . $follower_id ?>" class="btn text-white" style="background-color: #f48840;">Unfollow</a>
                        <?php
                        }
                        ?>
                    </div>
                <?php
                }
                ?>

            </div>
        </div>
    </div>
</section>


<?= require_once(BASE_PATH . '/layout/footer.php') ?>