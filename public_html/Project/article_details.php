<?php
require(__DIR__ . "/../../partials/nav.php");

// If user is not logged in redirect to login page
if(!is_logged_in()){
    flash("You must be logged in to view this page", "warning");
    die(header("Location: login.php"));
}

?>

<div class="container">
    <?php 
        // Extract id from url
        $id = $_GET['id'];

        error_log("ID: $id");

        // Fetch from the DB with the ID gotten from the URL
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM NewsArticles WHERE id = :id");
        error_log("stmt after prepare: " . var_export($stmt, true));
        $r = $stmt->execute([":id" => $id]);
        error_log("r after execute: " . var_export($r, true));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        error_log("Result: " . var_export($result, true));

        // Check if the article exists
        if (!$result) {
            flash("Article does not exist", "warning");
            redirect("home.php");
        }
    ?>
    <div class="row">
        <img id="articleImage" src="<?php echo $result['image_url'];?>" alt="Article Image">
    </div>
    <div class="row">
        <h1 id="articleTitle"><?php echo $result['title'];?></h1>
    </div>
    <div class="row">
        <div class="col">
            <h3 id="publishDate"><?php echo $result['publish_date'];?></h3>

        </div>
        <div class="col">
            <a id="articleLink" class="btn btn-primary" href="<?php echo $result['link'];?>">Link to article</a>
            <?php if($result['created_by'] == get_user_id() || has_role("Admin")) : ?>
                <a id="articleEdit" class="btn btn-warning" href="article_edit.php?id=<?php echo $result['id'];?>">Edit</a>
                <a id="articleDelete" class="btn btn-danger" href="article_delete.php?id=<?php echo $result['id'];?>">Delete</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h3 id="articleSource">Source: <?php echo $result['source_id'];?></h3>
        </div>
        <div class="col">
            <h3 id="articleCategory"><?php echo $result['category'];?></h3>
        </div>
        <div class="col">
            <h3 id="articleCountry"><?php echo $result['country'];?></h3>
        </div>
    </div>
    <div class="row">
        <p id="articleDescription"><?php echo $result['content_description'];?></p>
    </div>
    <div class="row">
        <p id="articleContent"><?php echo $result['content'];?></p>
    </div>
</div>

<?php require(__DIR__ . "/../../partials/flash.php"); ?>