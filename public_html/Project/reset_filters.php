<?php
// Start the session (if not already started)
session_start();

// Unset the session variables related to the form filters (e.g., article_limit and searchInput)
if (isset($_SESSION['article_limit'])) {
    unset($_SESSION['article_limit']);
}
if (isset($_SESSION['searchInput'])) {
    unset($_SESSION['searchInput']);
}

// Redirect the user back to the homepage
header("Location: home.php?page=1");
exit();
?>