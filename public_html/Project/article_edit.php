<?php
require(__DIR__ . "/../../partials/nav.php");
?>

<div class="container-fluid">
    <?php 
        // Extract id from url
        $id = $_GET['id'];

        // Fetch from the DB with the ID gotten from the URL
        $result = get_articles_by_id($id);

        error_log("Result xxx: " . var_export($result, true));

        // Check if the article exists
        if (!$result) {
            redirect("home.php");
            flash("Article does not exist", "warning");
        }
    ?>
    <h1> Edit Article </h1>
    <form method="POST" id="form" action="">
        <?php render_input(["type"=>"text", "id"=>"title", "name"=>"title", "label"=>"Title", "value"=>$result["title"], "rules"=>["required"=>"true"]]); ?>
        <?php render_input(["type"=>"textarea", "id"=>"content_description", "name"=>"content_description", "label"=>"Description", "value"=>$result["content_description"], "rules"=>["required"=>"true"]]); ?>
        <?php render_input(["type"=>"textarea", "id"=>"content", "name"=>"content", "label"=>"Content", "value"=>$result["content"], "rules"=>["required"=>"true"]]); ?>
        <div class="row">
            <div class="col">
                <?php render_input(["type"=>"text", "id"=>"publish_date", "name"=>"publish_date", "placeholder"=>"YYYY-MM-DD is the format",  "label"=>"Publish Date", "value"=>$result["publish_date"], "rules"=>["required"=>"true"]]); ?>
            </div>
            <div class="col">
                <?php render_input(["type"=>"text", "id"=>"source_id", "name"=>"source_id", "label"=>"News Source", "value"=>$result["source_id"], "rules"=>["required"=>"true"]]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?php render_input(["type"=>"text", "id"=>"category", "name"=>"category", "label"=>"Category", "value"=>$result["category"], "rules"=>["required"=>"true"]]); ?>
            </div>
            <div class="col">
                <?php render_input(["type"=>"text", "id"=>"country", "name"=>"country", "label"=>"Country", "value"=>$result["country"], "rules"=>["required"=>"true"]]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?php render_input(["type"=>"text", "id"=>"link", "name"=>"link", "label"=>"News Link", "value"=>$result["link"],  "rules"=>["required"=>"false"]]);?>
            </div>
            <div class="col">
                <?php render_input(["type"=>"text", "id"=>"video_url", "name"=>"video_url", "label"=>"Video URL", "value"=>$result["video_url"], "rules"=>["required"=>"true"]]); ?>
            </div>
            <div class="col">
                <?php render_input(["type"=>"text", "id"=>"image_url", "name"=>"image_url", "label"=>"Image URL", "value"=>$result["image_url"], "rules"=>["required"=>"true"]]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary" onclick="validateForm()">Update</button>
            </div>
        </div>
    </form>
</div>

<script>
    function validateURL(url, hasError){
        if(url == null || url==""){
            hasError = false;
            return hasError;
        }

        // Check if url is empty
        if(url.trim().length > 0){
            const regex = /^(ftp|http|https):\/\/[^ \"\']+$/;
            if(!url.match(regex)){
                hasError = true;
                flash("Please enter a valid URL or enter null if you don't have a URL.", "warning");
            }
        }

        return hasError;
    }

    function validateDate(date, hasError){
        // Check if date is empty
        if(date.trim().length == 0){
            flash("Please enter a date", "warning");
            hasError = true;
            return hasError;
        }

        dateValidationRegex = /^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/;
        if(!dateValidationRegex.test(date)){
            flash("Please enter a valid date", "warning");
            hasError = true;
            return hasError;
        } else {
            hasError = false;
            return hasError;
        }
    }

    function checkLength(fields, length){
        let hasError = false;
        fields.forEach(field => {
            if(field.length > length){
                flash("Please enter a value less than " + length + " characters.", "warning");
                hasError = true;
            }
        })

        return hasError;
    }

    function validateRequiredFields(fields, hasError){
        fields.forEach((field, index) => {
            if(field == null || field == ""){
                flash("Please enter a value for " + getFieldName(index), "warning");
                hasError = true;
            }
        })

        return hasError;
    }

    function getFieldName(index){
        let fieldNames = ["Title", "Description", "Content", "Publish Date", "News Source", "Category", "Country"];
        return fieldNames[index];
    }

    function validateForm(){
        event.preventDefault();
        clearFlashMessages();
        var title = document.getElementById("title").value;
        var link = document.getElementById("link").value;
        var video_url = document.getElementById("video_url").value;
        var content_description = document.getElementById("content_description").value;
        var content = document.getElementById("content").value;
        var publish_date = document.getElementById("publish_date").value;
        var image_url = document.getElementById("image_url").value;
        var source_id = document.getElementById("source_id").value;
        var category = document.getElementById("category").value;
        var country = document.getElementById("country").value;
        var hasError = false;
        let requiredFields = [title, content_description, content, publish_date, source_id, category, country];
        let isValid = requiredFields.every(field => field.trim().length !== 0);
        let checkLengthFields = [title, link, video_url, image_url, source_id, country, category];
        let requiredFieldsCheck = validateRequiredFields(requiredFields, hasError);
        let dateCheck = validateDate(publish_date, hasError);
        let lengthCheck = checkLength(checkLengthFields, 500);

        if(requiredFieldsCheck || dateCheck || lengthCheck){
            return false;
        } else {
            hasError = false;
        }

        if(validateURL(link, hasError)){
            return false;
        } else {
            hasError = false;
        }

        if(validateURL(video_url, hasError)){
            return false;
        } else {
            hasError = false;
        }

        if(validateURL(image_url, hasError)){
            return false
        } else {
            hasError = false;
        }

        if(hasError){
            return false;
        } else {
            document.getElementById("form").submit();
        }
    }
</script>

<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $title = $_POST["title"];
    $link = $_POST["link"];
    $video_url = $_POST["video_url"];
    $content_description = $_POST["content_description"];
    $content = $_POST["content"];
    $publish_date = $_POST["publish_date"];
    $image_url = $_POST["image_url"];
    $source_id = $_POST["source_id"];
    $category = $_POST["category"];
    $country = $_POST["country"];
    $manual_check = 1;
    $created_by = getUserID("NewsArticles", $_GET["id"]);
    $content_hash = isset($content) ? hash("sha256", $content) : null;
    $ignore = ["id", "api_id"];
    $hasError = false;

    $required_fields = [$title, $content_description, $content, $publish_date, $source_id, $category, $country];

    $validateRequiredFields = validateRequiredFields($required_fields, $hasError);
    $validateLink = validateURL($link, $hasError);
    $validateVideoURL = validateURL($video_url, $hasError);
    $validateImageURL = validateURL($image_url, $hasError);
    $validateDate = validateDate($publish_date, $hasError);

    if($validateLink){
        $hasError = false;
        $link = null;
    }
    if($validateVideoURL){
        $hasError = false;
        $video_url = null;
    }
    if($validateImageURL){
        $hasError = false;
        $image_url = null;
    }

    if($validateRequiredFields || $validateDate){
        $hasError = true;
    }

    error_log("Created by sssss: " . $created_by);

    if(!$hasError){
        $data = [
            "title" => $title, 
            "link" => $link,
            "video_url" => $video_url,
            "content_description" => $content_description,
            "content" => $content,
            "publish_date" => $publish_date,
            "image_url" => $image_url,
            "source_id" => $source_id,
            "category" => $category,
            "country" => $country,
            "created_by" => $created_by,
            "manual_check" => $manual_check,
            "content_hash" => $content_hash
        ];

        $db = getDB();
        updateArticles("NewsArticles", $data, $ignore, $_GET["id"]);
        flash("Article updated successfully.", "success");
        redirect("article_details.php?id=" . urlencode($_GET["id"]));
    }
}
?>

<?php require(__DIR__ . "/../../partials/flash.php"); ?>