<?php
require(__DIR__ . "/../../../partials/nav.php");

if(!has_role("Admin")){
    flash("You don't have permission to access this page");
    redirect("home.php");
}
?>

<?php
$article_limit = 25;
$users = [];
$articles = [];
$searchArticleIDs = [];
$userLikedArticles = [];
$likedArticlesNewsIDs = [];

if(isset($_POST['articleTitle'])){
    $articleTitle = $_POST['articleTitle'];
    if($articleTitle == ''){
        flash("Article title cannot be empty", "warning");
        redirect("/Project/admin/assign_likes_to_articles.php");
    } 
    else {
        $articles = searchTitle($article_limit, $articleTitle);
        if($articles == false){
            flash("Article does not exist", "warning");
            redirect("/Project/admin/assign_likes_to_articles.php");
        }

        $searchArticleIDs = array_column($articles, 'id');
    }
}

if(isset($_POST['filterUsername'])){
    $username = $_POST['filterUsername'];
    if($username == ''){
        flash("Username cannot be empty", "warning");
        redirect("/Project/admin/assign_likes_to_articles.php");
    }
    else{
        $users = searchPartiallyMatchedUser($article_limit, $username);
        if($users == false){
            flash("User does not exist", "warning");
            redirect("/Project/admin/assign_likes_to_articles.php");
        }
        $userIDs = array_column($users, 'id');
        // Get the user liked articles for each user in the array
        $db = getDB();
        $inClause = implode(',', array_fill(0, count($userIDs), '?'));
        $query = "SELECT * FROM UserNewsInteractions WHERE user_id IN ($inClause) AND interaction_type = 'like'";
        $stmt = $db->prepare($query);

        try{
            $stmt->execute($userIDs);
            $userLikedArticles = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $likedArticlesNewsIDs = array_column($userLikedArticles, 'news_id');
        }
        catch(Exception $e){
            error_log($e->getMessage());
        }
    }
}

if (isset($_POST["selectedUsers"]) && isset($_POST["selectedArticles"])) {
    // Get the selected user IDs and article IDs as arrays
    $selectedUsers = explode(",", $_POST["selectedUsers"]);
    $selectedArticles = explode(",", $_POST["selectedArticles"]);

    foreach($selectedArticles as $articleID){
        foreach($selectedUsers as $userID){
            toggle_like($articleID, $userID);
        }
    }
}
?>

<div class="container-fluid">
    <h1> Assign Likes to Articles</h1>
    <form method="POST" id="filterForm" action="">
        <?php render_input(["type" => "search", "id"=>"articleTitle", "name" => "articleTitle", "placeholder" => "Search for an article"]); ?>
        <?php render_input(["type" => "search", "id"=>"filterUsername", "name" => "filterUsername", "placeholder" => "Search for a specific user"]); ?>
        <button type="submit" class="btn btn-primary" onclick="validateFilter()">Search</button>
    </form>
    <form method="POST" id="applyLikes">
        <button type="submit" class="btn btn-success" onclick="submitFormWithSelectedArticlesAndUsers()">Assign Likes</button>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-hover table-bordered caption-top">
                    <caption>
                        Total Number of Articles being displayed: <?php echo count($articles); ?>
                    </caption>
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Checkbox</th>
                            <th scope="col">ID</th>
                            <th scope="col">Article Title</th>
                            <th scope="col">Liked By</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($articles as $article) : ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="articles[]" value="<?php echo $article['id']; ?>" onclick="toggleCheckbox(this)">
                                </td>
                                <td> <?php echo $article['id']; ?></td>
                                <td><?php echo $article['title']; ?></td>
                                <td>
                                    <?php foreach($userLikedArticles as $userLikedArticle) : ?>
                                        <?php if($userLikedArticle['news_id'] == $article['id']) : ?>
                                            <?php foreach($users as $user) : ?>
                                                <?php if($user['id'] == $userLikedArticle['user_id']) : ?>
                                                    <?php echo $user['username']; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-hover table-bordered caption-top">
                    <caption>
                        Total Number of Users being displayed: <?php echo count($users); ?>
                    </caption>
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Checkbox</th>
                            <th scope="col">ID</th>
                            <th scope="col">Username</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $user) : ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="users[]" value="<?php echo $user['id']; ?>" onclick="toggleUserCheckbox(this)">
                                </td>
                                <td><?php echo $user['id']?></td>
                                <td><?php echo $user['username']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>

<script>
    // Initialize an empty array to store the selected article IDs
    var selectedArticles = [];
    var selectedUsers = [];

    function toggleCheckbox(checkbox){
        if(checkbox.checked){
            // Add the value (article ID) to the selectedArticles array
            selectedArticles.push(checkbox.value);
        } else {
            // Remove the value (article ID) from the selectedArticles array
            var index = selectedArticles.indexOf(checkbox.value);
            if (index !== -1) {
                selectedArticles.splice(index, 1);
            }
        }
    }

    function toggleUserCheckbox(checkbox) {
        if (checkbox.checked) {
            // Add the value (user ID) to the selectedUsers array
            selectedUsers.push(checkbox.value);
        } 
        else {
            // Remove the value (user ID) from the selectedUsers array
            var index = selectedUsers.indexOf(checkbox.value);
            if (index !== -1) {
                selectedUsers.splice(index, 1);
            }
        }
    }

    function submitFormWithSelectedArticlesAndUsers() {
        // Get the form element
        var form = document.getElementById('applyLikes');

        // Create hidden input elements to hold the selected article IDs and user IDs
        var articleInput = document.createElement('input');
        articleInput.type = 'hidden';
        articleInput.name = 'selectedArticles';
        articleInput.value = selectedArticles.join(',');

        var userInput = document.createElement('input');
        userInput.type = 'hidden';
        userInput.name = 'selectedUsers';
        userInput.value = selectedUsers.join(',');

        // Append the hidden inputs to the form
        form.appendChild(articleInput);
        form.appendChild(userInput);

        // Submit the form
        form.submit();
    }
</script>

<?php require_once(__DIR__ . "/../../../partials/flash.php"); ?>