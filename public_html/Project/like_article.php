<?php
require_once(__DIR__ . "/../../lib/functions.php");
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $articleId = $_POST['articleId'];
    $userId = $_POST['userId'];
    toggle_like($articleId, $userId);
}
?>