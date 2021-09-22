<?php
require_once('../config.php');
require_once(BASE_PATH . '/logic/users.php');
require_once(BASE_PATH . '/layout/header.php');

$users = getUsers();
echo '<pre>';
echo '</pre>';

?>
<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="heading-page header-text">
    <section class="page-heading">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-content">
                        <h4>Users Dashboard</h4>
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
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach($users as $user) {
                                    ?>
                                    <tr>
                                        <td><?=$i++?></td>
                                        <td><?= $user['name']?></td>
                                        <td><?=$user['username']?></td>
                                        <td><?=$user['email']?></td>
                                        <td><?=$user['phone']?></td>
                                        <td>
                                            <a href="<?= BASE_URL . "/admin/blockuser.php?user_id={$user['id']}" ?>" <?= ($user['active'] == 1) ? "" : "hidden"?> class="btn btn-warning">Block</a>
                                            <a href="<?= BASE_URL . "/admin/unblockuser.php?user_id={$user['id']}" ?>" <?= ($user['active'] == 1) ? "hidden" : ""?> class="btn btn-warning">Unblock</a>
                                            <a href="<?= BASE_URL . "/admin/removeuser.php?user_id={$user['id']}" ?>" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12">
                        <ul class="page-numbers">
                           
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once(BASE_PATH . '/layout/footer.php') ?>