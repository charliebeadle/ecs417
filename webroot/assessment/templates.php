<?php
echo '<script src="scripts.js"></script>';

$login_form = <<<LOGIN
<section class="post login-form" style="margin:1em">
	<div>
		<form action="" method="POST" class="login-form">
			<legend>
 				<div class="header-wrapper">
    				<h2>login</h2>
  				</div>
			</legend>
			<br>
			<table>
				<tr>
				 	<td>
      					<label for="email">email</label>
    				</td>
    				<td>
					 	<input type="email" id="email" name="email" required>
					</td>
  				</tr>
				<tr>
					<td>
						<label for="password">password</label>
					</td>
					<td>
						<input type="password" id="password" name="password" minlength="8" required>
					</td>
				</tr>
				<tr>
					<td colspan=2 style="text-align: center">
						<br>
						<input type="submit" name="submit" value="login">
					</td>
				</tr>
			</table>
		</form>
	</div>
</section>
LOGIN;
$registration_form = <<<REGISTRATION
<section class="post login-form" style="margin:1em">
    <div>
      <form action="" onsubmit="verifyRegistration(); return false" method="POST" class="login-form" id="register-form">
		  <legend>
			<div class="header-wrapper">
			  <h2>register</h2>
			</div>
		  </legend>
      <br>
      <table>
        <tr>
          <td>
            <label for="register_username">username</label>
          </td>
          <td>
            <input type="text" id="register_username" name="register_username" required autocomplete="new-password"
          </td>
        </tr>
        <tr></tr>
        <tr>
          <td>
            <label for="register_email">email</label>
            </td>
            <td>
              <input type="email" id="register_email" name="register_email" required autocomplete="new-password">
            </td>
        </tr>
        <tr></tr>
        <tr>
          <td>
            <label for="register_password">password</label>
            </td>
            <td>
              <input type="password" id="register_password" name="register_password" minlength="8" required autocomplete="new-password">
		  </td>
        </tr>
        <tr></tr>
        <tr>
          <td>
            <label for="password">confirm</label>
          </td>
          <td>
            <input type="password" id="confirm_password" name="confirm_password" minlength="8" required autocomplete="new-password">
          </td>
        </tr>
        <tr></tr>
        <tr>
          <td colspan=2 style="text-align: center">
            <br>
            <input type="submit" name="submit" value="register">
          </td>
        </tr>
      </table>
    </form>
  </div>
</section>
REGISTRATION;
$fn = 'previewValues';


$blogpost_form = <<<BLOGPOST_FORM
<section class="post blog-post-form" >
	<div class="post-content">
		<form   onsubmit="preventDefault(); return false" action="" method="POST" class="blog-post-form" id="blog-post-form">
			<legend>
			  <div class="header-wrapper">
				<h2>new blog post</h2>
			  </div>
			</legend>
			<table>
			  <tr>
				<td>
				  <label for="blog-title">title</label>
				</td>
			  </tr>
			  <tr>
				<td>
				  <input type="text" id="blog-title" name="blog-title" {$fn('title')}>
				</td>
			  </tr>
			  <tr>
				<td>
				  <label for="blog-content">text</label>
				</td>
			  </tr>
			  <tr>
				<td>
				  <textarea id="blog-content" name="blog-content">{$fn('body', false)}</textarea>
				</td>
			  </tr>
			  <tr>
				<td>
				  <label for="blog-image" >image URL</label>
				</td>
			  </tr>
			  <tr>
				<td>
				  <input type="url" id="blog-image" name="blog-image" {$fn('image_url')}>
				  </td>
				</tr>
				<tr>
				  <td>
				  <input type="radio" id="left" name="image-position" value="left">
				  <label for="left">Left/top</label>
				  <input type="radio" id="right" name="image-position" value="right">
				  <label for="right">Right/bottom</label>
				</td>
			  </tr>
			  <tr>
				<td style="text-align:center">
				  <input type="submit" class="btn_inline" name="submit" value="post">
					<input type="submit" class="btn_inline" name="submit" value="preview">
				  <input type="reset" class="btn_inline" name="reset" value="clear">
				</td>
			  </tr>
			</table>
		</form>
	</div>
</section>
BLOGPOST_FORM;
$logout_form = <<<LOGOUT
<section class="post">
	<a href="logout.php" class="post-content">
		<div class="header-wrapper">
			<h2>logout</h2>
		</div>
	</a>
</section>
LOGOUT;
?>
