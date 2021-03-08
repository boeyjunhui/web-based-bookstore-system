//validate  add member
function validate_add_member() {

    var letter_pattern = /^[a-zA-Z.\s ]+$/
    var phone_pattern = /^[\s()+-]*([0-9][\s()+-]*){6,20}$/
    var email_pattern = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/
    
    var firstname = document.getElementById('firstname').value;
    var lastname = document.getElementById('lastname').value;
    var email = document.getElementById('email').value;
    var phone = document.getElementById('phone').value;
    var password = document.getElementById('npassword').value;
    var retypepassword = document.getElementById('cnpassword').value;
   

    if (!firstname.match(letter_pattern)) {
        alert("Invalid First Name. Please use letters only.");
        return false;
    } 
    else if (!lastname.match(letter_pattern)) {
        alert("Invalid Last Name. Please use letters only.");
        return false;
    } 
    else if (!email.match(email_pattern)) {
        alert("Invalid Email. Must require proper email characters.");
        return false;
    } 
    else if (!phone.match(phone_pattern)|| phone.length > 20) {
        alert("Invalid Phone Number. Number length cannot be more than 20 and please use number only.");
        return false;
    } 
    else if (password != retypepassword) {
        alert("Password confirmation does not match.");
        return false;
    } 
    else {
        return true;
    }

}

//validate edit member
function validate_edit_member() {
  
    var letter_pattern = /^[a-zA-Z.\s ]+$/
    var phone_pattern = /^[\s()+-]*([0-9][\s()+-]*){6,20}$/
    var email_pattern = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/
    
    var firstname = document.getElementById('firstname').value;
    var lastname = document.getElementById('lastname').value;
    var email = document.getElementById('email').value;
    var phone = document.getElementById('phone').value;
    var password = document.getElementById('npassword').value;
    var retypepassword = document.getElementById('cnpassword').value;
   


    if (!firstname.match(letter_pattern)) {
        alert("Invalid First Name. Please use letters only.");
        return false;
    } 
    else if (!lastname.match(letter_pattern)) {
        alert("Invalid Last Name. Please use letters only.");
        return false;
    } 
    else if (!email.match(email_pattern)) {
        alert("Invalid Email. Must require proper email characters.");
        return false;
    } 
    else if (!phone.match(phone_pattern)|| phone.length > 20) {
        alert("Invalid Phone Number. Number length cannot be more than 20 and please use number only.");
        return false;
    } 
    else if (password != retypepassword) {
        alert("Password confirmation does not match.");
        return false;
    } else {
        return true;
    }

}

//validate  edit customer

function validate_edit_customer() {

    var letter_pattern = /^[a-zA-Z.\s ]+$/
    var phone_pattern = /^[\s()+-]*([0-9][\s()+-]*){6,20}$/
    var email_pattern = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/
    
    var firstname = document.getElementById('firstname').value;
    var lastname = document.getElementById('lastname').value;
    var email = document.getElementById('email').value;
    var phone = document.getElementById('phone').value;
    var city = document.getElementById('city').value;
    var state = document.getElementById('state').value;
    var zipcode = document.getElementById('zipcode').value;
    var password = document.getElementById('npassword').value;
    var retypepassword = document.getElementById('cnpassword').value;
   

    if (!firstname.match(letter_pattern)) {
        alert("Invalid First Name. Please use letters only.");
        return false;
    } 
    else if (!lastname.match(letter_pattern)) {
        alert("Invalid Last Name. Please use letters only.");
        return false;
    } 
    else if (!email.match(email_pattern)) {
        alert("Invalid Email. Must require proper email characters.");
        return false;
    } 
    else if (!phone.match(phone_pattern)|| phone.length > 20) {
        alert("Invalid Phone Number. Number length cannot be more than 20 and please use number only.");
        return false;
    } 
    else if (!city.match(letter_pattern)) {
        alert("Invalid city. Please use letters only.");
        return false;
    } 
    else if (!state.match(letter_pattern)) {
        alert("Invalid state. Please use letters only.");
        return false;
    } 
    else if (isNaN(zipcode) || zipcode.length !=5) {
        alert("Invalid Zipcode. Number length must be 5 and please use number only.");
        return false;
    } 
    else if (password != retypepassword) {
        alert("Password confirmation does not match.");
        return false;
    } 
    else {
        return true;
    }

}

//validate edit order
function validate_edit_order() {


    var letter_pattern = /^[a-zA-Z,.\s ]*$/
    var alphanumeric_pattern = /^[A-Za-z0-9\s ]*$/
    var capital_alphanumeric_pattern = /^[A-Z]*[A-Z0-9]*$/

    var paymentmethod = document.getElementById('paymentmethod').value;
    var bank = document.getElementById('bank').value;
    var bankreferenceno = document.getElementById('bankreferenceno.').value;
    var courier = document.getElementById('courier').value;
    var trackingno = document.getElementById('trackingnumber').value;

    if (!paymentmethod.match(letter_pattern)) {
        alert("Invalid Payment Type. Use letters only.");
        return false;
    } 
    else if (!bank.match(letter_pattern)) {
        alert("Invalid Bank Name. Please use letters only.");
        return false;
    } 
    else if(isNaN(bankreferenceno) || bankreferenceno.length >30) {
        alert("Invalid Bank Reference Number. Please use numbers only.");
        return false;
    }
    else if (!courier.match(alphanumeric_pattern)) {
        alert("Invalid Courier Name. Please use letters and numbers and no symbols.");
        return false;
    } 
    else if (!trackingno.match(capital_alphanumeric_pattern)) {
        alert("Invalid Tracking Number. It must start with capital letters and then numbers.");
        return false;
    }  
    else {
        return true;
    }

}

