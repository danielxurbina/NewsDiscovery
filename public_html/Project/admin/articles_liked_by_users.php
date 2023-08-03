<?php
require(__DIR__ . "/../../../partials/nav.php");

if(!has_role("Admin")){
    flash("You don't have permission to access this page");
    redirect("home.php");
}
?>


<?php
$article_limit = 10;
$userIds = [];
$unlikeUserIds = [];
$news_ids = [];
$articles = [];
$users = [];
$userNewsInteractions = [];
$articleLikesCount = [];

if(isset($_SESSION['filter_applied'])){
    unset($_SESSION['filter_applied']);
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['filterUsername'])){
        $username = $_POST['filterUsername'];
        if($username == ''){
            $userNewsInteractions = get_all_user_liked_articles();
        } else{
            // Get the user info from the username
            $user = get_user_by_username($username);

            if($user == false){
                flash("User does not exist", "warning");
                redirect("/Project/admin/articles_liked_by_users.php");
            } else {
                // Get the user's ID
                $userID = $user['id'];
                // Get the user's liked articles
                $userNewsInteractions = get_user_liked_articles($userID);
                $_SESSION['filter_applied'] = true;
            }
        }
    } 

    if(isset($_POST['articleLimit'])){
        $article_limit = $_POST['articleLimit'];
        foreach($userNewsInteractions as $interaction){
            $userIds[] = $interaction['user_id'];
            $news_ids[] = $interaction['news_id'];
            
            // Get the articles and users
            $articles = get_articles($article_limit, $news_ids);
            $users = get_multiple_user_infos($userIds);
        }
    } 
    else{
        foreach($userNewsInteractions as $interaction){
            $userIds[] = $interaction['user_id'];
            $news_ids[] = $interaction['news_id'];
            
            $articles = get_articles($article_limit, $news_ids);
            $users = get_multiple_user_infos($userIds);
        }
    }

    if(isset($_POST['unlikeButton'])){
        // Get the article id
        $article_id = $_POST['articleId'];
    
        // Get the list of users who liked the article
        foreach($userNewsInteractions as $interaction){
            if($interaction['news_id'] == $article_id){
                // Add the user id to the list of users who liked the article and append it to the user ids array
                $unlikeUserIds[] = $interaction['user_id'];
            }
        }
    
        // Remove the likes from the article
        removeArticleLikes($unlikeUserIds, $article_id);
        flash("Succesfully removed all likes for Article ID #$article_id", "success");
        redirect("/Project/admin/articles_liked_by_users.php");
    }

    if(isset($_POST['delete'])){
        $username = $_POST['username'];
        $user = get_user_by_username($username);
        $userID = $user['id'];

        // // Remove all likes for that user
        removeAllLikes($userID);
        flash("All liked articles have been removed for $username", "success");
        redirect("/Project/admin/articles_liked_by_users.php");
    }
}

// Count the number of likes for each article
foreach($userNewsInteractions as $interaction){
    $newsId = $interaction['news_id'];

    if(!isset($articleLikesCount[$newsId])){
        $articleLikesCount[$newsId] = 1;
    } else {
        $articleLikesCount[$newsId]++;
    }
}

?>

<h1>All User Liked Articles</h1>
<form method="POST" id="filterForm" action="">
        <?php render_input(["type" => "search", "id"=>"filterUsername", "name" => "filterUsername", "placeholder" => "Search for a specific user"]); ?>
        <?php render_input(["type"=>"text", "id"=>"articleLimit", "placeholder"=>"Enter a number of articles to display (1-100)", "name"=>"articleLimit", "rules"=>["required"=>"false"]]);?>
        <button type="submit" class="btn btn-primary" onclick="validateFilter()">Submit</button>
</form>
<?php 
    if(isset($_SESSION['filter_applied'])){
?>
        <form method="POST" id="deleteForm" action="">
            <!-- Delete all articles associated with the user -->
            <input type="hidden" name="username" value=<?php echo $username?>>
            <button type="submit" name="delete" class="btn btn-danger" onclick="deleteFunction()">
                Remove all likes for <?php echo $username; ?>
            </button>
        </form>
<?php 
    }
?>
<table class="table table-hover table-bordered caption-top">
    <caption>
        Total Number of Articles being liked by users: <?php echo count($articles); ?>
    </caption>
    <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Article ID</th>
            <th scope="col">Title</th>
            <th scope="col">Likes</th>
            <th scope="col">View Article</th>
            <th scope="col">Unlike</th>
            <th scope="col">Usernames</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $count = 0;
            foreach($articles as $article): 
                $newsId = $article['id'];
                // Get the number of likes for the article
                $likeCount = isset($articleLikesCount[$newsId]) ? $articleLikesCount[$newsId] : 0;
        ?>
                <tr>
                    <th><?php $count++; echo $count; ?></th>
                    <th scope="row">
                        <?php echo $article['id']; ?>
                    </th>
                    <td>
                        <?php echo $article['title']; ?>
                    </td>
                    <td>
                        <?php echo $likeCount; ?>
                    </td>            
                    <td>
                        <a href="/Project/article_details.php?id=<?php echo $article['id']; ?>" class="btn btn-primary">Read More</a>
                    </td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="articleId" value="<?php echo $article['id']; ?>">
                            <button type="submit" name="unlikeButton" class="btn btn-danger">Unlike</button>
                        </form>
                    </td>
                    <td>
                        <?php 
                            // Get the usernames of the users who liked the article
                            foreach($userNewsInteractions as $interaction){
                                if($interaction['news_id'] == $article['id']){
                                    foreach($users as $user){
                                        if($user['id'] == $interaction['user_id']){
                                            ?>
                                                <a href="/Project/profile.php?id=<?php echo $user['id']; ?>"><?php echo $user['username']; ?></a>
                                            <?php
                                        }
                                    }
                                }
                            }
                        ?>
                    </td>
                </tr>
        <?php 
            endforeach; 
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