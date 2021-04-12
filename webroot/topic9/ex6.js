function checkPasswords(){
	var password = document.getElementById("password").value;
	var confirm = document.getElementById("password_confirm").value;
	if(password == confirm){
		alert("ok!");
		return true;
	} else{
		alert("Passwords do not match!");
		return false;
	}
}