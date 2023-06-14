<?php
    require_once(__DIR__ . "/../../lib/functions.php");
?>
<form onsubmit="return validate(this)" method="POST">
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" required />
    </div>
    <div>
        <label for="pw">Password</label>
        <input type="password" id="pw" name="password" required minlength="8" />
    </div>
    <div>
        <label for="confirm">Confirm</label>
        <input type="password" name="confirm" required minlength="8" />
    </div>
    <input type="submit" value="Register" />
</form>
<script>
    function validate(form) {
        //TODO 1: implement JavaScript validation
        //ensure it returns false for an error and true for success

        return true;
    }
</script>
<?php
	// TODO2: add PHP Code
	if(isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm"])){
        // get the email key from $_POST, default to "" if not set, and return the value
	    $email = se($_POST, "email", "", false); // $email = $_POST["email"];
	    // same as above for password and confirm
	    $password = se($_POST, "password", "", false); // $password = $_POST["password"];
	    $confirm = se($_POST, "confirm", "", false); // $confirm = $_POST["confirm"];
		//TODO 3: validate/use
        $hasError = false;
        if(empty($email)){
            echo "Email must not be empty";
            $hasError = true;
        }
        // sanitize
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        //validate
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	        echo "Please enter a valid email address <br>";
	        $hasError = true;
        }
        if(empty($password)){
            echo "password must not be empty";
            $hasError = true;
        }
        if(empty($confirm)){
            echo "Confirm password must not be empty";
            $hasError = true;
        }
        if(strlen($password) < 8) {
            echo "Password too short";
            $hasError = true;
        }
        if(strlen($password) > 0 && $password != $confirm){
            echo "Passwords must match";
            $hasError = true;
        }
        if(!$hasError){
            echo "Welcome, $email";
        }
	}
?>