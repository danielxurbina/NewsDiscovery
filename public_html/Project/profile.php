<?php
require_once(__DIR__ . "/../../partials/nav.php");
if(!is_logged_in()){
    flash("You must be logged in to access this page");
    redirect("login.php");
}

$userId = get_user_id();
$userInformation = get_user_info($userId);
$createdArticles = get_user_created_articles($userId);
$likedArticles = get_user_liked_articles($userId);

error_log("User Information: " . var_export($userInformation, true));
error_log("Created Articles: " . var_export($createdArticles, true));
error_log("Liked Articles: " . var_export($likedArticles, true));


if(isset($_POST['likeButton'])){
    // Get the article ID and user ID
    $article_id = $_POST['articleId'];
    error_log("Article ID: " . var_export($article_id, true));
    $user_id = get_user_id();

    // Call the helper function to toggle the like
    toggle_like($article_id, $user_id);
    redirect("profile.php");
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
                    $isLiked = in_array($article['id'], array_column($likedArticles, 'news_id'));
                    error_log("Is Liked: " . var_export($isLiked, true));
            ?>
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row" id="imageRow">
                            <?php
                                // Check if the article has a valid image_url
                                if (!empty($article['image_url'])) {
                                    ?>
                                    <img src="<?php echo $article['image_url']; ?>" class="card-img-top" alt="<?php echo $article['title']; ?>">
                                    <?php
                                } else {
                                    // If image_url is null, display a random image from the specified URL
                                    ?>
                                    <img src="https://source.unsplash.com/user/c_v_r/?<?php echo $queryParam; ?>" class="card-img-top" alt="<?php echo $article['title']; ?>">
                                    <?php
                                }
                            ?>
                        </div>
                        <div class="row" id="contentRow">
                            <h4 class="mb-0"><?php se($article['title'])?></h4>
                            <p class="mb-0"><?php se($article['content_description'])?></p>
                        </div>
                        <div class="row" id="buttonRow">
                            <div class="col-lg-6">
                                <a href="article_details.php?id=<?php echo $article['id']; ?>" class="btn btn-primary">Read More</a>
                            </div>
                            <div class="col-lg-6">
                                <form method="POST" id="likeButton" action="">
                                    <input type="hidden" name="articleId" value="<?php echo $article['id']; ?>">
                                    <button type="submit" name="likeButton" class="btn btn-success">
                                        <i class="bi <?php echo ($isLiked ? 'bi-hand-thumbs-up-fill' : 'bi-hand-thumbs-up'); ?>"></i>
                                        <span><?php echo ($isLiked ? 'Unlike' : 'Like'); ?></span>
                                    </button>
                                </form>
                            </div>
                            <div class="col-lg-6">
                                <a href="article_edit.php?id=<?php echo $article['id']; ?>" class="btn btn-warning">Edit</a>
                            </div>
                            <div class="col-lg-6">
                                <a href="article_delete.php?id=<?php echo $article['id']; ?>" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php 
                }
            ?>
        </div>
    </div>
</section>