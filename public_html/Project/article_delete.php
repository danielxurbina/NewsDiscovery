<?php
require(__DIR__ . "/../../partials/nav.php");

// If user is not logged in redirect to login page
if(!is_logged_in()){
    flash("You must be logged in to view this page", "warning");
    redirect("login.php");
}
?>

<?php 
    // Extract id from url
    $id = $_GET['id'];
    if(isset($_GET['articleLimit'])){
        $article_limit = $_GET['articleLimit'];
        error_log("Article Limit: " . var_export($article_limit, true));
    }
    $canDelete = false;

    // Fetch from the DB with the ID gotten from the URL
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM NewsArticles WHERE id = :id");
    $r = $stmt->execute([":id" => $id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    error_log("Result: " . var_export($result, true));
    // Check if the article exists
    if (!$result) {
        flash("Article does not exist", "warning");
        redirect("home.php");
    }

    // If the ID is invalid, redirect to home page and display a message that the ID was invalid
    if(has_role("Admin")){
        $canDelete = true;
    }
    else if($result["created_by"] == get_user_id()){
        $canDelete = true;
    }
    else{
        flash("You don't have permission to delete this article", "warning");
        redirect("home.php");
    }


    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['delete'])){
            $id = $_POST['id'];
            delete_data("NewsArticles", $id);
            flash("Article deleted successfully", "success");
            if(!empty($article_limit)){
                redirect("home.php?articleLimit=$article_limit");
            } else {
                redirect("home.php");
            }
        }
    }
?>

<section>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="card" style="width: 50rem;">
                <div class="header">
                    <h1> Delete Article Confirmation</h1>
                    <h3> Are you sure you want to delete the article? This action cannot be undone.</h3>
                    <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $id;?>"/>
                            <input type="submit" class="btn btn-danger" name="delete" value="Delete"/>
                    </form>
                </div>
                <img src="<?php echo $result['image_url'];?>" alt="Article Image">
                <div class="body">
                    <h5 class="card-title"><?php echo $result['title'];?></h5>
                    <h3 class="card-text">Source: <?php echo $result['source_id'];?></h3>
                    <h3 class="card-text"><?php echo $result['category'];?></h3>
                    <h3 class="card-text"><?php echo $result['country'];?></h3>
                    <a href="article_details.php?id=<?php echo $result['id']; ?>" class="btn btn-outline-primary">Read More</a>
                    <p class="card-text"><?php echo $result['content_description'];?></p>
                    <p class="card-text"><?php echo $result['content'];?></p>
                </div>
                <div class="card-footer text-muted">Published on: <?php echo convertDate($result['publish_date']);?></div>
            </div>
        </div>
    </div>
</section>

<?php require(__DIR__ . "/../../partials/flash.php"); ?>