<?php
// this function is used to save data to a table
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

// this function is used to update data in a table
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

// this function is used to delete data from a table
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

// this function is used to check if a user has liked an article
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

// this function is used to toggle a like on an article for a user
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
            echo json_encode(["status" => "success", "action" => "deleted"]);
        } catch(PDOException $e){
            error_log("Error deleting likes from DB: " . var_export($e, true));
        }
    } else {
        // Add the like
        $query = "INSERT INTO UserNewsInteractions (user_id, news_id, interaction_type) VALUES (:user_id, :news_id, 'like')";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindValue(":news_id", $article_id, PDO::PARAM_INT);
        try{
            $stmt->execute();
            echo json_encode(["status" => "success", "action" => "added"]);
        } catch(PDOException $e){
            error_log("Error inserting likes into DB: " . var_export($e, true));
        }
    }
}

function assign_like($article_id, $user_id){
    $db = getDB();

    if(user_has_liked($article_id, $user_id)){
        $query = "DELETE FROM UserNewsInteractions WHERE user_id = :user_id AND news_id = :news_id AND interaction_type = 'like'";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindValue(":news_id", $article_id, PDO::PARAM_INT);
        try{
            $stmt->execute();
        } catch(PDOException $e){
            error_log("Error deleting likes from DB: " . var_export($e, true));
        }
    } else {
        $query = "INSERT INTO UserNewsInteractions (user_id, news_id, interaction_type) VALUES (:user_id, :news_id, 'like')";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindValue(":news_id", $article_id, PDO::PARAM_INT);
        try{
            $stmt->execute();
        } catch(PDOException $e){
            error_log("Error inserting likes into DB: " . var_export($e, true));
        }
    }
}

// this function is used to remove all likes associated with a single user and if a user ID is not passed in it will remove all likes from the table
function removeAllLikes($user_id = null){
    $db = getDB();

    if(!empty($user_id)){
        // Remove all likes associated with a single user from the UserNewsInteractions table
        $query = "DELETE FROM UserNewsInteractions WHERE user_id = :user_id AND interaction_type = 'like'";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        try{
            $stmt->execute();
        } catch(PDOException $e){
            error_log("Error fetching articles from DB: " . var_export($e, true));
        }
    }
    else{
        // Remove all likes from the UserNewsInteractions table
        $query = "DELETE FROM UserNewsInteractions WHERE interaction_type = 'like'";
        $stmt = $db->prepare($query);
        try{
            $stmt->execute();
        } catch(PDOException $e){
            error_log("Error fetching articles from DB: " . var_export($e, true));
        }
    }
}

// this function is used to remove all likes associated with a single article
function removeArticleLikes($user_ids, $article_id){
    $db = getDB();
    
    if(!empty($user_ids)){
        // Remove all likes associated with a single user from the UserNewsInteractions table
        $query = "DELETE FROM UserNewsInteractions WHERE user_id IN (" . join(",", $user_ids) . ") AND news_id = :news_id AND interaction_type = 'like'";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":news_id", $article_id, PDO::PARAM_INT);
        try{
            $stmt->execute();
        } catch(PDOException $e){
            error_log("Error fetching articles from DB: " . var_export($e, true));
        }
    }
}