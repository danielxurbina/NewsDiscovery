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

    // Check if the article exits
    if(!$result){
        error_log("Article does not exist");
    }

    $userID = $result["created_by"];

    return $userID;
}

// this function is to get all articles liked by a user
function get_user_liked_articles($user_id = null){
    $db = getDB();
    $query = "SELECT news_id, user_id FROM UserNewsInteractions WHERE user_id = :user_id AND interaction_type = 'like'";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
    try{
        $stmt->execute();
        $likedArticles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $likedArticles;
    } catch(PDOException $e){
        error_log("Error fetching articles from DB: " . var_export($e, true));
    }    
}

// this function is to get all articles liked by all users
function get_all_user_liked_articles(){
    $db = getDB();
    $query = "SELECT news_id, user_id FROM UserNewsInteractions WHERE interaction_type = 'like'";
    $stmt = $db->prepare($query);
    try{
        $stmt->execute();
        $likedArticles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $likedArticles;
    } catch(PDOException $e){
        error_log("Error fetching articles from DB: " . var_export($e, true));
    }    
}

// this function is to get all articles with no likes
function get_articles_with_no_likes($article_limit, $news_ids = [], $news_ids_with_likes = []){
    $db = getDB();

    if(!empty($news_ids)){
        $news_ids_without_likes = array_diff($news_ids, $news_ids_with_likes);

        if(empty($news_ids_without_likes)){
            return [];
        }

        $inClause = "AND id IN (" . implode(",", $news_ids_without_likes) . ")";
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
        $inClause = "AND id NOT IN (" . implode(",", $news_ids_with_likes) . ")";
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
}

// this function is to get an article with no likes by the news ID passed in from a search input from the form
function get_article_with_no_likes($article_limit, $news_id, $news_ids_with_likes = []){
    $db = getDB();
    if(!in_array($news_id, $news_ids_with_likes)){
        $query = "SELECT * FROM NewsArticles WHERE id = :news_id ORDER BY created DESC LIMIT $article_limit";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":news_id", $news_id, PDO::PARAM_INT);
        try{
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch(PDOException $e){
            error_log("Error fetching articles from DB: " . var_export($e, true));
        }
    }
}

// this function is to get all articles created by a user
function get_user_created_articles($user_id){
    $db = getDB();
    $query = "SELECT * FROM NewsArticles WHERE created_by = :user_id ORDER BY created DESC";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
    try{
        $stmt->execute();
        $createdArticles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $createdArticles;
    } catch(PDOException $e){
        error_log("Error fetching articles from DB: " . var_export($e, true));
    }
}

// this function is to get user info by user id
function get_user_info($user_id){
    $db = getDB();
    $query = "SELECT * FROM Users WHERE id = :user_id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
    try{
        $stmt->execute();
        $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        return $userInfo;
    } catch(PDOException $e){
        error_log("Error fetching user info from DB: " . var_export($e, true));
    }
}

// this function is to get user info by username
function get_user_by_username($username){
    $db = getDB();
    $query = "SELECT * FROM Users WHERE username = :username";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":username", $username, PDO::PARAM_STR);
    try{
        $stmt->execute();
        $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        return $userInfo;
    } catch(PDOException $e){
        error_log("Error fetching user info from DB: " . var_export($e, true));
    }
}

// this function is used to get multiple user info at once
function get_multiple_user_infos($user_ids=[]){
    $db = getDB();
    $inClause = "AND id IN (" . implode(",", $user_ids) . ")";
    $query = "SELECT * FROM Users WHERE 1 $inClause";
    $stmt = $db->prepare($query);
    try{
        $stmt->execute();
        $userInfos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $userInfos;
    } catch(PDOException $e){
        error_log("Error fetching user info from DB: " . var_export($e, true));
    }
}