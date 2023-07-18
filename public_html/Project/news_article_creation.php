<?php require(__DIR__ . "/../../partials/nav.php"); ?>

<div class="container-fluid">
    <h1>Create an Article</h1>
    <form onsubmit="return validate(this)" method="POST">
        <?php render_input(["type"=>"text", "id"=>"title", "name"=>"title", "label"=>"Title", "rules"=>["required"=>"true"]]);?>
        <?php render_input(["type"=>"text", "id"=>"newsArticleURL", "name"=>"newsArticleURL", "label"=>"News Article Link", "rules"=>["required"=>"false"]]);?>
        <?php render_input(["type"=>"text", "id"=>"newsVideoURL", "name"=>"newsVideoURL", "label"=>"News Article Video Link", "rules"=>["required"=>"false"]]);?>
        <?php render_input(["type"=>"textarea", "id"=>"newsDescription", "name"=>"newsDescription", "label"=>"Description", "rules"=>["required"=>"true"]]);?>
        <?php render_input(["type"=>"textarea", "id"=>"newsContent", "name"=>"newsContent", "label"=>"Content", "rules"=>["required"=>"true"]]);?>
        <?php render_input(["type"=>"text", "id"=>"publishDate", "name"=>"publishDate", "label"=>"Publish Date", "rules"=>["required"=>"true"]]);?>
        <?php render_input(["type"=>"text", "id"=>"newsImageURL", "name"=>"newsImageURL", "label"=>"News Image Link", "rules"=>["required"=>"false"]]);?>
        <?php render_input(["type"=>"text", "id"=>"newsSource", "name"=>"newsSource", "label"=>"News Source", "rules"=>["required"=>"true"]]);?>
        <?php render_input(["type"=>"text", "id"=>"newsCategory", "name"=>"newsCategory", "label"=>"Category", "rules"=>["required"=>"true"]]);?>
        <?php render_input(["type"=>"text", "id"=>"newsCountry", "name"=>"newsCountry", "label"=>"Country", "rules"=>["required"=>"true"]]);?>
        <?php render_button(["text"=>"Submit", "type"=>"submit"]);?>
    </form>
</div>

