<?php
require(__DIR__ . "/../../partials/nav.php");

// If user is not logged in redirect to login page
if(!is_logged_in()){
    flash("You must be logged in to view this page", "warning");
    die(header("Location: login.php"));
}
?>

<div class="container-fluid">
    <?php 
        // Extract id from url
        $id = $_GET['id'];
        $canDelete = false;

        // Fetch from the DB with the ID gotten from the URL
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM NewsArticles WHERE id = :id");
        $r = $stmt->execute([":id" => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

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
                redirect("home.php");
            }
        }
    ?>
    <div class="container">
        <div class="row">
            <h1> Delete Article Confirmation</h1>
        </div>
        <div class="row">
            <h3> Are you sure you want to delete the article? This action cannot be undone.</h3>

        </div>
        <div class="row">
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $id;?>"/>
                <input type="submit" class="btn btn-danger" name="delete" value="Delete"/>
            </form>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <img src="<?php echo $result['image_url'];?>" alt="Article Image">
        </div>
        <div class="row">
            <h1><?php echo $result['title'];?></h1>
        </div>
        <div class="row">
            <div class="col">
                <h3><?php echo $result['publish_date'];?></h3>
            </div>
            <div class="col">
                <a class="btn btn-primary" href="<?php echo $result['link'];?>">Link to article</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h3>Source: <?php echo $result['source_id'];?></h3>
            </div>
            <div class="col">
                <h3><?php echo $result['category'];?></h3>
            </div>
            <div class="col">
                <h3><?php echo $result['country'];?></h3>
            </div>
        </div>
        <div class="row">
            <p><?php echo $result['content_description'];?></p>
        </div>
        <div class="row">
            <p><?php echo $result['content'];?></p>
        </div>
    </div>
</div>

<?php require(__DIR__ . "/../../partials/flash.php"); ?>