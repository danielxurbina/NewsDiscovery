<?php
function map_data($api_data){
    $articles = [];
    foreach($api_data['results'] as $article){
        $record = [
            "title" => $article['title'],
            "link" => $article['link'],
            "video_url" => $article['video_url'],
            "content_description" => $article['description'],
            "content" => $article['content'],
            "publish_date" => $article['pubDate'],
            "image_url" => $article['image_url'],
            "source_id" => $article['source_id'],
            "category" => $article['category'],
            "country" => $article['country'],
            "api_id" => uniqid(),
            "manual_check" => 0,
            "content_hash" => hash("sha256", $article['content'])
        ];
        array_push($articles, $record);
    }
    return $articles;
}