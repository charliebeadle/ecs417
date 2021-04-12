<!DOCTYPE html>
<html>
<head>
	<meta name="generator"
		  content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39"/>
	<meta charset="utf-8"/>
	<title>Charlie Beadle</title>
	<link rel="stylesheet" href="reset.css" type="text/css"/>
	<link rel="stylesheet" href="portfolio.css" type="text/css"/>
	<script>app.use("/static", express.static('./static'))</script>
	<script src="static/script.js"></script>
	<script>
		function verifyRegistration(){

			let username = document.getElementById("register_username").value;
			let email = document.getElementById("register_email").value;
			let password = document.getElementById("register_password").value;
			let confirm = document.getElementById("confirm_password").value;

			if(password != confirm){
				alert("Passwords do not match!");
				return false;
			}

			let form = document.getElementById("register-form");
			form.submit();
			return true;
		}

		function preventDefault(){

			let title = document.getElementById("blog-title").value;
			let content = document.getElementById("blog-content").value;

			if(title.length < 5){
				alert("Minimum title length is 5 characters!");
				return false;
			}

			if(content.length < 150){
				alert("Minimum content length is 150 characters!");
				return false;
			}

			let form = document.getElementById("blog-post-form");
			form.submit();
			return true;

		}
	</script>
	<?php
	session_start();

	require_once "config.php";
	require_once "templates.php";

	function console_log($output, $with_script_tags = true)
	{
		$js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
			');';
		if ($with_script_tags) {
			$js_code = '<script>' . $js_code . '</script>';
		}
		echo $js_code;
	}

	function popup_alert($output, $with_script_tags = true)
	{
		$js_code = 'alert("' . $output . '");';
		if ($with_script_tags) {
			$js_code = '<script>' . $js_code . '</script>';
		}
		echo $js_code;
	}

	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === TRUE) {
		// ensures $loggedin variable is accurate
		$loggedin = true;
	} else {
		$loggedin = false;
	}



	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
		console_log("POST + SUBMIT");
		if ($_POST['submit'] == 'login') {
			// check login details

			$email = $password = "";
			$email_err = $password_err = $login_err = "";

			// check if email field is empty
			if (empty(trim($_POST["email"]))) {
				$email_err = "Please enter a email";
			} else {
				$email = trim($_POST["email"]);
			}

			// check if password field is empty
			if (empty(trim($_POST["password"]))) {
				$password_err = "Please enter a password";
			} else {
				$password = trim($_POST["password"]);
			}

			// if there are no errors, do SQL
			if (empty($email_err) && empty($password_err)) {
				$sql = "SELECT * FROM users WHERE email ='$email'";

				$match = $conn->query($sql);

				//check that there is only one row (i.e. one user matched)
				if ($match && $match->num_rows == 1) {
					$match = $match->fetch_assoc();

					if (password_verify($password, $match['password'])) {
						//passwords match

						$_SESSION['id'] = $match['ID'];
						$_SESSION['loggedin'] = $loggedin = true;
						$_SESSION['username'] = $match['username'];

						popup_alert("Logged in successfully! Welcome, " . $_SESSION['username']);
					} else {
						$password_err = "Incorrect password";
					}
				} else if (!$match || $match->num_rows == 0) {
					$email_err = "Unknown email address";
				} else {
					$email_err = "Unknown database error";
				}
			} else {
				$login_err = "Invalid username or password";
			}

		}
		elseif ($_POST['submit'] == 'post' || $_POST['submit'] == 'preview') {
			// new blog post
			$blogpost_err = "";

			if($_POST['submit'] == 'preview'){
				console_log("Preview = true");
				$preview = true;
			} else{
				console_log("Preview = false");
				$preview = false;
			}

			if (!$loggedin) {
				//user not logged in
				$blogpost_err = "Not logged in!";
			}
			else {
				//user is logged in

				if (isset($_POST['blog-title']) && !empty(trim($_POST['blog-title']))) {
					//title is filled in
					$title = trim($_POST['blog-title']);
					$title_colour = $_POST['title-colour'];

					if (strlen($title) < 5) {
						$blogpost_err = "Minimum post size is 5 characters!";
					} else {

						if (isset($_POST['blog-content']) && !empty(trim($_POST['blog-content']))) {
							//blog body is filled in
							$body = trim($_POST['blog-content']);

							if (strlen($body) < 150) {
								$blogpost_err = "Min post size is 150 characters!";
							} else {
								if (isset($_POST['blog-image']) && !empty(trim($_POST['blog-image']))) {
									$image_url = "'" . Trim($_POST['blog-image']) . "'";

									if (isset($_POST['image-position'])) {
										$image_pos = "'" . $_POST['image-position'] . "'";
									}
								} else {
									$image_url = $image_pos = "NULL";
								}
							}
						} else {
							//blog body is empty
							$blogpost_err = "Please enter a blog body!";
						}
					}
				}
				else {
					//blog title is empty
					$blogpost_err = "Please enter a blog title!";
				}
			}

			if (empty($blogpost_err)) {
				$user_id = $_SESSION['id'];
				$username = $_SESSION['username'];

				if($preview == FALSE){
					$sql = <<<SQL_BLOG
INSERT INTO blogposts (title, body, colour, image_url, image_position, user_id, username)
VALUES ('$title', '$body', '$title_colour', $image_url, $image_pos, '$user_id', '$username');
SQL_BLOG;
					if ($conn->query($sql) === TRUE) {

					} else {
						$blogpost_err = $conn->query($sql);
					}
				} else{


					$preview_post = array();
					$preview_post['title'] = "PREVIEW:".$title;
					$preview_post['body'] = $body;
					if(isset($title_colour)) {
						$preview_post['colour'] = $title_colour;
					}
					if(isset($image_url)){
						$preview_post['image_url'] = $image_url;
					}else{
						$image_url = null;
					}
					if(isset($image_pos)) {
						$preview_post['image_position'] = $image_pos;
					} else{
						$preview_post['image_position'] = "L";
					}
					$preview_post['user_id'] = $user_id;
					$preview_post['username'] = $username;
					$preview_post['created_at'] = date("Y-m-d H:i:s");




				}


			}

		}
		elseif ($_POST['submit'] == 'register') {
			$registration_err = "";

			$email = $_POST['register_email'];
			$username = $_POST['register_username'];
			$password = password_hash($_POST['register_password'],PASSWORD_DEFAULT);


			$sql = "SELECT * FROM users WHERE email ='$email'";
			$match = $conn->query($sql);

			if ($match && $match->num_rows != 0) {
				$registration_err = "Email already in use!";
			}


			$sql = "SELECT * FROM users WHERE username ='$username'";
			$match = $conn->query($sql);

			if ($match && $match->num_rows != 0) {
				$registration_err = "Username already in use!";
			}


			if (empty($registration_err)) {
				console_log("new user");

				$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

				if ($conn->query($sql) === TRUE) {
					console_log("Registration success");

					$_SESSION['id'] = $conn->insert_id; //query("SELECT LAST_INSERT_ID()")->fetch_assoc()['ID'];
					$_SESSION['loggedin'] = $loggedin = true;
					$_SESSION['username'] = $username;

					popup_alert("Logged in successfully! Welcome, " . $username);
				} else {
					$registration_err = "Unknown Database error";
				}
			}

			if(!empty($registration_err)){
				popup_alert($registration_err);
			}

		}

	}

	//if($_SERVER['REQUEST_METHOD'] == 'GET'){
		if(isset($_GET['selected-month'])){
			$selected_month = $_GET['selected-month'];
			//popup_alert("Month: " . $selected_month);
			console_log("Month: " . $selected_month);
			$_SESSION['filter-month'] = $selected_month;
		}else{
			unset($_SESSION['filter-month']);
		}
	//}

	function previewValues($value, $value_text=true)
	{

		//THIS IS ALL FUCKED

		console_log("PREVIEW VALUES START");
		//$preview = $_SESSION['preview'];
		global $preview, $preview_post;
		console_log("PREVIEW:" . $preview);
		if (isset($_POST['submit']) && $_POST['submit'] == 'preview' && false) {
			//$preview_post = $_SESSION['preview-post'];
			//if it's a preview, or posting failed due to error

			$key = "'" . $value . "'";
			console_log("PREVIEW VALUES ON ".$key);

			$val = $preview_post[$key];

			if ($val != "NULL") {
				if ($value_text) {
					return "value=$val";
				} else {
					return $val;
				}
			}
		}
	}
	function displayPost($blogdata)
	{
		console_log("displaypost start");
		$title = $blogdata['title'];
		$body = $blogdata['body'];
		$date = new DateTime($blogdata['created_at']);
		$date_formatted = $date->format('d/m/y');
		$username = $blogdata['username'];

		$markup =
			<<<BLOG
<div class="post-content">
	<div class="header-wrapper">
		<h2 class="drop-colour">$title</h2>
	</div>
	<h4>$date_formatted by $username</h4>
  <p>
  $body
  </p>
</div>
BLOG;

		if (isset($blogdata['image_url']) && !empty($blogdata['image_url']) && $blogdata['image_url'] != "NULL") {
			$image_url = $blogdata['image_url'];
			$image = "<figure><img src=\"$image_url\"></figure>";

			$image_position = $blogdata['image_position'];

			if ($image_position == "R" || $image_position == "r") {
				$markup = $markup . $image;
			} else {
				// left is defualt
				$markup = $image . $markup;
			}
			console_log("imageurl: " . $blogdata['image_url']);
		}

		$markup = <<<WRAPPER
<section class="post">
$markup
</section>
<br>
WRAPPER;

		return $markup;


	}

	?>
