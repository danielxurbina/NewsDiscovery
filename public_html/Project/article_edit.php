<?php
require(__DIR__ . "/../../partials/nav.php");
?>

<div class="container-fluid">
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
            redirect("home.php");
            flash("Article does not exist", "warning");
        }
    ?>
    <img src="<?php echo $result['image_url'];?>" alt="Article Image">
    <h1><?php echo $result['title'];?></h1>
    <h3><?php echo $result['publish_date'];?></h3>
    <h3>Source: <?php echo $result['source_id'];?></h3>
    <h3><?php echo $result['category'];?></h3>
    <h3><?php echo $result['country'];?></h3>
    <a class="btn btn-primary" href="<?php echo $result['link'];?>">Link to article</a>
    <p><?php echo $result['content_description'];?></p>
    <p><?php echo $result['content'];?></p>
</div>

<?php require(__DIR__ . "/../../partials/flash.php"); ?>