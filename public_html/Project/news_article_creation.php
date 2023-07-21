<?php require(__DIR__ . "/../../partials/nav.php"); ?>

<div class="container-fluid">
    <h1>Create an Article</h1>
    <form method="POST" id="form" action="">
        <?php render_input(["type"=>"text", "id"=>"title", "name"=>"title", "label"=>"Title", "rules"=>["required"=>"true"]]);?>
        <?php render_input(["type"=>"textarea", "id"=>"content_description", "name"=>"content_description", "label"=>"Description", "rules"=>["required"=>"true"]]);?>
        <?php render_input(["type"=>"textarea", "id"=>"content", "name"=>"content", "label"=>"Content", "rules"=>["required"=>"true"]]);?>
        <div class="row">
            <div class="col">
                <?php render_input(["type"=>"text", "id"=>"publish_date", "name"=>"publish_date", "placeholder"=>"YYYY-MM-DD is the format",  "label"=>"Publish Date", "rules"=>["required"=>"true"]]);?>
            </div>
            <div class="col">
                <?php render_input(["type"=>"text", "id"=>"source_id", "name"=>"source_id", "label"=>"News Source", "rules"=>["required"=>"true"]]);?>       
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?php render_input(["type"=>"text", "id"=>"category", "name"=>"category", "label"=>"Category", "rules"=>["required"=>"true"]]);?>
            </div>
            <div class="col">
                <?php render_input(["type"=>"text", "id"=>"country", "name"=>"country", "label"=>"Country", "rules"=>["required"=>"true"]]);?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="linkflexSwitchDefault" onclick="toggleInput('linkInput')">
                    <label class="form-check-label" for="flexSwitchDefault">Switch to enter News Link</label>
                </div>
                <div id="linkInput" style="display: none;">
                    <?php render_input(["type"=>"text", "id"=>"link", "name"=>"link", "rules"=>["required"=>"false"]]);?>
                </div>
            </div>
            <div class="col">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="video_urlflexSwitchDefault2" onclick="toggleInput('videoInput')">
                    <label class="form-check-label" for="flexSwitchDefault2">Switch to enter Video URL</label>
                </div> 
                <div id="videoInput" style="display: none;">
                    <?php render_input(["type"=>"text", "id"=>"video_url", "name"=>"video_url", "rules"=>["required"=>"false"]]);?>
                </div>
            </div>
            <div class="col">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="image_urlflexSwitchDefault3" onclick="toggleInput('imageInput')">
                    <label class="form-check-label" for="flexSwitchDefault3">Switch to enter Image URL</label>
                </div>
                <div id="imageInput" style="display: none;">
                    <?php render_input(["type"=>"text", "id"=>"image_url", "name"=>"image_url", "rules"=>["required"=>"false"]]);?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary" onclick="validateForm()">Submit</button>
            </div>
        </div>
    </form>
</div>

<script>
function validateURL(url, hasError){
    if(url == null || url == ""){
        hasError = false;
        return hasError;
    }

    // Check if url is empty
    if(url.trim().length > 0){
        const regex = /^(ftp|http|https):\/\/[^ \"\']+$/;
        if(!url.match(regex)){
            hasError = true;
            alert("Please enter a valid URL or enter null if you don't have a URL.");
        }
    }
    return hasError;
}

function validateDate(date, hasError){
    // Check if date is empty
    if(date.trim().length == 0){
        alert("Please enter a date.");
        hasError = true;
    }

    dateValidationRegex = /^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/;
    if(!date.match(dateValidationRegex)){
        alert("Please enter a valid date in this format YYYY-MM-DD.");
        hasError = true;
    }

    return hasError;
}

function checkLength(fields, length){
    let hasError = false;
    fields.forEach(field => {
        if(field.length > length){
            alert("Please enter a value less than " + length + " characters.");
            hasError = true;
        }
    })

    return hasError;
}

function toggleInput(inputId){
    var input = document.getElementById(inputId);
    if(input.style.display === "none"){
        console.log("toggle on");
        input.style.display = "block";
    } else {
        console.log("toggle off");
        input.style.display = "none";
    }
}

function validateForm(){
    event.preventDefault();
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

    if(!isValid){
        hasError = true;
        alert("Please fill out all required fields.");
    }

    // Check if the "link" checkbox is checked
    var linkCheckBox = document.getElementById("linkflexSwitchDefault");
    if(linkCheckBox.checked){
        if(!validateURL(link, hasError)){
            hasError = false;
        }
    }

    // Check if the "video_url" checkbox is checked
    var videoCheckBox = document.getElementById("video_urlflexSwitchDefault2");
    if(videoCheckBox.checked){
        if(!validateURL(video_url, hasError)){
            hasError = false;
        }
    }

    // Check if the "image_url" checkbox is checked
    var imageCheckBox = document.getElementById("image_urlflexSwitchDefault3");
    if(imageCheckBox.checked){
        if(!validateURL(image_url, hasError)){
            hasError = false;
        }
    }
    
    if(!validateDate(publish_date, hasError)){
        hasError = false;
    }

    if(!checkLength(checkLengthFields, 500)){
        hasError = false;
    }

    if(hasError){
        return false;
    }

    // Explicitly submit the form if there are no errors
    document.getElementById("form").submit();
}
</script>
<style>

</style>

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
    $created_by = get_user_id();
    $content_hash = isset($content) ? hash("sha256", $content) : null;
    $ignore = ["id", "api_id"];
    $hasError = false;

    $required_fields = [$title, $content_description, $content, $publish_date, $category, $country];

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

    error_log("Date after if statement: $publish_date");

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

        // Check if the article already exists in the database
        $duplicateValue = check_duplicate($content_hash, $title);
        
        if($duplicateValue){
            error_log("Duplicate value found: ID: " . $duplicateValue["id"] . ", Title: " . $duplicateValue["title"]);
            flash("This article already exists in the database.", "danger");
        } else {
            $db = getDB();
            save_data("NewsArticles", $data, $ignore);
            flash("Article submitted succesfully!", "success");
        }
    }
}
?>
<?php 
require(__DIR__ . "/../../partials/flash.php"); 
?>