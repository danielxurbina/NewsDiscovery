<?php 
require(__DIR__ . "/../../partials/nav.php"); 
?>

<div class="container mt-3">
    <div class="row">
        <form method="POST" id="filterForm" action="">
            <div class="col">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="linkflexSwitchDefault" onclick="toggleInput('articleInput')">
                    <label class="form-check-label" for="flexSwitchDefault">Switch to enter the number of articles to display</label>
                </div> 
                <div id="articleInput" style="display: none;">
                    <?php render_input(["type"=>"text", "id"=>"articleLimit", "placeholder"=>"Enter a number of articles to display (1-100)", "name"=>"articleLimit", "rules"=>["required"=>"false"]]);?>
                    <button type="submit" class="btn btn-primary" onclick="validateFilter()">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col">
            <form method="POST" id="searchForm" action="">
                <input class="form-control" id="searchInput" name="searchInput" type="text" placeholder="Search..">
            </form>
        </div>
        <div class="col">
            <button type="button" id="searchButton" class="btn btn-primary" onclick="searchFunction()">Search</button>

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
    $article_limit = 10;
    $articles = [];
    $categories = [];
    $countries = [];
    $isLiked = false;

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    $no_of_records_per_page = $article_limit;
    $offset = ($page-1) * $no_of_records_per_page;
    $total_pages_sql = get_total_articles();
    $total_pages = ceil($total_pages_sql / $no_of_records_per_page);

    $articles = getPaginationArticles($page, $article_limit);

    // Fetch the user's liked articles from the database
    $userLikedArticles = get_user_liked_articles(get_user_id(), $article_limit);

    if(isset($_SESSION['article_limit'])){
        error_log("Session article limit: " . var_export($_SESSION['article_limit'], true));
        $article_limit = $_SESSION['article_limit'];
        $articles = getPaginationArticles($page, $article_limit);
        $total_pages = ceil($total_pages_sql / $article_limit);
    }
    
    if(isset($_SESSION['searchInput'])){
        error_log("Session search input: " . var_export($_SESSION['searchInput'], true));
        $searchInput = $_SESSION['searchInput'];
        $articles = searchTitle($article_limit, $searchInput, $page);
        $total_search_pages_sql = get_total_search_articles($searchInput);
        $total_pages = ceil($total_search_pages_sql / $article_limit);
        // If the articles array is empty display a message that no articles were found
        if(empty($articles)){
            flash("No articles found", "info");
        }
        error_log("Search Input: " . var_export($articles, true));
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Check if the user has entered a number of articles to display
        if (isset($_POST['articleLimit'])) {
            $article_limit = $_POST['articleLimit'];
            $_SESSION['article_limit'] = $article_limit;
            $articles = getPaginationArticles($page, $article_limit);
            $total_pages = ceil($total_pages_sql / $article_limit);
        }
        
        if(isset($_POST['searchInput'])){
            $searchInput = $_POST['searchInput'];
            $_SESSION['searchInput'] = $searchInput;
            $articles = searchTitle($article_limit, $searchInput, $page);
            $total_search_pages_sql = get_total_search_articles($searchInput);
            $total_pages = ceil($total_search_pages_sql / $article_limit);
            // If the articles array is empty display a message that no articles were found
            if(empty($articles)){
                flash("No articles found", "info");
            }
        }
    
        // Check if the user has liked/unliked an article
        if(isset($_POST['likeButton'])){
            $article_id = $_POST['articleId'];
            $user_id = get_user_id();
            toggle_like($article_id, $user_id);
        }
    }


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