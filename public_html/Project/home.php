<?php
require(__DIR__ . "/../../partials/nav.php");

// If user is not logged in redirect to login page
if(!is_logged_in()){
    flash("You must be logged in to view this page", "warning");
    die(header("Location: login.php"));
}

?>

<div class="container mt-3">
    <div class="row">
        <h1> News </h1>
        <p> Welcome to the News page! </p>
        <p> Here you can view all the news articles that have been created. </p>
        <p> Type something in the input field to search the list of articles for specific items: </p>
    </div>
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

<div class="container">
        <?php 
            // Set the default number of articles to display
            $article_limit = 10;
            $articles = [];
            $categories = [];
            $countries = [];
            
           if(isset($_SESSION['article_limit'])){
                $article_limit = $_SESSION['article_limit'];
                $articles = get_articles($article_limit);
                error_log("Article Limit: " . var_export($articles, true));

                // Erase the session variable after it has been used so that if the user enters another number of articles to display, it will be used instead of the previous one
                unset($_SESSION['article_limit']);
            }
            // Check if the user has entered a number of articles to display
            else if (isset($_POST['articleLimit'])) {
                $article_limit = $_POST['articleLimit'];
                $_SESSION['article_limit'] = $article_limit;
                $articles = get_articles($article_limit);
                error_log("Article Limit xxxx: " . var_export($articles, true));
            }
            else if(isset($_POST['searchInput'])){
                $searchInput = $_POST['searchInput'];
                $articles = searchFilter('NewsArticles', $searchInput);
                // If the articles array is empty display a message that no articles were found
                if(empty($articles)){
                    flash("No articles found", "info");
                }
                error_log("Search Input: " . var_export($articles, true));
            }
            else{
                $articles = get_articles($article_limit);
                error_log("Articles yyyyy: " . var_export($articles, true));
            }

            // Fetch all categories from the database
            $categories = get_categories();

            // Fetch all countries from the database
            $countries = get_countries();

            error_log("Categories: " . var_export($categories, true));
            error_log("Countries: " . var_export($countries, true));

            // Loop through the articles and display each one
            foreach ($articles as $article) {
                error_log("Article: " . var_export($article, true));
                $queryParam = "article_" . $article['id'];
        ?>
                <div class="container mt-3">
                    <div class="card">
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
                            <h4 class="card-title"><?php echo $article['title']; ?></h4>
                            <p class="card-text"><?php echo $article['content_description']; ?></p>
                            <a href="article_details.php?id=<?php echo $article['id']; ?>" class="btn btn-primary">Read More</a>
                            <?php if ($article['created_by'] == get_user_id()) : ?>
                                <a href="article_edit.php?id=<?php echo $article['id']; ?>" class="btn btn-warning">Edit</a>
                                <a href="article_delete.php?id=<?php echo $article['id']; ?>" class="btn btn-danger">Delete</a>
                            <?php endif; ?>
                            <?php if(has_role("Admin") && $article['created_by'] != get_user_id()) : ?>
                                <a href="article_edit.php?id=<?php echo $article['id']; ?>" class="btn btn-warning">Edit</a>
                                <a href="article_delete.php?id=<?php echo $article['id']; ?>" class="btn btn-danger">Delete</a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
        <?php
            }
        ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
if (is_logged_in(true)) {
    //comment this out if you don't want to see the session variables
    error_log("Session data: " . var_export($_SESSION, true));
}
?>

<?php
require(__DIR__ . "/../../partials/flash.php");
?>