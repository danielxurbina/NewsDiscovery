<?php
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