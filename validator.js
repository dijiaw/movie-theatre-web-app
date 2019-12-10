function checkName(event){
    var name = event.currentTarget;
    var result = name.value.search(/^[a-zA-Z ]+$/);
    if (result!= 0) {
        alert("The name you entered [" + name.value + "] is invalid.\nPlease make sure your name contains only alphabets.");
        name.focus();
        name.select();
        return false;
    }  
}

function checkEmail(event){
    var email = event.currentTarget;
    var valid = email.value.search(/^[\w.-]+@([\w]+\.){1,3}[A-Za-z]{2,3}$/);
    if (valid!= 0 && email.value!='f36ee@localhost') {
        alert("The email you entered [" + email.value + "] is invalid.\nPlease ensure there are only 2 - 4 address extensions in your domain name.");
        email.focus();
        email.select();
        return false;
  }   
}

function checkUsername(event){
    var username = event.currentTarget;
    var result = username.value.search(/^[\w]+$/);
    if (result!= 0) {
        alert("The username you entered [" + username.value + "] is invalid.\nPlease make sure your username contains only digits and alphabets without space in between");
        username.focus();
        username.select();
        return false;
    }  
}

function checkPassword(event){
    var passObj = event.currentTarget;
    var pass = passObj.value;
    if (pass.length < 5 || pass.search(/[A-Za-z]/)==-1 || pass.search(/\d/)==-1) {
        alert("You entered an invalid password.\nPlease make sure your password contains both digits and alphabets and has a length longer than 4.");
        passObj.focus();
        passObj.select();
        pass = "";
        return false;
    }
}

function matchSecondPassword(event) {
    var newpassword = document.getElementById("newpassword").value;
    var secondPasswordObj = event.currentTarget;
    var secondpassword = secondPasswordObj.value;
    if (secondpassword != newpassword) {
        alert("The two passwords you entered do not match each other.\nPlease make sure they have the same value.");
        secondPasswordObj.focus();
        secondPasswordObj.select();
        secondpassword = "";
        return false;
    }
}
