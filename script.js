
function validateForm() {
  const name = document.forms["registerForm"]["username"].value;
  const email = document.forms["registerForm"]["email"].value;
  const phoneNumber = document.forms["registerForm"]["phone"].value;
  const password = document.forms["registerForm"]["regpass"].value;
  const confirmPassword = document.forms["registerForm"]['regpass2'].value;
  const errorMessage = document.getElementById("errorMessageRegistration");
  
  if (name == "") {
    errorMessage.innerText = "Username must be filled out";
    return false;
  }
  if (email == "" ){
    errorMessage.innerText = "Email must be filled out";
    return false;
  } 
  if(email.match(/[a-z0-9]+@[a-z]+/g) === null){
    errorMessage.innerText = "Email must be a valid address";
    return false;
  } 
  if (phoneNumber == ""){
    errorMessage.innerText = "Phone number must be filled out";
    return false;
  }
  if (phoneNumber.match(/^[0-9]*$/g) === null){
    errorMessage.innerText = "Phone number must only contain numbers";
    return false;
  }
  if (password == ""){
    errorMessage.innerText = "Password must not be empty";
    return false;
  }
  if (confirmPassword !== password){
    errorMessage.innerText = "Passwords must match";
    return false;
  } 
  if (password.match(/[A-Z]/g) && password.match(/[a-z]/g) && password.match(/[0-9]/g) && password.match(/[^a-zA-Z\d]/g) && password.length > 7){
    return true;
  }
  else{
    errorMessage.innerText = "Password must be at least 8 characters long and contain at least 1 symbol, 1 number, 1 uppercase letter and 1 lowercase letter";
    return false;
  }
  
}

function loginvalidation(){
  const name = document.forms["loginForm"]["username_login"].value;
  const password = document.forms["loginForm"]["password_login"].value;
  const error = document.getElementById("errorMessageLogin");
  
  if(name == ""){
    error.innerText = "Username must be filled out";
    return false;
  }if (password == ""){
    error.innerText = "Password must not be empty";
    return false;
  }
}

