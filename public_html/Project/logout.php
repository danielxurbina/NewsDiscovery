<?php
session_start(); // start the session
session_unset(); // clear out all the variables
session_destroy(); // clean it up from the server
session_start();
require(__DIR__ ."/../../lib/functions.php");
flash("Successfully logged out", "success");
/* 
redirect the user back to login, no die or exit here because 
it's the end of the script there's nothing else to terminate here, 
we usually use a die or exit when there's still other code after this point 
*/
header("Location: login.php");