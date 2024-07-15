//used to show password
function togglePwd() {
  // get the password object into a variable
  var pwd = document.getElementById("password");
  if (pwd.type === "password") 
    pwd.type = "text";
  else 
    pwd.type = "password";
}

var app = angular.module("StrengthValidationApp", []);
app.controller("StrengthValidationCtrl", function($scope) {

  var strongRegularExp = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
  var mediumRegularExp = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");

  $scope.validationInputPwdText = function(value) {
    if (strongRegularExp.test(value)) {
      $scope.checkpwdStrength["background-color"] = "green";
    } else if (mediumRegularExp.test(value)) {
      $scope.checkpwdStrength["background-color"] = "orange";
    } else {
      $scope.checkpwdStrength["background-color"] = "red";
    }
  };

});