//validate add supplier
function validate_add_supplier() {

    var letter_pattern = /^[a-zA-Z.\s ]+$/
    var phone_pattern = /^[\s()+-]*([0-9][\s()+-]*){6,20}$/
    var alphanumeric_pattern = /^[A-Za-z0-9,.\s ]+$/
    var email_pattern = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/
    
    var suppliername = document.getElementById('suppliername').value;
    var companyname = document.getElementById('companyname').value;
    var phone = document.getElementById('phone').value;
    var email = document.getElementById('email').value;
    

    if (!suppliername.match(letter_pattern)) {
        alert("Invalid Supplier Name. Please use letters only.");
        return false;
    }
    else if (!companyname.match(alphanumeric_pattern)) {
        alert("Invalid Company Name. Please use letters only.");
        return false;
    } 
    else if (!phone.match(phone_pattern)|| phone.length > 20) {
        alert("Invalid Phone Number. Number length cannot be more than 20 and please use number only.");
        return false;
    } 
    else if (!email.match(email_pattern)) {
        alert("Invalid Email. Must require proper email characters.");
        return false;
    } 
    else {
        return true;
    }

}

//validate edit supplier
function validate_edit_supplier() {

    var letter_pattern = /^[a-zA-Z.\s ]+$/
    var phone_pattern = /^[\s()+-]*([0-9][\s()+-]*){6,20}$/
    var alphanumeric_pattern = /^[A-Za-z0-9,.\s ]+$/
    var email_pattern = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/
    
    var suppliername = document.getElementById('suppliername').value;
    var companyname = document.getElementById('companyname').value;
    var phone = document.getElementById('phone').value;
    var email = document.getElementById('email').value;
    

    if (!suppliername.match(letter_pattern)) {
        alert("Invalid Supplier Name. Please use letters only.");
        return false;
    }
    else if (!companyname.match(alphanumeric_pattern)) {
        alert("Invalid Company Name. Please use letters only.");
        return false;
    } 
    else if (!phone.match(phone_pattern)|| phone.length > 20) {
        alert("Invalid Phone Number. Number length cannot be more than 20 and please use number only.");
        return false;
    } 
    else if (!email.match(email_pattern)) {
        alert("Invalid Email. Must require proper email characters.");
        return false;
    } 
    else {
        return true;
    }

}

//validate add book
function validate_add_book() {

    var letter_pattern = /^[a-zA-Z.\s ]+$/
    var alphanumeric_pattern = /^[A-Za-z0-9,.:&\s ]+$/
    var alphanumeric_and_symbol_pattern = /^[a-zA-Z0-9!@#$&()`.+,/:'"-\s ]*$/

    var booktitle = document.getElementById('booktitle').value;
    var author = document.getElementById('author').value;
    var isbn13 = document.getElementById('isbn13').value;
    var format = document.getElementById('format').value;
    var weight = document.getElementById('weight').value;
    var publisher = document.getElementById('publisher').value;

    
    if (!booktitle.match(alphanumeric_and_symbol_pattern)) {
        alert("Invalid Book Title. Please use letters only.");
        return false;
    }
    if (!author.match(letter_pattern)) {
        alert("Invalid Name. Please use letters only.");
        return false;
    } 
    else if (isNaN(isbn13) || isbn13.length != 13) {
        alert("Invalid ISBN Number. Number length must be 13.");
        return false;
    } 
    else if (!format.match(alphanumeric_pattern)) {
        alert("Invalid format. Please correct.");
        return false;
    } 
    else if (!weight.match(alphanumeric_pattern)) {
        alert("Invalid Weight. Please correct.");
        return false;
    } 
    else if (!publisher.match(alphanumeric_pattern)) {
        alert("Invalid Publisher. Please use letters only.");
        return false;
    } 
    else {
        return true;
    }

}

//validate edit book
function validate_edit_book() {

    var letter_pattern = /^[a-zA-Z.\s ]+$/
    var alphanumeric_pattern = /^[A-Za-z0-9,.:&\s ]+$/
    var alphanumeric_and_symbol_pattern = /^[a-zA-Z0-9!@#$&()`.+,/:'"-\s ]*$/

    var booktitle = document.getElementById('booktitle').value;
    var author = document.getElementById('author').value;
    var isbn13 = document.getElementById('isbn13').value;
    var format = document.getElementById('format').value;
    var weight = document.getElementById('weight').value;
    var publisher = document.getElementById('publisher').value;

    
    if (!booktitle.match(alphanumeric_and_symbol_pattern)) {
        alert("Invalid Book Title. Please use letters or numbers only.");
        return false;
    }
    else if (!author.match(letter_pattern)) {
        alert("Invalid Author Name. Please use letters only.");
        return false;
    }
    else if (isNaN(isbn13) || isbn13.length != 13) {
        alert("Invalid ISBN Number. Number length must be 13.");
        return false;
    } 
    else if (!format.match(alphanumeric_pattern)) {
        alert("Invalid format. Please correct.");
        return false;
    } 
    else if (!weight.match(alphanumeric_pattern)) {
        alert("Invalid Weight. Please correct.");
        return false;
    } 
    else if (!publisher.match(alphanumeric_pattern)) {
        alert("Invalid Publisher. Please use letters only.");
        return false;
    } 
    else {
        return true;
    }


}

