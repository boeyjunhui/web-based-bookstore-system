// Validate customer sign up
function validate_customer_sign_up() {
  var name_pattern = /^[a-zA-Z.\s ]+$/
  var email_pattern = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/

  var firstname = document.getElementById("firstname").value;
  var lastname = document.getElementById("lastname").value;
  var phone = document.getElementById("phone").value;
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;
  var city = document.getElementById("city").value;
  var state = document.getElementById("state").value;
  var zipcode = document.getElementById("zipcode").value;

  if (!firstname.match(name_pattern) || firstname.length > 50) {
    alert("Invalid First Name. Use letters only and not more than 50 characters.");
    return false;
  } else if (!lastname.match(name_pattern) || lastname.length > 50) {
    alert("Invalid Last Name. Use letters only and not more than 50 characters.");
    return false;
  } else if (isNaN(phone) || (phone.length != 10 && phone.length != 11)) {
    alert("Invalid Contact Number. Can only insert with number and number length must be 10 or 11.");
    return false;
  } else if (!email.match(email_pattern) || email.length > 100) {
    alert("Invalid Email. Please enter proper email and not more than 100 characters.");
    return false;
  } else if (password.length > 50) {
    alert("Invalid Password. Password can only be insert within 50 characters");
    return false;
  } else if (!city.match(name_pattern) || city.length > 20) {
    alert("Invalid City. City name cannot be more than 20 characters.");
    return false;
  } else if (!state.match(name_pattern) || state.length > 20) {
    alert("Invalid State. Use letters only and not more than 20 characters.");
    return false;
  } else if (isNaN(zipcode) || zipcode.length != 5) {
    alert("Invalid Zip Code. Must be written in numeric and 5 digits only.");
    return false;
  } else {
    return true;
  }
}

// Validate customer login
function validate_customer_login() {
  var email = document.getElementById("email").value;
  var email_pattern = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/
  var password = document.getElementById("password").value;

  if (!email.match(email_pattern) || email.length > 100) {
    alert("Invalid Email. Please enter proper email and not more than 100 characters.");
    return false;
  } else if (password.length > 50) {
    alert("Invalid Password. Password can only be insert within 50 characters");
    return false;
  } else {
    return true;
  }
}

// Validate customer edit profile
function validate_customer_edit_profile() {
  var name_pattern = /^[a-zA-Z.\s ]+$/
  var email_pattern = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/

  var firstname = document.getElementById("firstname").value;
  var lastname = document.getElementById("lastname").value;
  var phone = document.getElementById("phone").value;
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;
  var city = document.getElementById("city").value;
  var state = document.getElementById("state").value;
  var zipcode = document.getElementById("zipcode").value;

  if (!firstname.match(name_pattern) || firstname.length > 50) {
    alert("Invalid First Name. Use letters only and not more than 50 characters.");
    return false;
  } else if (!lastname.match(name_pattern) || lastname.length > 50) {
    alert("Invalid Last Name. Use letters only and not more than 50 characters.");
    return false;
  } else if (isNaN(phone) || (phone.length != 10 && phone.length != 11)) {
    alert("Invalid Contact Number. Can only insert with number and number length must be 10 or 11.");
    return false;
  } else if (!email.match(email_pattern) || email.length > 100) {
    alert("Invalid Email. Please enter proper email and not more than 100 characters.");
    return false;
  } else if (password.length > 50) {
    alert("Invalid Password. Password can only be insert within 50 characters");
    return false;
  } else if (!city.match(name_pattern) || city.length > 20) {
    alert("Invalid City. City name cannot be more than 20 characters.");
    return false;
  } else if (!state.match(name_pattern) || state.length > 20) {
    alert("Invalid State. Use letters only and not more than 20 characters.");
    return false;
  } else if (isNaN(zipcode) || zipcode.length != 5) {
    alert("Invalid Zip Code. Must be written in numeric and 5 digits only.");
    return false;
  } else {
    return true;
  }
}

// Validate customer contact
function validate_customer_contact() {
  var name_pattern = /^[a-zA-Z.\s ]+$/
  var email_pattern = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/

  var fullname = document.getElementById("name").value;
  var phone = document.getElementById("phone").value;
  var email = document.getElementById("email").value;

  if (!fullname.match(name_pattern) || fullname.length > 50) {
    alert("Invalid Name. Use letters only and not more than 100 characters.");
    return false;
  } else if (isNaN(phone) || (phone.length != 10 && phone.length != 11)) {
    alert("Invalid Contact Number. Can only insert with number and number length must be 10 or 11.");
    return false;
  } else if (!email.match(email_pattern) || email.length > 100) {
    alert("Invalid Email. Please enter proper email and not more than 100 characters.");
    return false;
  } else {
    return true;
  }
}
