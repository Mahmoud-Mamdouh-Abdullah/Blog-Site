<?php
require_once('./config.php');
require_once(BASE_PATH . '/logic/auth.php');

if (isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
    $state = tryLogin($_REQUEST['username'], $_REQUEST['password']);
    if ($state == 1) {
        header('Location:index.php');
        die();
    } else if($state == 2){
        $errors['blockState'] = "your accout was blocked by the admin";
    } else {
        $errors['generic'] = "Please enter a valid username or password";
    }
}

?>

<?php require_once('layout/header.php'); ?>
<!-- Page Content -->
<form action="" method="">
    <main class="main-container">
        <section class="d-flex flex-row justify-content-center">
            <div class="main-div">
                <div class="row d-flex flex-row justify-content-center" style="background-color: white;">
                    <h2 id="h2" class="text-black text-center mb-4 font-monospace">Login</p>
                </div>

                <div class="col mb-3">
                    <label class=""> Username</label>
                    <input name="username" placeholder="Enter your username" class=" form-control" />
                </div>

                <div class="col mb-3">
                    <label class="">Password</label>
                    <input type="password" name="password" placeholder="Enter your password" class="form-control" />
                    <?= (isset($errors['blockState']) ? "<span class='text-danger'>" . $errors['blockState'] ."</span>" : "") ?>
                    <?= (isset($errors['generic']) ? "<span class='text-danger'>" . $errors['generic'] ."</span>" : "") ?>
                </div>

                <div class="row d-flex flex-row justify-content-center" style="background-color: white;">
                    <button type="submit" class="btn mt-3 bg-dark" id="login" name="Sign up">Login</button>
                </div>
            </div>
        </section>
    </main>
</form>


<?php require_once('./layout/footer.php'); ?>