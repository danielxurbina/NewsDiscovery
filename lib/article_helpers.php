<?php
function get_articles($article_limit)
{
    error_log("get_articles article_limit: " . var_export($article_limit, true));

    $db = getDB();
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

function validateURL($url, $hasError)
{
    // URLs are optional so if one enters a url it will check if it's a valid url and if it's not it will still be considered valid since it's optional.
    if(!empty($url)){
        $regex = "/^(ftp|http|https):\/\/[^ \"\']+$/";
        if(preg_match($regex, $url)){
            $hasError = false;
            return $hasError;
        } else {
            $hasError = true;
            return $hasError;
        }
    }

    $hasError = false;
    return $hasError;
}

function validateRequiredFields($fields, $hasError)
{
    foreach($fields as $field){
        if(empty($field)){
            $hasError = true;
            return $hasError;
        }
    }

    $hasError = false;
    return $hasError;
}

function validateDate($date, $hasError)
{
    // Check if the date is empty
    if(empty($date)){
        $hasError = true;
        return $hasError;
    }

    error_log("validateDate date: " . var_export($date, true));

    // Check if the date is in the correct format
    $dateValidationRegex = "/^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/";
    if(!preg_match($dateValidationRegex, $date)){
        $hasError = true;
        return $hasError;
    }

    error_log("validateDate date after regex: " . var_export($date, true));

    $hasError = false;
    return $hasError;
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

function save_data($table, $data, $ignore)
{
    $table = se($table, null, null, false);    
    $db = getDB();
    $query = "INSERT INTO NewsArticles ";
    $columns = array_filter(array_keys($data), function($x) use ($ignore) {
        return !in_array($x, $ignore);
    });
    $placeholders = array_map(fn ($x) => ":$x", $columns);
    $query .= "(" .join(",", $columns) .") VALUES (" . join(",", $placeholders) . ")";

    $params = [];
    foreach ($columns as $col){
        $params[":$col"] = $data[$col];
    }

    $stmt = $db->prepare($query);
    error_log("stmt: " . var_export($stmt, true));
    try{
        $stmt->execute($params);        
    } catch(PDOException $e){
        error_log(var_export($e->errorInfo, true));
        flash("An error ocurred saving data for table: " . $e->getMessage(), "danger");
    }
}

function updateArticles($table, $changes, $ignore, $id){
    $table = se($table, null, null, false);
    $db = getDB();
    error_log("Changes: " . var_export($changes, true));
    $query = "UPDATE $table SET ";
    $columns = array_filter(array_keys($changes), function($x) use ($ignore) {
        return !in_array($x, $ignore);
    });
    $query .= join(",", array_map(fn ($x) => "$x = :$x", $columns));
    $query .= " WHERE id = :id";
    $params = [];
    foreach ($columns as $col){
        $params[":$col"] = $changes[$col];
    }
    $params[":id"] = $id;
    $stmt = $db->prepare($query);
    error_log("stmt: " . var_export($stmt, true));
    try{
        $stmt->execute($params);
    } catch(PDOException $e){
        error_log(var_export($e->errorInfo, true));
        flash("An error ocurred saving data for table: " . $e->getMessage(), "danger");
    }
}

function check_duplicate($content_hash, $title){
    $db = getDB();
    $query = "SELECT id, api_id, title, link, video_url, content_description, content, publish_date, image_url, source_id, category, country, manual_check, content_hash FROM NewsArticles WHERE content_hash = :content_hash AND title = :title";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":content_hash", $content_hash);
    $stmt->bindValue(":title", $title);
    try{
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    } catch(PDOException $e){
        error_log("Error fetching articles from DB: " . var_export($e, true));
    }
    return [];
}

function delete_data($table, $id){
    $db = getDB();
    $stmt = $db->prepare("DELETE FROM $table WHERE id=:id");

    try{
        $stmt->execute([":id" => $id]);
    } catch(PDOException $e){
        error_log(var_export($e->errorInfo, true));
        flash("An error ocurred deleting data for table: " . $e->getMessage(), "danger");
    }
}