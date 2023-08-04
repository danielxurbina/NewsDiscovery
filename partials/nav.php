<?php
require_once(__DIR__ . "/../lib/functions.php");
//Note: this is to resolve cookie issues with port numbers
$domain = $_SERVER["HTTP_HOST"];
if (strpos($domain, ":")) {
    $domain = explode(":", $domain)[0];
}
$localWorks = true; //some people have issues with localhost for the cookie params
//if you're one of those people make this false

//this is an extra condition added to "resolve" the localhost issue for the session cookie
if (($localWorks && $domain == "localhost") || $domain != "localhost") {
    session_set_cookie_params([
        "lifetime" => 60 * 60,
        "path" => "$BASE_PATH",
        //"domain" => $_SERVER["HTTP_HOST"] || "localhost",
        "domain" => $domain,
        "secure" => true,
        "httponly" => true,
        "samesite" => "lax"
    ]);
}
session_start();


?>
<!-- include bootstrap css and js references -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<!-- include css and js files -->
<script src="<?php echo get_url('helpers.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo get_url('styles.css'); ?>">
<nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #323357;">
    <div class="container-fluid" id="navbarNav">
        <a class="navbar-brand" href="<?php echo get_url('home.php'); ?>">News Discovery</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="navbar-nav me-auto">
                <?php if (is_logged_in()) : ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo get_url('home.php'); ?>">Home</a></li>
                    <li class="nav-item">
                        <?php 
                            $user_id = get_user_id();
                            $profile_link = get_url('profile.php?id=' . $user_id);
                        ?>
                        <a class="nav-link" href="<?php echo $profile_link; ?>">Profile</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo get_url('my_saved_articles.php'); ?>">Saved Articles</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo get_url('news_article_creation.php'); ?>">Create Article</a></li>
                <?php endif; ?>
                <?php if (!is_logged_in()) : ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo get_url('login.php'); ?>">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo get_url('register.php'); ?>">Register</a></li>
                <?php endif; ?>
                <?php if (has_role("Admin")) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Admin</a>
                        <ul class="dropdown-menu">
                            <li class="nav-item"><a class="dropdown-item" href="<?php echo get_url('admin/import_api_data.php'); ?>">Import API Data</a></li>
                            <li class="nav-item"><a class="dropdown-item" href="<?php echo get_url('admin/create_role.php'); ?>">Create Role</a></li>
                            <li class="nav-item"><a class="dropdown-item" href="<?php echo get_url('admin/list_roles.php'); ?>">List Roles</a></li>
                            <li class="nav-item"><a class="dropdown-item" href="<?php echo get_url('admin/assign_roles.php'); ?>">Assign Roles</a></li>
                            <li class="nav-item"><a class="dropdown-item" href="<?php echo get_url('admin/articles_liked_by_users.php'); ?>">All User Liked Articles</a></li>
                            <li class="nav-item"><a class="dropdown-item" href="<?php echo get_url('admin/articles_not_liked_by_users.php'); ?>">All Articles With No Likes</a></li>
                            <li class="nav-item"><a class="dropdown-item" href="<?php echo get_url('admin/assign_likes_to_articles.php');?>">Assign Likes To Articles</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (is_logged_in()) : ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo get_url('logout.php'); ?>">Logout</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>