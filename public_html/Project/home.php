<?php
require(__DIR__ . "/../../partials/nav.php");
?>
<div class="container-fluid">
    <h1> News </h1>
    <p> Welcome to the News page! </p>
    <p> Here you can view all the news articles that have been created. </p>
    <p> Type something in the input field to search the list of articles for specific items: </p>
    <div class="row">
        <input class="form-control" id="myInput" type="text" placeholder="Search..">
    </div>
    <div class="row">
        <label for="sortOption">Sort by:</label>
        <select id="sortOption" class="form-control">
            <option value="country">Country</option>
            <option value="category">Category</option>
        </select>
    </div>
    <div class="row">
        <!-- Add a field for the user to enter the limit of articles to appear on the page -->
        <label for="limit">Number of articles to display:</label>
        <input class="form-control" id="limit" type="number" min="1" max="100" value="10">
    </div>
    <div class="row" id="articles">
        <?php
        // Fetch articles from the database using get_articles() function
        $articles = get_articles();

        // Check if the user has selected a sorting option
        $sortOption = isset($GET['sortOption']) ? $GET['sortOption'] : 'title';

        // Sort the articles based on te selected option
        usort($articles, function ($a, $b) use ($sortOption){
            return $a[$sortOption] <=> $b[$sortOption];
        });

        // Loop through the articles and display each one
        foreach ($articles as $article) {
            error_log("Article: " . var_export($article, true));
            $queryParam = "article_" . $article['id'];
            ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <?php
                    // Check if the article has a valid image_url
                    if (!empty($article['image_url'])) {
                        ?>
                        <img src="<?php echo $article['image_url']; ?>" class="card-img-top" alt="<?php echo $article['title']; ?>">
                        <?php
                    } else {
                        // If image_url is null, display a random image from the specified URL
                        ?>
                        <img src="https://source.unsplash.com/user/c_v_r/?<?php echo $queryParam; ?>" class="card-img-top" alt="<?php echo $article['title']; ?>">
                        <?php
                    }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $article['title']; ?></h5>
                        <p class="card-text"><?php echo $article['content_description']; ?></p>
                        <a href="article_details.php?id=<?php echo $article['id']; ?>" class="btn btn-primary">Read More</a>
                        <?php if ($article['created_by'] == get_user_id()) : ?>
                            <a href="edit_article.php?id=<?php echo $article['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="delete_article.php?id=<?php echo $article['id']; ?>" class="btn btn-danger">Delete</a>
                        <?php endif; ?>
                        <?php if (has_role("Admin") || $article['user_id'] == get_user_id()) : ?>
                            <a href="delete_article.php?id=<?php echo $article['id']; ?>" class="btn btn-danger">Delete</a>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>


<style>
    .container-fluid {
        padding: 20px;
    }

    .card {
        width: 100%;
        border: 1px solid #e6e6e6;
        border-radius: 4px;
        transition: box-shadow 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
    }

    .card-body {
        padding: 10px;
    }

    .card-title {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .card-text {
        font-size: 14px;
        color: #666;
    }

    .btn {
        margin-top: 10px;
    }

    @media (max-width: 767px) {
        .col-md-4 {
            flex-basis: 100%;
            max-width: 100%;
        }
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Filter the articles based on the input value
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#articles .card").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    // Filter the articles based on the selected limit
    $(document).ready(function() {
        $("#limit").on("input", function() {
            var limit = $(this).val();
            $("#articles .col-md-4").each(function(index) {
                $(this).toggle(index < limit);
            });
        });
    });
</script>

<?php

if (is_logged_in(true)) {
    //comment this out if you don't want to see the session variables
    error_log("Session data: " . var_export($_SESSION, true));
}
?>
<?php
require(__DIR__ . "/../../partials/flash.php");
?>