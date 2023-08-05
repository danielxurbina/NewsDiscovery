<?php require(__DIR__ . "/../../partials/nav.php"); ?>
<?php
    // If user is not logged in redirect to login page
    if(!is_logged_in()){
        flash("You must be logged in to view this page", "warning");
        redirect("login.php");
    }

    $isLiked = false;

    // Extract id from url
    $id = $_GET['id'];

    // Fetch from the DB with the ID gotten from the URL
    $article = get_articles_by_id($id);

    // Check if the article exists
    if (!$article) {
        flash("Article does not exist", "warning");
        redirect("home.php");
    }

    if(isset($_POST['likeButton'])){
        // Get the article ID and user ID and call the helper function to toggle the like
        $article_id = $id;
        $user_id = get_user_id();
        toggle_like($article_id, $user_id);
    }

    // Fetch the user's liked articles from the database
    $userLikedArticles = get_user_liked_articles(get_user_id());

    // Check if the user has liked the article
    $isLiked = in_array($id, array_column($userLikedArticles, 'news_id'));

    function convertDate($date){
        $date = date_create($date);
        return date_format($date, "m/d/Y");
    }
?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-6" style="height: 200px;">
            <div class="card mb-4">
                <div class="card-h-100">
                    <img class="card-img-top" id="articleImage" src="<?php echo $article['image_url'];?>" alt="Article Image">
                    <div class="card-body">
                        <h3 class="card-title" id="articleTitle"><?php echo $article['title'];?></h3>
                        <h5 class="card-text" id="publishDate"><?php echo convertDate($article['publish_date'])?></h5>
                        <h5 class="card-text" id="articleSource">Source: <?php echo $article['source_id'];?></h5>
                        <h5 class="card-text" id="articleCategory"><?php echo $article['category'];?></h5>
                        <h5 class="card-text" id="articleCountry"><?php echo $article['country'];?></h5>
                        <a id="articleLink" class="btn btn-outline-primary" href="<?php echo $article['link'];?>">Link to article</a>
                        <button type="submit" id="likeButton_<?php echo $article['id'];?>" name="likeButton" class="btn btn-outline-success" onclick="toggleLike(<?php echo $article['id'];?>)" value="<?php echo $article['id'];?>">
                            <i class="bi <?php echo ($isLiked ? 'bi-hand-thumbs-up-fill' : 'bi-hand-thumbs-up'); ?>"></i>
                            <span><?php echo ($isLiked ? 'Unlike' : 'Like'); ?></span>
                        </button>
                        <?php if($article['created_by'] == get_user_id() || has_role("Admin")) : ?>
                            <a id="articleEdit" class="btn btn-outline-warning" href="article_edit.php?id=<?php echo $article['id'];?>">Edit</a>
                            <a id="articleDelete" class="btn btn-outline-danger" href="article_delete.php?id=<?php echo $article['id'];?>">Delete</a>
                        <?php endif; ?>
                        <p class="card-text" id="articleDescription"><?php echo $article['content_description'];?></p>
                        <p class="card-text" id="articleContent"><?php echo $article['content'];?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function changeIcon(anchor){
        var icon = anchor.querySelector("i");
        icon.classList.toggle("bi-hand-thumbs-up-fill");
        icon.classList.toggle("bi-hand-thumbs-up");

        anchor.querySelector("span").innerHTML = icon.classList.contains("bi-hand-thumbs-up-fill") ? "Unlike" : "Like";
    }

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