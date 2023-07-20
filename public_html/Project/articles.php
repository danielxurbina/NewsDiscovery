<?php 
require(__DIR__ . "/../../partials/nav.php");
$result = get("https://newsdata2.p.rapidapi.com/news", "NEWS_API_KEY", [], true);
error_log("Response: " . var_export($result, true));
if(se($result, "status", 400, false) == 200 && isset($result["response"])){
    $result = json_decode($result["response"], true);
    // Check if "results" key exists and has an array value
    if (isset($result["results"]) && is_array($result["results"])) {
        $newsArticles = $result["results"];
    } else {
        $newsArticles = [];
    }
} else {
    $newsArticles = [];
}
?>
<style>
.card {
  border: 1px solid #ccc;
  border-radius: 8px;
  overflow: hidden;
  margin-bottom: 20px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.card-img-top {
  height: 200px;
  object-fit: cover;
}

.card-body {
  padding: 16px;
}

.card-title {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 8px;
}

.card-text {
  font-size: 14px;
  color: #666;
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 3; /* Limit to 3 lines of text */
  -webkit-box-orient: vertical;
}

.card-readmore-btn {
  display: block;
  text-align: center;
  margin-top: 8px;
}

.container-fluid {
  padding-top: 20px;
}
</style>

<div class="container-fluid">
  <h1>News</h1>
  <div class="row">
    <?php foreach($newsArticles as $news) : ?>
      <div class="col">
        <div class="card" style="width: 15em;">
          <img src="<?php echo $news["image_url"]; ?>" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title"><?php echo $news["title"]; ?></h5>
            <p class="card-text"><?php echo $news["description"]; ?></p>
            <a href="<?php echo $news["link"]; ?>" class="card-readmore-btn btn btn-primary">Read More</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
