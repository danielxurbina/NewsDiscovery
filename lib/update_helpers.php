<?php
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

function user_has_liked($article_id, $user_id){
    error_log("Checking if user: " . $user_id . " has liked article: " . $article_id);
    $db = getDB();
    $query = "SELECT * FROM UserNewsInteractions WHERE user_id = :user_id AND news_id = :news_id AND interaction_type = 'like'";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->bindValue(":news_id", $article_id, PDO::PARAM_INT);
    try{
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        error_log("user_has_liked - Result: " . var_export($result, true));
        if($result){
            return true;
        }
    } catch(PDOException $e){
        error_log("Error fetching articles from DB: " . var_export($e, true));
    }
}

function toggle_like($article_id, $user_id){
    error_log("Like Toggled for article: " . $article_id . " by user: " . $user_id);
    $db = getDB();

    if(user_has_liked($article_id, $user_id)){
        // Delete the like
        $query = "DELETE FROM UserNewsInteractions WHERE user_id = :user_id AND news_id = :news_id AND interaction_type = 'like'";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindValue(":news_id", $article_id, PDO::PARAM_INT);
        try{
            $stmt->execute();
        } catch(PDOException $e){
            error_log("Error fetching articles from DB: " . var_export($e, true));
        }
    } else {
        // Add the like
        $query = "INSERT INTO UserNewsInteractions (user_id, news_id, interaction_type) VALUES (:user_id, :news_id, 'like')";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindValue(":news_id", $article_id, PDO::PARAM_INT);
        try{
            $stmt->execute();
        } catch(PDOException $e){
            error_log("Error fetching articles from DB: " . var_export($e, true));
        }
    }
}

function removeAllLikes($user_id){
    // Remove all likes associated with a user from the UserNewsInteractions table
    $db = getDB();
    $query = "DELETE FROM UserNewsInteractions WHERE user_id = :user_id AND interaction_type = 'like'";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
    try{
        $stmt->execute();
    } catch(PDOException $e){
        error_log("Error fetching articles from DB: " . var_export($e, true));
    }
}