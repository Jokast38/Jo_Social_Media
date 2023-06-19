<?php require 'layouts/header.php'; ?>
<?php require 'inc/db-functions.php'; ?>

<?php    

        if(isset($_POST["inscription"])){
            if(!empty($_POST["genre"]) && !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["datenaiss"]) && !empty($_POST["email"]) && !empty($_POST["login"]) && !empty($_POST["tel"]) && !empty($_POST["pass"])){
                $genre      = htmlentities($_POST["genre"]);
                $prenom     = htmlentities($_POST["prenom"]);
                $nom        = htmlentities($_POST["nom"]);
                $tel        = htmlentities($_POST["tel"]);
                $email      = htmlentities($_POST["email"]);
                $pass       = password_hash($_POST["pass"], PASSWORD_DEFAULT); //Hashage du mot de passe
                $datenaiss  = htmlentities($_POST["datenaiss"]);
                $login      = htmlentities($_POST["login"]);

              $inscription  =  user_register($genre, $prenom, $nom, $tel, $datenaiss, $email, $login, $pass);

            }
        }

?>

<!-- Section: Design Block -->
<section class="text-center">
  <!-- Background image -->
  <div class="p-5 bg-image" style="
        background-image: url('./assets/img/171.jpg');
        background-position: center;
        height: 300px;
        "></div>
  <!-- Background image -->

  <div class="card mx-4 mx-md-5 shadow-5-strong" style="
        margin-top: -100px;
        background: hsla(0, 0%, 100%, 0.8);
        backdrop-filter: blur(30px);
        ">
    <div class="card-body py-5 px-md-5">
        <?php if (isset($inscription)  && $inscription) {
         ?>
         <div  class="alert alert-success" role="alert">
          Inscription reussie
         </div>
       <?php } ?>
       <?php if (isset($inscription) && !$inscription) {
         ?>
         <div  class="alert alert-danger" role="alert">
          Inscription echouée
         </div>
       <?php } ?>
      <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
          <h2 class="fw-bold mb-5">Inscription</h2>
          <form method="POST" action=""> 
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <!-- login input -->
            <div class="form-outline mb-4 w-20 d-flex justify-content-around align-items-center">
                <label class="form-label" for="genre">Genre </label>
            <select class="form-select" name="genre" id="genre">
                <option value="mr">Monsieur</option>
                <option value="mme">Madame</option>
            </select>
           </div>

            <div class="row">
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input type="text" id="nom" class="form-control" name="nom" />
                  <label class="form-label" for="nom">Nom</label>
                </div>
              </div>
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input type="text" id="prenom" name="prenom" class="form-control" />
                  <label class="form-label" for="prenom">Prénom</label>
                </div>
              </div>
            </div>

            <!-- Telephone input -->
            <div class="form-outline mb-4">
             <input type="text" id="tel" name="tel" class="form-control" />
             <label class="form-label" for="tel">Télephone </label>
           </div>

             <!-- Date de Naissance input -->
             <div class="form-outline mb-4">
             <input type="date" id="date" name="datenaiss" class="form-control" />
             <label class="form-label" for="datenaiss">Date de Naissance </label>
           </div>

            <!-- login input -->
            <div class="form-outline mb-4">
             <input type="text" id="login" name="login" class="form-control" />
             <label class="form-label" for="login">Login </label>
           </div>

            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="email" id="email" name="email" class="form-control" />
              <label class="form-label" for="email">Email </label>
            </div>


            <!-- Password input -->
            <div class="form-outline mb-4">
              <input type="password" id="pass" name="pass" class="form-control" />
              <label class="form-label" for="pass">Mot de passe</label>
            </div>

            <!-- Submit button -->
            <button type="submit" name="inscription" class="btn btn-primary btn-block mb-4">
                S'inscrire
                </button>
                <p class="small fw-bold mt-2 pt-1 mb-0">Déja un compte? <a href="index.php"
                    class="link-danger">Se connecter</a></p>

          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Section: Design Block -->


<?php require 'layouts/footer.php'; ?>
