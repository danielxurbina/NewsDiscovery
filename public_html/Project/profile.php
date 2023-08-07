<?php
require_once(__DIR__ . "/../../partials/nav.php");
if(!is_logged_in()){
    flash("You must be logged in to access this page");
    redirect("login.php");
}

// Get the user ID from the URL
$userId = $_GET['id'];
$userInformation = get_user_info($userId);
$createdArticles = get_user_created_articles($userId);
$likedArticles = get_user_liked_articles($userId);
$userLikedArticles = get_user_liked_articles(get_user_id());

if(isset($_POST['likeButton'])){
    // Get the article ID and user ID
    $article_id = $_POST['articleId'];
    $user_id = get_user_id();

    // Call the helper function to toggle the like
    toggle_like($article_id, $user_id);
    redirect("profile.php?id=$userId");
}
?>
<section>
    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/727/727399.png?w=740&t=st=1690845242~exp=1690845842~hmac=b994452078678f6c70d886db56f22f78710ab3f9cb0ee2d0ac245311394ea003" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                    <h5 class="my-3">@<?php se($userInformation['username'])?></h5>
                    <div class="d-flex justify-content-center mb-2">
                        <?php if($userInformation['id'] == get_user_id()): ?>
                            <a type="button" class="btn btn-primary" href="edit_profile.php">Edit Profile</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="card mb-4 mb-lg-0">
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush rounded-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <i class="fas fa-globe fa-lg text-warning"></i>
                            <p class="mb-0">Number of Created Articles: <?php se(count($createdArticles))?></p>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <i class="fas fa-globe fa-lg text-warning"></i>
                            <p class="mb-0">Number of Liked Articles: <?php se(count($likedArticles))?></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <?php 
                foreach($createdArticles as $article){
                    $queryParam = "article_" . $article['id'];
                    $isLiked = in_array($article['id'], array_column($userLikedArticles, 'news_id'));
            ?>
                <div class="card mb-4">
                    <div class="card h-100">
                        <?php
                            // Check if the article has a valid image_url
                            if (!empty($article['image_url'])) {
                                ?>
                                    <img src="<?php echo $article['image_url']; ?>" class="card-img-top" alt="<?php echo $article['title']; ?>" style="width:100%">
                                <?php
                            } else {
                                // If image_url is null, display a random image from the specified URL
                                ?>
                                    <img src="https://source.unsplash.com/user/c_v_r/?<?php echo $queryParam; ?>" class="card-img-top" alt="<?php echo $article['title']; ?>">
                                <?php
                            }
                        ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php se($article['title'])?></h5>
                            <p class="card-text"><?php se($article['content_description'])?></p>
                            <a href="article_details.php?id=<?php echo $article['id']; ?>" class="btn btn-outline-primary">Read More</a>
                            <button type="submit" id="likeButton_<?php echo $article['id'];?>" name="likeButton" class="btn btn-outline-success" onclick="toggleLike(<?php echo $article['id'];?>)" value="<?php echo $article['id'];?>">
                                <i class="bi <?php echo ($isLiked ? 'bi-hand-thumbs-up-fill' : 'bi-hand-thumbs-up'); ?>"></i>
                                <span><?php echo ($isLiked ? 'Unlike' : 'Like'); ?></span>
                            </button>
                            <?php if ($article['created_by'] == get_user_id()) : ?>
                                <a href="article_edit.php?id=<?php echo $article['id']; ?>" class="btn btn-outline-warning">Edit</a>
                                <a href="article_delete.php?id=<?php echo $article['id']; ?>" class="btn btn-outline-danger">Delete</a>
                            <?php endif; ?>
                            <?php if(has_role("Admin") && $article['created_by'] != get_user_id()) : ?>
                                <a href="article_edit.php?id=<?php echo $article['id']; ?>" class="btn btn-outline-warning">Edit</a>
                                <a href="article_delete.php?id=<?php echo $article['id']; ?>" class="btn btn-outline-danger">Delete</a>
                            <?php endif ?>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted" style="float:left">Published on <?php echo convertDate($article['publish_date']); ?></small>
                        </div>
                    </div>
                </div>
            <?php 
                }
            ?>
        </div>
    </div>
</section>

<script>
    function toggleLike(articleId){
        let val = document.getElementById("likeButton_" + articleId).value;
        console.log(val);
        fetch("like_article.php", {
            method: "POST",
            headers: {
                "Content-type": "application/x-www-form-urlencoded",
                "X-Requested-With": "XMLHttpRequest",
            },
            // include the article id and user id in the request body
            body: "articleId=" + articleId + "&userId=" + <?php echo get_user_id(); ?>
        }).then(response =>response.json())
        .then(data => {
            console.log(data);
            if(data.action === "added"){
                document.getElementById("likeButton_" + articleId).innerHTML = '<i class="bi bi-hand-thumbs-up-fill"></i> Unlike';
            } else if(data.action === "deleted") {
                document.getElementById("likeButton_" + articleId).innerHTML = '<i class="bi bi-hand-thumbs-up"></i> Like';
            }
        })
        .catch(err => {
            console.log(err);
        })
    }

</script>

<?php require(__DIR__ . "/../../partials/flash.php"); ?>