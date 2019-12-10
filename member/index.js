var existingUsername = document.getElementById("existingusername");
var existingPassword = document.getElementById("existingpassword");

existingName.addEventListener("change", checkUsername, false);
existingPassword.addEventListener("change", checkPassword, false);


var newName = document.getElementById("newname");
var newEmail = document.getElementById("newemail");
var newUsername = document.getElementById("newusername");
var newPassword = document.getElementById("newpassword");
var confirmPassword = document.getElementById("confirmpassword");

newName.addEventListener("change", checkName, false);
newEmail.addEventListener("change", checkEmail, false);
newUsername.addEventListener("change", checkUsername, false);
newPassword.addEventListener("change", checkPassword, false);
confirmPassword.addEventListener("change", matchSecondPassword, false);