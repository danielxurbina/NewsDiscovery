<?php
require(__DIR__ . "/../../partials/nav.php");
if(!is_logged_in()){
    flash("You must be logged in to access this page", "warning");
    redirect("login.php");
}

// default article limit
$article_limit = 10;
$articles = [];
$isLiked = false;
$userId = get_user_id();
$likedArticles = get_user_liked_articles($userId);

if(isset($_POST['likeButton'])){
    $article_id = $_POST['articleId'];
    toggle_like($article_id, $userId);
    redirect("my_saved_articles.php");
}

if(!empty($likedArticles))
{
    $likedIds = array_column($likedArticles, 'news_id');
    error_log("Liked Articles IDs: " . var_export($likedIds, true));

    if(isset($_POST['articleLimit'])){
        $article_limit = $_POST['articleLimit'];
        $articles = get_articles($article_limit, $likedIds);
        error_log("Article Limit Set: " . var_export($likedArticles, true));
    }
    else if(isset($_POST['searchInput'])){
        $searchInput = $_POST['searchInput'];
        $articles = searchLikedArticles('NewsArticles', $searchInput, $userId);
        error_log("Search Input: " . var_export($articles, true));
        if(empty($articles)){
            flash("No articles found", "info");
        }
    }
    else{
        $articles = get_articles($article_limit, $likedIds);
        error_log("Default Article Limit: " . var_export($articles, true));
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['delete'])){
            removeAllLikes($userId);
            flash("All liked articles have been removed", "success");
            redirect("my_saved_articles.php");
        }
    }
} 
?>

<!-- Display the total number of articles displayed on the page -->
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
<h4 class="bg-light p-2 border-top border-bottom">Displaying <?php echo count($articles); ?> articles</h4>
<form method="POST" id="deleteForm" action="">
    <!-- Delete all articles associated with the user -->
    <button type="submit" name="delete" class="btn btn-danger" onclick="deleteFunction()">Remove all likes</button>
</form>

<?php
foreach($articles as $article){
    $queryParam = "article_" . $article['id'];
    $isLiked = in_array($article['id'], array_column($likedArticles, 'news_id'));
    error_log("Is Liked: " . var_export($isLiked, true));
?>
    <div class="row">
        <div class="col-xl-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <?php
                                // Check if the article has a valid image_url
                                if (!empty($article['image_url'])) {
                                    ?>
                                    <img src="<?php echo $article['image_url']; ?>" class="card-img-top" alt="<?php echo $article['title']; ?>" style="width:45px; height: 45px">
                                    <?php
                                } else {
                                    // If image_url is null, display a random image from the specified URL
                                    ?>
                                    <img src="https://source.unsplash.com/user/c_v_r/?<?php echo $queryParam; ?>" class="card-img-top" alt="<?php echo $article['title']; ?>" style="width:45px; height: 45px">
                                    <?php
                                }
                            ?>
                            <div class="ms-3">
                                <p class="fw-bold mb-1"><?php se($article['title']); ?></p>
                                <p class="text-muted mb-0"><?php se($article['content_description']); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-0 bg-light p-2 d-flex justify-content-around">
                        <a href="article_details.php?id=<?php echo $article['id']; ?>" class="btn btn-link m-0 text-reset" role="button" data-ripple-color="primary" style="text-decoration: none; color: inherit">
                            Read More
                            <i class="bi bi-newspaper ms-2"></i>
                        </a>
                        <form method="POST" id="likeButton" action="">
                            <input type="hidden" name="articleId" value="<?php echo $article['id']; ?>">
                            <button type="submit" name="likeButton" class="btn btn-link m-0 text-reset" data-ripple-color="primary" style="text-decoration: none; color: inherit">
                                <i class="bi <?php echo ($isLiked ? 'bi-hand-thumbs-up-fill ms-2' : 'bi-hand-thumbs-up ms-2'); ?>"></i>
                                <span><?php echo ($isLiked ? 'Unlike' : 'Like'); ?></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }?>

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
require(__DIR__ . "/../../partials/flash.php");
?>