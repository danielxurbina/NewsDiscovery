<?php
require(__DIR__ . "/../../../partials/nav.php");

if(!has_role("Admin")){
    flash("You don't have permission to access this page");
    redirect("home.php");
}
?>

<?php
$article_limit = 10;
$news_ids = [];
$articles = [];
$userNewsInteractions = [];
$isSearched = false;
$articleNewsIDs = [];

$userNewsInteractions = get_all_user_liked_articles();
foreach($userNewsInteractions as $interaction){
    $news_ids[] = $interaction['news_id'];
}

error_log("News IDs: " . var_export($news_ids, true));

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['articleTitle'])){
        $articleTitle = $_POST['articleTitle'];
        if($articleTitle == ''){
            $userNewsInteractions = get_all_user_liked_articles();
        } else {
            $article = searchTitle($article_limit, $articleTitle);
            if($article == false){
                flash("Article does not exist", "warning");
                redirect("/Project/admin/articles_not_liked_by_users.php");
            } 
            else {
                $articleNewsIDs = array_column($article, 'id');
                $articles = get_articles_with_no_likes($article_limit, $articleNewsIDs, $news_ids);
                $isSearched = true;
            }
        }
    }

    if(isset($_POST['articleLimit'])){
        $article_limit = $_POST['articleLimit'];
        if($isSearched){
            $articles = get_articles_with_no_likes($article_limit, $articleNewsIDs, $news_ids);
            $isSearched = false;
        }
        else{
            $articles = get_articles_with_no_likes($article_limit, [], $news_ids);
        }
    }
}

$articles = get_articles_with_no_likes($article_limit, [], $news_ids);

?>
<h1>All Articles With No Likes</h1>
<form method="POST" id="filterForm" action="">
    <?php render_input(["type" => "search", "id"=>"articleTitle", "name" => "articleTitle", "placeholder" => "Search for an article"]); ?>
    <?php render_input(["type"=>"text", "id"=>"articleLimit", "placeholder"=>"Enter a number of articles to display (1-100)", "name"=>"articleLimit", "rules"=>["required"=>"false"]]);?>
    <button type="submit" class="btn btn-primary" onclick="validateFilter()">Submit</button>
</form>

<table class="table table-hover table-bordered caption-top">
    <caption>
        Total Number of Articles Not Liked by Users: <?php echo count($articles); ?>
    </caption>
    <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Article ID</th>
            <th scope="col">Title</th>
            <th scope="col">View Article</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $count = 0;
            foreach($articles as $article){  
                $count++;
        ?>
                <tr>
                    <th><?php echo $count; ?></th>
                    <th scope="row"><?php echo $article['id']?></th>
                    <td><?php echo $article['title']?></td>
                    <td>
                        <a href="/Project/article_details.php?id=<?php echo $article['id']; ?>" class="btn btn-primary">Read More</a>
                    </td>
                </tr>
        <?php
            }
        ?>
    </tbody>
</table>

<script>
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
</script>

<?php
require_once(__DIR__ . "/../../../partials/flash.php");
?>