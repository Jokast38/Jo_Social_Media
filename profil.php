<?php require 'layouts/header.php'; ?>
<?php require 'inc/db-functions.php'; ?>
<?php 
//Je le redirige sur la page de connexion si il est pas connecté
if(!is_loggedin()){
    header('Location: index.php');
}
?>
<?php require 'layouts/nav.php'; ?>
<?php 
$user = get_user_by_id($_SESSION['id']);
if(isset($_POST["edit"])){
    if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['tel'])){
        $nom = htmlentities($_POST['nom']);
        $prenom = htmlentities($_POST['prenom']);
        $tel = htmlentities($_POST['tel']);
        $img_folder = $_SERVER["DOCUMENT_ROOT"] . '/houri/assets/img/';
        if(!empty($_FILES["pp"])){
            $pp_filename = $_FILES["pp"]["name"];
            $pp_tempname = $_FILES["pp"]["tmp_name"];
            $pp_folder = $img_folder.$pp_filename;
            if(move_uploaded_file($pp_tempname, $pp_folder)){
                $pp_src = $pp_filename;
            }
        }else{
            $pp_src = 'no-img.jpg';
        }
        if(!empty($_FILES["pc"])){
            $pc_filename = $_FILES["pc"]["name"];
            $pc_tempname = $_FILES["pc"]["tmp_name"];
            
            if(move_uploaded_file($pc_tempname, $img_folder.$pc_filename)){
                $pc_src = $pc_filename;
            }
        }else{
            $pc_src = 'no-img.jpg';
        }
        
        $res = edit_user($_SESSION["id"], $nom, $prenom, $tel, $pp_src, $pc_src);
        if($res){
            header("Refresh:0");
        }
    }
}
?>

<div class="container">
    <div class="page-profile">
        <div class="row">
            <!-- COL 1 -->
            <div class="col-md-4">
                <section class="panel">
                    <div class="panel-body noradius padding-10">
                        <figure class="margin-bottom-10"><!-- image -->
                            <img class="img-responsive" style='width:100%' src="assets/img/<?php echo $user["profile_picture"] ?>" alt="">
                        </figure><!-- /image -->
                        <hr class="half-margins">
                        
                        <!-- About -->
                        <h3 class="text-black">
                            <?php echo $user["firstname"] ?> <?php echo $user["lastname"] ?>
                        </h3>
                        <small class="text-gray size-14"><?php echo display_age($user["birthday"]); ?></small>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Veniam amet unde distinctio! Ex harum assumenda explicabo rerum porro molestias recusandae.</p>
                        <!-- /About -->
                        
                    </div>
                </section>
            </div><!-- /COL 1 -->
            <!-- COL 2 -->
            <div class="col-md-8">
                <!-- Edit -->
                <div id="edit">
                    <form class="form-horizontal padding-10" method="POST" action="" enctype="multipart/form-data">
                        <h4>Information personnel</h4>
                        <fieldset>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="pp">Photo de profile</label>
                                <div class="col-md-8">
                                    <input type="file" class="form-control" id="pp" name="pp">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="pc">Photo de couverture</label>
                                <div class="col-md-8">
                                    <input type="file" class="form-control" id="pc" name="pc">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="nom">Nom</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $user['firstname'] ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="prenom">Prénom</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="prenom"  name="prenom" value="<?php echo $user['lastname'] ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="tel">Tel</label>
                                <div class="col-md-8">
                                    <input type="tel" class="form-control" id="tel" name="tel" value="<?php echo $user['number'] ?>" >
                                </div>
                            </div>
                        </fieldset>
                        <button type="submit" name="edit" class="btn btn-primary btn-block my-4">
                        Modifier
                        </button>
                    </form>
                </div>
                <p class="small fw-bold mt-2 pt-1 mb-0"><a href="logout.php"
                    class="link-danger">Deconnexion</a></p>

            </div><!-- /COL 2 -->
        </div>
    </div>
</div>
<?php require 'layouts/footer.php'; ?>