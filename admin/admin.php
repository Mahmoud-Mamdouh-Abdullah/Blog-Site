<?php
require_once('../config.php');
require_once(BASE_PATH . '/logic/postsLogic.php');
require_once(BASE_PATH . '/layout/header.php');

if(!isAdmin()) {
    header('Location:'. BASE_PATH . 'index.php');
}

function isAdmin()
{
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
    return (isset($_SESSION['user']) && $_SESSION['user']['type'] == 1);
}
?>

<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="heading-page header-text">
    <section class="page-heading">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-content">
                        <h4>Admin Panel</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<section class="main-container">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <a href="<?= BASE_URL . 'admin/postsdashboard.php' ?>" class="btn text-white btn-block" style="background-color: #f48840;">Posts Dashboard</a>
                <a href="<?= BASE_URL . 'admin/usersdashboard.php' ?>" class="btn text-white btn-block" style="background-color: #f48840;">Users Dashboard</a>
            </div>
        </div>
    </div>
</section>


<?php require_once(BASE_PATH . '/layout/footer.php') ?>