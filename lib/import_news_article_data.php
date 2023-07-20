<?php 
function insert_article_into_db($db, $article, $createdBy, $manualCheck)
{
    // Prepare the SQL query 
    $query = "INSERT INTO NewsArticles(title, link, video_url, description, content, publish_date, image_url, source_id, category, country, created_by, manual_check, api_id) VALUES ";
    $query .= "(:title, :link, :video_url, :description, :content, :publish_date, :image_url, :source_id, :category, :country, :created_by, :manual_check, :api_id)";
    
    // Prepare the statement
    $stmt = $db->prepare($query);

    // Bind the parameters
    $stmt->bindValue(":title", $article["title"], PDO::PARAM_STR);
    $stmt->bindValue(":link", $article["link"] ?? null, PDO::PARAM_STR);
    $stmt->bindValue(":video_url", $article["video_url"] ?? null, PDO::PARAM_STR);
    $stmt->bindValue(":description", $article["description"], PDO::PARAM_STR);
    $stmt->bindValue(":content", $article["content"], PDO::PARAM_STR);
    $stmt->bindValue(":publish_date", $article["pubDate"], PDO::PARAM_STR);
    $stmt->bindValue(":image_url", $article["image_url"] ?? null, PDO::PARAM_STR);
    $stmt->bindValue(":source_id", $article["source_id"], PDO::PARAM_STR);
    $stmt->bindValue(":category", $article["category"], PDO::PARAM_STR);
    $stmt->bindValue(":country", $article["country"], PDO::PARAM_STR);
    $stmt->bindValue(":created_by", $createdBy, PDO::PARAM_INT);
    $stmt->bindValue(":manual_check", $manualCheck, PDO::PARAM_BOOL);
    $stmt->bindValue(":api_id", $manualCheck ? null : $article["api_id"], PDO::PARAM_STR);

    // Execute the statement
    try{
        $stmt->execute();
    }
    catch(Exception $e){
        error_log(var_export($e, true));
    }
}
?>