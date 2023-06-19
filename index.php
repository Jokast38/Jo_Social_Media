<?php require 'layouts/header.php'; ?>
<?php require 'inc/db-functions.php'; ?>


<?php

    if(isset($_POST["login"])){
      if(!empty($_POST["email"]) && !empty($_POST["pass"])){

        $email = htmlentities($_POST["email"]);
        $pass = htmlentities($_POST["pass"]);

        $res = user_connect($email, $pass);
      }
    }

?>

<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="./assets/img/ordi.webp"
          class="img-fluid" alt="ordi image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <?php  if(isset($res)){ ?>
          <div class="alert alert-success" role="alert">
            <?php echo $res; ?>
          </div>
          <?php } ?>
        <form method="POST" action="">

          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="email" name="email" id="form3Example3" class="form-control form-control-lg"
              placeholder="myaddress@gmail.com " />
            <label class="form-label" for="form3Example3">Email </label>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
            <input type="password" name="pass" id="form3Example4" class="form-control form-control-lg"
              placeholder="Entrer un mot de passe" />
            <label class="form-label" for="form3Example4">Mot de passe</label>
          </div>

          <div class="d-flex justify-content-between align-items-center">

            <a href="#!" class="text-body">Mot de passe oublié ?</a>
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit"  class="btn btn-primary btn-lg" name="login"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Se Connecter</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Pas de compte? <a href="register.php"
                class="link-danger">Inscription</a></p>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>
