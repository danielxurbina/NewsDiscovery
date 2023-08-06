<?php 
require(__DIR__ . "/../../partials/nav.php"); 
?>
<style>
    /* Custom CSS to match button height with text input height */
    #searchButton {
        height: 38px;
    }
</style>

<div class="row">
    <div class="mx-auto col-10 col-md-8 col-lg-6">
        <form method="GET" id="filterForm" action="home.php">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="linkflexSwitchDefault" onclick="toggleInput('articleInput')">
                <label class="form-check-label" for="flexSwitchDefault">Switch to enter the number of articles to display</label>
            </div>
            <div id="articleInput" style="display: none;">
                <?php render_input(["type"=>"text", "id"=>"articleLimit", "placeholder"=>"Enter a number of articles to display (1-100)", "name"=>"articleLimit", "rules"=>["required"=>"false"]]);?>
                <button type="submit" class="btn btn-primary" onclick="validateFilter()">Submit</button>
            </div>
        </form>
        <div class="d-flex justify-content-between">
            <form method="GET" id="searchForm" action="home.php" class="flex-grow-1">
                <input class="form-control" id="searchInput" name="searchInput" type="text" placeholder="Search..">
            </form>
            <button type="button" id="searchButton" class="btn btn-primary ml-2" onclick="searchFunction()">Search</button>
        </div>
    </div>
</div>

<?php
    // If user is not logged in redirect to login page
    if(!is_logged_in()){
        flash("You must be logged in to view this page", "warning");
        redirect("login.php");
    }

    // Set the default number of articles to display
    $article_limit = 0;
    $articles = [];
    $categories = [];
    $countries = [];
    $isLiked = false;
    $no_of_records_per_page = 10; $total_pages = 0;
    $total_pages_sql = get_total_articles();
    
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    
    // check if the user has submitted the article limit form
    if(isset($_GET['articleLimit'])){
        $article_limit = $_GET['articleLimit'];
        $articles = getPaginationArticles($page, $article_limit);
        $total_pages = ceil($total_pages_sql / $article_limit);
    }
    else if(isset($_GET['searchInput'])){
        $searchInput = $_GET['searchInput'];
        $articles = searchTitle($no_of_records_per_page, $searchInput, $page);
        $total_search_pages_sql = get_total_search_articles($searchInput);
        $total_pages = ceil($total_search_pages_sql / $no_of_records_per_page);
        // If the articles array is empty display a message that no articles were found
        if(empty($articles)){
            flash("No articles found", "info");
        }
    }
    else{
        $articles = getPaginationArticles($page, $no_of_records_per_page);
        $total_pages_sql = get_total_articles();
        $total_pages = ceil($total_pages_sql / $no_of_records_per_page);
    }
    
    // Check if the user has liked/unliked an article
    if(isset($_POST['likeButton'])){
        $article_id = $_POST['articleId'];
        $user_id = get_user_id();
        toggle_like($article_id, $user_id);
    }
    
    // Fetch the user's liked articles from the database
    $userLikedArticles = get_user_liked_articles(get_user_id(), $article_limit);

?>
<?php include_once (__DIR__ . "/../../lib/pagination.php"); ?>

<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php    
        // Loop through the articles and display each one
        foreach ($articles as $article) {
            error_log("Article: " . var_export($article, true));
            $queryParam = "article_" . $article['id'];
            // Check if the article's id exists in $userLikedArticles
            $isLiked = in_array($article['id'], array_column($userLikedArticles, 'news_id'));
    ?>
            <div class="col">
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
                        <h5 class="card-title"><?php echo $article['title']; ?></h5>
                        <p class="card-text"><?php echo $article['content_description']?></p>
                        <a href="article_details.php?id=<?php echo $article['id']; ?>" class="btn btn-outline-primary">Read More</a>
                        <button type="submit" id="likeButton_<?php echo $article['id'];?>" name="likeButton" class="btn btn-outline-success" onclick="toggleLike(<?php echo $article['id'];?>)" value="<?php echo $article['id'];?>">
                            <i class="bi <?php echo ($isLiked ? 'bi-hand-thumbs-up-fill' : 'bi-hand-thumbs-up'); ?>"></i>
                            <span><?php echo ($isLiked ? 'Unlike' : 'Like'); ?></span>
                        </button>
                        <?php if ($article['created_by'] == get_user_id()) : ?>
                            <a href="article_edit.php?id=<?php echo $article['id']; ?>" class="btn btn-outline-warning">Edit</a>
                            <?php if(isset($_GET['articleLimit'])) : ?>
                                <a href="article_delete.php?id=<?php echo $article['id']; ?>&articleLimit=<?php echo $_GET['articleLimit']; ?>" class="btn btn-outline-danger">Delete</a>
                            <?php else : ?>
                                <a href="article_delete.php?id=<?php echo $article['id']; ?>" class="btn btn-outline-danger">Delete</a>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(has_role("Admin") && $article['created_by'] != get_user_id()) : ?>
                            <a href="article_edit.php?id=<?php echo $article['id']; ?>" class="btn btn-outline-warning">Edit</a>
                            <?php if(isset($_GET['articleLimit'])) : ?>
                                <a href="article_delete.php?id=<?php echo $article['id']; ?>&articleLimit=<?php echo $_GET['articleLimit']; ?>" class="btn btn-outline-danger">Delete</a>
                            <?php else : ?>
                                <a href="article_delete.php?id=<?php echo $article['id']; ?>" class="btn btn-outline-danger">Delete</a>
                            <?php endif; ?>
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

<script>
    function toggleInput(inputId){
        var input = document.getElementById(inputId);
        if(input.style.display === "none"){
            console.log("toggle on");
            input.style.display = "block";
        } else {
            console.log("toggle off");
            input.style.display = "none";
        }
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

    function validateFilter() {
        clearFlashMessages();
        event.preventDefault()
        var x = document.forms["filterForm"]["articleLimit"].value;
        if(x > 100 || x < 1){
            flash("Please enter a number between 1 and 100", "warning");
            return false;
        }
        console.log("Form validated")
        
        // submit the form
        document.getElementById("filterForm").submit();
    }

    function searchFunction(){
        clearFlashMessages();
        event.preventDefault()
        var input = document.getElementById("searchInput").value;
        
        if(input == ""){
            alert("Please enter a search term");
            return false;
        }

        console.log("Search term: " + input);
        
        // submit the form
        document.getElementById("searchForm").submit();
    }
</script>

<?php
if (is_logged_in(true)) {
    //comment this out if you don't want to see the session variables
    error_log("Session data: " . var_export($_SESSION, true));
}
?>

<?php require(__DIR__ . "/../../partials/flash.php"); ?>