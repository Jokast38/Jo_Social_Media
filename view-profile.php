<?php require 'layouts/header.php'; ?>
<?php require 'inc/db-functions.php'; ?>
<?php 
//Je le redirige sur la page de connexion si il est pas connecté
if(!is_loggedin()){
    header('Location: index.php');
}
if(isset($_GET['id'])){
    $user = get_user_by_id($_GET['id']);
}
?>
<style>
    .profile-display {
        width: 100%;
        position: relative;
        box-shadow: 0 1px 12px rgba(0,0,0,0.1);
        height: 340px;
        background-color: #fff;
    }
    .profile-cover {
        height: 210px;
        position: absolute;
        top: 0px;
        right: 0px;
        left: 0px;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        background-position: center center;
    }
    .author-info {
        background-color: #f5f5f5;
        padding: 10px;
        position: absolute;
        top: 40px;
        left: 15px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        width: 240px;
    }
    .author-info .author-info-img {
        width: 100%;
        height: 220px;
        width: 220px;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        background-position: center center;
        margin-bottom: 3px;
        position: relative;
    }
    .author-meta {
        display: inline-block;
        vertical-align: bottom;
    }
    .author-username {
        font-size: 26px;
        margin: 5px 0 0 0;
    }
    .edit-p{
        position: absolute;
        z-index: 100;
        right: 24px;
        top: 245px;
    }
</style>
<div class="container bootstrap snippets bootdey">
    <div class="col-md-10">
        <?php if(isset($user)) { ?>
        <div class="profile-display">
            <?php if($_GET['id'] == $_SESSION["id"]) { ?>
                <a href="profile.php" class="btn btn-primary edit-p">Modifier le profile</a>
            <?php } ?>
            <div class="profile-cover" style="background-image:url(assets/img/<?php echo $user['cover_picture'] ?>)" ></div> 
            <div class="author-info">
                <div class="author-info-img" style="background-image:url(assets/img/<?php echo $user['profile_picture'] ?>)">
                </div>
                <div class="author-meta">
                    <h2 class="author-username">
                        <?php echo $user['firstname'] . ' ' .  $user['lastname'] ?>
                    </h2>
                    
                </div>
            </div>
            
        </div>
        
        <?php } ?>
    </div>
</div> 
<?php require 'layouts/footer.php'; ?>