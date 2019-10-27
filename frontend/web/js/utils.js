
function checkIsNullOrEmpty(value){
	return value === null || value.length == 0; 
}

function checkIsNullOrZero(value){
	return value === null || value == 0; 
}

function isOdd(num) { 
	return num % 2;
}


function validateEmail(email) {
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}


