<?php
require(__DIR__ . "/../../../partials/nav.php");

if(!has_role("Admin")){
    flash("You don't have permission to access this page", "warning");
    die(header("Location: " . get_url("home.php")));
}

function insert_articles_into_db($db, $articles, $mappings)
{
    // Prepare SQL query
    $query = "INSERT INTO `NewsArticles` ";
    if(count($articles) > 0){
        $cols = array_keys($articles[0]);
        error_log("cols: " . var_export($cols, true));
        $query .= "(" .implode(",", array_map(function($col) {
            return "`$col`";
        }, $cols)) . ") VALUES ";

        // Generate the VALUES clause for each article
        $values = [];
        foreach($articles as $i => $article){
            $articlePlaceholders = array_map(function ($v) use ($i) {
                return ":" . $v . $i;  // Append the index to make each placeholder unique
            }, $cols);
            $values[] = "(" . implode(",", $articlePlaceholders) . ")";
        }

        $query .= implode(",", $values);

        error_log("query: " . var_export($query, true));

        // Generate the ON DUPLICATE KEY UPDATE clause
        $updates = array_reduce($cols, function($carry, $col) {
            $carry[] = "`$col` = VALUES(`$col`)";
            return $carry;
        }, []);

        $query .= "ON DUPLICATE KEY UPDATE " . implode(",", $updates);
        
        // Prepare the statement
        $stmt = $db->prepare($query);
        
        foreach($articles as $i => $article){
            foreach($cols as $col){
                $placeholder = ":$col$i";
                $value = isset($article[$col]) ? $article[$col] : null;
                $param = PDO::PARAM_STR;
                
                if(is_array($value)){
                    // Convert array to a string representation
                    $value = implode(', ', $value);
                }
                
                $stmt->bindValue($placeholder, $value, $param);
            }
        }
        
        error_log("stmt: " . var_export($stmt, true));

        // Execute the statement
        try{
            $stmt->execute();
        } catch(PDOException $e){
            error_log("Exception: " . var_export($e, true));
        }
    }
}

function process_articles($result)
{
    $status = se($result, "status", 400, false);
    if($status != 200){
        // Flash error message
        flash("Failed to fetch data from the API", "danger");
        return;
    }

    // Extract data from result
    $data_string = html_entity_decode(se($result, "response", "{}", false));
    $wrapper = "{\"data\":$data_string}";
    $data = json_decode($wrapper, true);
    if(!isset($data["data"])){
        return;
    }
    $data = $data["data"];
    error_log("data: " . var_export($data, true));

    // Get Columns from NewsArticles table
    $db = getDB();
    $stmt = $db->prepare("SHOW COLUMNS FROM NewsArticles");
    $stmt->execute();
    $columnsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Prepare columns and mappings
    $columns = array_column($columnsData, 'Field');
    $mappings = [];
    foreach($columnsData as $column){
        $mappings[$column['Field']] = $column['Type'];
    }
    $ignored = ["id", "created", "modified", "created_by"];
    $columns = array_diff($columns, $ignored);
    error_log("columns: " . var_export($columns, true));
    $mappings["api_id"] = "varchar(100)";
    error_log("mappings: " . var_export($mappings, true));

    // Process each article
    $articles = map_data($data);
    error_log("articlesxyz: " . var_export($articles, true));

    // Insert articles into DB
    insert_articles_into_db($db, $articles, $mappings);

    flash("News articles data refreshed successfully", "success");
}

$action = se($_POST, "action", "", false);
if($action){
    switch($action){
        case "news_articles":
            $result = get("https://newsdata2.p.rapidapi.com/news", "NEWS_API_KEY", ["country" => "us"], true);
            process_articles($result);
            break;
        }
}
?>

<div class="container-fluid">
    <h1>News Article Data Management</h1>
    <div class="row">
        <div class="col">
            <!-- News Article refresh button -->
            <form method="POST">
                <input type="hidden" name="action" value="news_articles"/>
                <input type="submit" class="btn btn-primary" value="Refresh News Articles"/>
            </form>
        </div>
    </div>
</div>