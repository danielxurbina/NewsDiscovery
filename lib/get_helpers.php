<?php
function get_articles($article_limit, $ids = [])
{
    $db = getDB();
    if(!empty($ids)){
        $inClause = "AND id IN (" . implode(",", $ids) . ")";
        $query = "SELECT * FROM NewsArticles WHERE 1 $inClause ORDER BY created DESC LIMIT $article_limit";
        $stmt = $db->prepare($query);

        try{
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch(PDOException $e){
            error_log("Error fetching articles from DB: " . var_export($e, true));
        }
    }
    else{
        error_log("get_articles article_limit: " . var_export($article_limit, true));
        $query = "SELECT * FROM NewsArticles ORDER BY created DESC LIMIT $article_limit";
        $stmt = $db->prepare($query);
         try{
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch(PDOException $e){
            error_log("Error fetching articles from DB: " . var_export($e, true));
        }
    }
}

function get_articles_by_id($id){
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM NewsArticles WHERE id = :id");
    $stmt->execute([":id"=>$id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    error_log("result: " . var_export($result, true));
    return $result;
}

function get_categories(){
    $db = getDB();
    $query = "SELECT DISTINCT category FROM NewsArticles";
    $stmt = $db->prepare($query);
    try{
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    } catch(PDOException $e){
        error_log("Error fetching categories from DB: " . var_export($e, true));
    }
}

function get_countries(){
    $db = getDB();
    $query = "SELECT DISTINCT country FROM NewsArticles";
    $stmt = $db->prepare($query);
    try{
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    } catch(PDOException $e){
        error_log("Error fetching countries from DB: " . var_export($e, true));
    }
}

function getUserID($table, $id){
    $db = getDB();
    $stmt = $db->prepare("SELECT created_by FROM $table WHERE id = :id");
    $r = $stmt->execute([":id"=>$id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    error_log("result: " . var_export($result, true));

    // Check if the article exits
    if(!$result){
        error_log("Article does not exist");
    }

    $userID = $result["created_by"];

    return $userID;
}

function get_user_liked_articles($user_id){
    $db = getDB();
    $query = "SELECT news_id FROM UserNewsInteractions WHERE user_id = :user_id AND interaction_type = 'like'";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
    try{
        $stmt->execute();
        $likedArticles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        error_log("get_user_liked_articles - Result: " . var_export($likedArticles, true));
        return $likedArticles;
    } catch(PDOException $e){
        error_log("Error fetching articles from DB: " . var_export($e, true));
    }    
}

function get_user_created_articles($user_id){
    $db = getDB();
    $query = "SELECT * FROM NewsArticles WHERE created_by = :user_id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
    try{
        $stmt->execute();
        $createdArticles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        error_log("get_user_created_articles - Result: " . var_export($createdArticles, true));
        return $createdArticles;
    } catch(PDOException $e){
        error_log("Error fetching articles from DB: " . var_export($e, true));
    }
}

function get_user_info($user_id){
    $db = getDB();
    $query = "SELECT * FROM Users WHERE id = :user_id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
    try{
        $stmt->execute();
        $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        error_log("get_user_info - Result: " . var_export($userInfo, true));
        return $userInfo;
    } catch(PDOException $e){
        error_log("Error fetching user info from DB: " . var_export($e, true));
    }
}