</head>
<body class="fill-screen-vertical">
<header class="top-content-panel fill-screen-horizontal">
	<div class="top-content content-wrapper">
		<div class="header-logo">
			<a href="home.php"><h1>beadle</h1></a>
		</div>
		<div class="header-nav">
			<nav role="navigation">
				<a href="about.php">about me</a>
				<a href="qualifications.php">qualifications</a>
				<a href="blog.php" class="drop-colour">blog</a>
				<a href="contact.php">contact</a>
			</nav>
		</div>
	</div>
</header>
<div class="main-content-panel fill-screen-horizontal center-content-horizontal">
	<div class="main-content content-wrapper center-content-horizontal">
		<article class="blog post-stack">
			<form action="" style="border: none; margin-bottom: 0em; padding-bottom: 0em;">
				<select id="selected-month" name="selected-month">
					<option value="all">View all</option>
					<?php
					$monthlist = array();

					$sql = "SELECT created_at FROM blogposts";
					$match = $conn->query($sql);
					if($match && $match->num_rows > 0){
						$row = array();

						foreach($match as $row){
							console_log($row);
							$date = strtotime($row['created_at']);
							$formatted = date("M-Y", $date);
							if(!in_array($formatted, $monthlist)){
								$monthlist[$formatted] = date($date);
							}
						}
						foreach($monthlist as $formatted => $date){
							echo "<option value='$formatted'>$formatted</option>";
						}
					}
					?>
				</select>
				<input type="submit" name="submit" value="go">
			</form>
			<article class="post-stack" style="margin:auto">
				<?php

				global $preview, $preview_post;
				if(isset($preview) && $preview == TRUE && isset($preview_post)){
					echo displayPost($preview_post);
				}

				if(isset($_SESSION['filter-month']) && $_SESSION['filter-month'] != 'all'){
					$date = strtotime($_SESSION['filter-month']);
					$month = date("n", $date);
					$year = date("Y", $date);
					console_log("Month: $month, Year: $year");
					$sql = "SELECT * FROM blogposts WHERE MONTH(created_at)=$month AND YEAR(created_at)=$year ORDER BY created_at DESC";
				} else{
					$sql = "SELECT * FROM blogposts ORDER BY created_at DESC";
				}
				$blogposts = $conn->query($sql);

				$blogs = array();
				while ($blog = $blogposts->fetch_assoc()) {
					$blogs[] = $blog;
				}
				foreach ($blogs as $blog) {
					echo displayPost($blog);
				}

				if ($loggedin) {
					echo $blogpost_form;
					echo $logout_form;
					if (!empty($blogpost_err)) {
						popup_alert($blogpost_err);
					}
				} else {
					$err_message = "";

					if (!empty($login_err)) {
						$err_message .= $login_err . "\\n";
					}
					if (!empty($password_err)) {
						$err_message .= $password_err . "\\n";
					}
					if (!empty($email_err)) {
						$err_message .= $email_err . "\\n";
					}

					if (!empty($err_message)) {
						$err_message = "Error logging in:\\n" . $err_message;
						popup_alert($err_message);
					}

					echo "</article><article class='post-stack' style='margin:auto'>";
					echo $login_form;
					echo $registration_form;
					echo "</article>";
				}
				?>
			</article>
	</div>
</div>
</body>
</html>
