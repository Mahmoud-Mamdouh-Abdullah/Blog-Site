<?php
require_once('./config.php');
require_once(BASE_PATH . '/helpers/requesthelper.php');
require_once(BASE_PATH . './helpers/registervalidation.php');
require_once(BASE_PATH . '/layout/header.php');
require_once(BASE_PATH . '/Logic/auth.php');
if (isset($_REQUEST['name'])) {
  $request = validateRequest($_REQUEST);
  $data = $request['data'];
  $errors = $request['errors'];
  if (count($errors) == 0) {
    $sucess = register($data);
    header('Location:' . BASE_URL . 'index.php');
  }
}

?>

<form action="register.php" method="POST">
  <main class="main-container">
    <section class="d-flex flex-row justify-content-center">
      <div class="main-div">
        <div class="row d-flex flex-row justify-content-center" style="background-color: white;">
          <h2 id="h2" class="text-black text-center mb-4 font-monospace">Register Here</p>
        </div>

        <div class="col mb-3">
          <label class=""> Name</label>
          <input name="name" placeholder="Enter your name" class=" form-control" required " />
          <?= isset($errors['name']) ? $errors['name'] : '' ?>
        </div>

        <div class=" col mb-3">
          <label class=""> Username</label>
          <input name="username" placeholder="Enter your username" class=" form-control" required" />
          <?= isset($errors['username']) ? $errors['username'] : '' ?>
        </div>

        <div class="col mb-3">
          <div class="row">
            <div class="col col-md-6">
              <label class=""> Password</label>
              <input type="password" name="password" placeholder="Enter your password" class="form-control" required />
              <?= isset($errors['password']) ? $errors['password'] : '' ?>
              <span class="text text-danger"><?= isset($errors['password_confirm']) ? $errors['password_confirm'] : '' ?></span>
            </div>

            <div class="col col-md-6">
              <label class="">Confirm Password</label>
              <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" required />
              <?= isset($errors['confirm_password']) ? $errors['confirm_password'] : '' ?>
            </div>
          </div>
        </div>

        <div class="col mb-3">
          <label class=""> Email</label>
          <input type="email" name="email" placeholder="example@email.com" class=" form-control" required />
          <?= isset($errors['email']) ? $errors['email'] : '' ?>
        </div>

        <div class="col mb-3">
          <label class=""> Phone</label>
          <input name="phone" placeholder="+2010000000000" class=" form-control" />
        </div>

        <div class="row d-flex flex-row justify-content-center" style="background-color: white;">
          <button class="btn mt-3 bg-dark" id="sign-up">Sign up</button>
        </div>
      </div>
    </section>
  </main>
</form>
<?php require_once('layout/footer.php') ?>