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
if(isset($_POST["envoi"])){
    if(!empty($_POST["feed"]) && isset($_FILES["feedpicture"])){
        $feed = htmlentities($_POST["feed"]);
        $picture = $_FILES["feedpicture"]["name"];
        $picture_tempname = $_FILES["feedpicture"]["tmp_name"];
        $folder = $_SERVER["DOCUMENT_ROOT"] . '/php-bts-sio-2/socialdev/assets/img/' . $picture; 
        if(move_uploaded_file($picture_tempname, $folder)){
            $res = create_post($feed, $picture);
            if($res){
                header("Location: posts.php");
                exit();
            }
        }
        
    }
}
if(isset($_GET["action"]) && $_GET["action"] == "like"){
    $res = add_like($_GET["post_id"], $_SESSION["id"]);
    if($res){
        header("Location: posts.php");
        exit();
    }
}
if(isset($_POST["send_comment"])){
    $post_id = $_POST["post_id"]; //champs hidden
    $user_id = $_SESSION["id"];
    $nompre = $_SESSION["nom"] . " " . $_SESSION["prenom"];
    $commentaire = htmlentities($_POST["comment"]);
    $res = add_comment($post_id, $user_id, $nompre, $commentaire);
    if($res){
        header("Location: posts.php");
        exit();
    }
}
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <!-- Formulaire d'envoie de post -->
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="feed" class="form-label">Exprimez-vous</label>
                    <input type="file" name="feedpicture" class="form-control" id="">
                    <textarea class="form-control form-control-lg" id="feed" name="feed" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mb-3" name="envoi">Poster</button>
            </form>
            <!-- Les posts -->
            <?php $posts = get_all_posts();
            if(isset($posts)) { 
                foreach($posts as $post) { ?>
                    <div class="card rounded my-4">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-start">
                                    <img class="img-xs rounded-circle" src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="" width="40">
                                    <div class="ms-2">
                                        <?php $user = get_user_by_id($post["user_id"]) ?>
                                        <p class="mb-0"><a href="view-profile.php?id=<?php echo $post["user_id"] ?>"><?php echo $user['firstname'] ?> <?php echo $user['lastname'] ?></a></p>
                                        <p class="tx-11 text-muted"><?php echo display_time_ago($post["created"]);?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <img src="assets/img/<?php echo $post["post_image"] ?>" style="width:100%" alt="">
                            <p class="mb-3 tx-14"><?php echo $post["content"] ?></p>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex post-actions">
                                <!-- LIKE -->
                                <a href="posts.php?action=like&post_id=<?php echo $post["post_id"] ?>" class="d-flex align-items-center text-muted mr-4 text-decoration-none">
                                    <?php if(check_if_already_like($post["post_id"], $_SESSION['id'])) { ?>
                                        <i class="fa-solid fa-heart" style="color: #cb1a1a;"></i>
                                    <?php }else{ ?>
                                        <i class="fa-regular fa-heart"></i>
                                    <?php } ?>
                                    <p class="d-md-block ms-2 my-0"><span><?= get_count_likes_by_postid($post["post_id"]) ?></span> Likes</p>
                                </a>
                                <a href="javascript:;" class="d-flex align-items-center text-muted ms-4 text-decoration-none">
                                    <i class="fa-solid fa-comment-dots"></i>
                                    <p class="d-md-block ms-2 my-0"><span><?= get_count_comments_by_postid($post["post_id"]) ?></span> Commentaires</p>
                                </a>
                            </div>
                            <div>
                                <?php $comment_by_post = get_all_comments_by_postid($post["post_id"]); 
                                if(isset($comment_by_post) && $comment_by_post) { ?>
                                    <?php foreach($comment_by_post as $comment) { ?>
                                        <ul>
                                            <li>
                                                <p><?php echo  $comment["name"] ?> <small class="text-secondary"><?php echo display_time_ago($comment["created"]);?></small></p>
                                                <p><?php echo  $comment["content_comment"] ?></p>
                                            </li>
                                        </ul>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <form action="" method="POST">
                                <textarea class="form-control mb-2" name="comment" placeholder="Ecrire un commentaire"></textarea>
                                <input type="hidden" name="post_id" value="<?php echo $post["post_id"] ?>">
                                <button type="submit" name="send_comment" class='btn btn-primary'>Commenter</button>
                            </form>
                            
                        </div>
                    </div>
            <?php }
            } ?>
        </div>  
    </div>
</div>
<?php require 'layouts/footer.php'; ?>