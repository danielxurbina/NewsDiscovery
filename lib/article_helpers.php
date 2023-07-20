<?php
function get_articles()
{
    $db = getDB();
    $query = "SELECT id, api_id, title, link, video_url, content_description, content, publish_date, image_url, source_id, category, country, manual_check, content_hash FROM NewsArticles";
    $stmt = $db->prepare($query);
    try{
        $stmt->execute();
        $result = $stmt->fetchAll();
        // Convert the date format back to MM/DD/YYYY when fetching from the database
        foreach ($result as &$row) {
            $publish_date_db = DateTime::createFromFormat("Y-m-d", $row["publish_date"]);
            $row["publish_date"] = $publish_date_db->format("m/d/Y");
        }
        return $result;
    } catch(PDOException $e){
        error_log("Error fetching articles from DB: " . var_export($e, true));
    }
    return [];
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
            flash("Please fill out all required fields", "warning");
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
        flash("Please fill out all required fields", "warning");
        $hasError = true;
        return $hasError;
    }

    error_log("validateDate date: " . var_export($date, true));

    // Check if the date is in the correct format
    $dateValidationRegex = "/^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/";
    if(!preg_match($dateValidationRegex, $date)){
        flash("Please enter a valid date YYYY-MM-DD", "warning");
        $hasError = true;
        return $hasError;
    }

    error_log("validateDate date after regex: " . var_export($date, true));

    $hasError = false;
    return $hasError;
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