<script>
    // JS Validation
    function validate(form){
        let title = document.getElementById("title").value;
        let newsArticleURL = document.getElementById("newsArticleURL").value;
        let newsVideoURL = document.getElementById("newsVideoURL").value;
        let newsDescription = document.getElementById("newsDescription").value;
        let newsContent = document.getElementById("newsContent").value;
        let publishDate = document.getElementById("publishDate").value;
        let newsImageURL = document.getElementById("newsImageURL").value;
        let newsSource = document.getElementById("newsSource").value;
        let newsCategory = document.getElementById("newsCategory").value;
        let newsCountry = document.getElementById("newsCountry").value;

        // if required fields are empty return false
        const requiredFields = [title, newsDescription, newsContent, publishDate, newsSource, newsCategory, newsCountry];
        const isValid = requiredFields.every(field => field.trim().length !== 0);
        if(!isValid){
            return false;
        }
        
        // First check if the URL is empty, if it's not empty then check if it's a valid URL, if it is empty then return true since it's not a required field
        const urls = [newsArticleURL, newsVideoURL, newsImageURL];
        const isValidURL = urls.every(url => {
            if(url.trim().length !== 0){
                const regex = /^(ftp|http|https):\/\/[^ "]+$/;
                return regex.test(url);
            }
            return true;
        });

        // Publish Date must follow the date format and can use regex to make sure that's the case. MM/DD/YYYY
        const dateValidationRegex = /^([1-9]|0[1-9]|[12][0-9]|3[0-1])\/([1-9]|0[1-9]|1[0-2])\/\d{4}$/;
        if(!dateValidationRegex.test(publishDate)){
            return false;
        }
        
        // Title, News Source, News Category, News Country can not be longer than 100 characters
        const fieldLengthValidation = [title, newsSource, newsCategory, newsCountry];
        const isFieldLengthValid = fieldLengthValidation.every(field => field.length <= 100);
        if(!isFieldLengthValid){
            return false;
        }

        // Description can not be longer than 1000 characters
            if(newsDescription.length > 1000){
            return false;
        }
        
        // Content can not be longer than 10000 characters
        if(newsContent.length > 10000){
            return false;
        }

        console.log("Form is valid");
        return true;
    }
</script>

<?php
    function validateRequiredFields($fields){
        foreach($fields as $field){
            if(empty($field)){
                return false;
            }
        }
        return true;
    }

    function validateURL($url){
        if(!empty($url)){
            $regex = "/^(ftp|http|https):\/\/[^ \"\']+$/";
            return preg_match($regex, $url);
        }
        return true; // url is optional, so it's considered valid if empty
    }

    function validateDate($date){
        if(empty($date)){
            return false;
        }
        // date must follow the date format and can use regex to make sure that's the case. MM/DD/YYYY
        $dateValidationRegex = "/^([1-9]|0[1-9]|[12][0-9]|3[0-1])\/([1-9]|0[1-9]|1[0-2])\/\d{4}$/";
        return preg_match($dateValidationRegex, $date);
    }

    function validateStringLength($field, $maxLength){
        return strlen($field) <= $maxLength;
    }

    function news_article_check_duplicate($errorInfo){
        if($errorInfo[1] === 1062){
            preg_match("/NewsArticles.(\w+)/", $errorInfo[2], $matches);
            if(isset($matches[1])){
                flash("Duplicate article found based on content", "warning");
            } else {
                flash("An unhandled error occurred", "danger");
                error_log(var_export($errorInfo, true));
            }
        } else {
            flash("An unhandled error occurred", "danger");
            error_log(var_export($errorInfo, true));
        }
    }

    // PHP Validation
    if(
        isset($_POST["title"]) &&
        isset($_POST["newsDescription"]) && 
        isset($_POST["newsContent"]) &&
        isset($_POST["publishDate"]) &&
        isset($_POST["newsSource"]) &&
        isset($_POST["newsCategory"]) &&
        isset($_POST["newsCountry"])
    ){
        $title = se($_POST, "title", "", false); // required
        $newsDescription = se($_POST, "newsDescription", "", false); // required
        $newsContent = se($_POST, "newsContent", "", false); // required
        $publishDate = se($_POST, "publishDate", "", false); // required
        $newsSource = se($_POST, "newsSource", "", false); // required
        $newsCategory = se($_POST, "newsCategory", "", false); // required
        $newsCountry = se($_POST, "newsCountry", "", false); // required
        $newsArticleURL = se($_POST, "newsArticleURL", "default", false); // not required
        $newsVideoURL = se($_POST, "newsVideoURL", "default", false); // not required
        $newsImageURL = se($_POST, "newsImageURL", "default", false); // not required
        $manual_check = true;
        $user_id = get_user_id();
        $hasError = false;
        $requiredFields = array($title, $newsDescription, $newsContent, $publishDate, $newsSource, $newsCategory, $newsCountry);

        if(!validateRequiredFields($requiredFields)){
            flash("Please fill out all required fields");
            $hasError = true;
        }
        if (!validateStringLength($title, 100) || !validateStringLength($newsSource, 100) || !validateStringLength($newsCategory, 100) || !validateStringLength($newsCountry, 100)) {
            flash("Please enter a valid input length");
            $hasError = true;
        }
        if (strlen($newsDescription) > 1000){
            flash("Please enter a valid input length");
            $hasError = true;
        } 
        if (strlen($newsContent) > 10000){
            flash("Please enter a valid input length");
            $hasError = true;
        } 
        if (!validateURL($newsArticleURL) || !validateURL($newsVideoURL) || !validateURL($newsImageURL)){
            flash("Please enter a valid URL");
            $hasError = true;
        } 
        if (!validateDate($publishDate)){
            flash("Please enter a valid date");
            $hasError = true;
        }

        if(!$hasError){
            $content_hash = hash("sha256", $newsContent);
            $db = getDB();
            $stmt = $db->prepare("INSERT INTO NewsArticles(title, link, video_url, description, content, publish_date, image_url, source_id, category, country, created_by, manual_check, content_hash) VALUES (:title, :link, :video_url, :description, :content, :publish_date, :image_url, :source_id, :category, :country, :created_by, :manual_check, :content_hash)");

            $data = [
                ":title" => $title,
                ":link" => $newsArticleURL,
                ":video_url" => $newsVideoURL,
                ":description" => $newsDescription,
                ":content" => $newsContent,
                ":publish_date" => $publishDate,
                ":image_url" => $newsImageURL,
                ":source_id" => $newsSource,
                ":category" => $newsCategory,
                ":country" => $newsCountry,
                ":created_by" => $user_id,
                ":manual_check" => $manual_check,
                ":content_hash" => $content_hash
            ];

            try{
                $stmt->execute($data);
                flash("Successfully added news article", "success");

            } catch(PDOException $e){
                // check duplicate entry through content_hash
                news_article_check_duplicate($e->errorInfo);
            }
        }
    }

    
?>

<?php require(__DIR__ . "/../../partials/flash.php"); ?>