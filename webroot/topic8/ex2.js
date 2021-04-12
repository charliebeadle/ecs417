function validateForm(){
	var x = document.forms["form"]["dob"].value;
	if(x == ""){
		alert("DOB must be filled out!");
		return false;
	}
}