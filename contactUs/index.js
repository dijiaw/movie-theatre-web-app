var feedbackName = document.getElementById("feedback-name");
var feedbackEmail = document.getElementById("feedback-mail");

feedbackName.addEventListener("change", checkName, false);
feedbackEmail.addEventListener("change", checkEmail, false);


function infoPopup(){
    alert("Thanks for your feedback! We will go through it carefully and get back to you!");
}