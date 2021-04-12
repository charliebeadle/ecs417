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
