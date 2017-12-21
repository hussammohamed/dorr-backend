//login dailog
var login = document.querySelector('#loginBtn');
var loginDialog = document.querySelector('#loginDialog');
var signup = document.querySelector('#signupBtn');
var signupDialog = document.querySelector('#signupDialog');
var reLoginBtn = document.querySelector('#reLoginBtn');
login.addEventListener('click', function() {
  loginDialog.showModal();
});
signup.addEventListener('click', function() {
  loginDialog.close();
  signupDialog.showModal();
});
reLoginBtn.addEventListener('click', function() {
  signupDialog.close();
  loginDialog.showModal();
});