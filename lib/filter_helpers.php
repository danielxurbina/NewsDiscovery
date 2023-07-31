<?php
function searchFilter($table, $search){
    $db = getDB();
    // get News Articles that match the search request and match it with the title of the article
    $query = "SELECT id, api_id, title, link, video_url, content_description, content, publish_date, image_url, source_id, category, country, manual_check, created_by, content_hash FROM $table WHERE title LIKE '%$search%' ORDER BY publish_date DESC";
    $stmt = $db->prepare($query);
    try{
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    } catch(PDOException $e){
        error_log("Error fetching articles from DB: " . var_export($e, true));
    }
}

function searchLikedArticles($table, $search, $user_id){
    $db = getDB();
    $query = "SELECT * FROM $table WHERE title LIKE :search AND id IN (SELECT news_id FROM UserNewsInteractions WHERE user_id = :user_id AND interaction_type = 'like')";
    $stmt = $db->prepare($query);
    $searchParam = "%$search%"; // Adding '%' to search both before and after the search term
    $stmt->bindValue(":search", $searchParam, PDO::PARAM_STR);
    $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
    try{
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        error_log("searchLikedArticles - Result: " . var_export($result, true));
        return $result;
    } catch(PDOException $e){
        error_log("Error fetching articles from DB: " . var_export($e, true));
    }
}