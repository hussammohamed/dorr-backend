//login dailog
var login = document.querySelector('#loginBtn');
var loginDialog = document.querySelector('#loginDialog');
var signup = document.querySelector('#signupBtn');
var signupDialog = document.querySelector('#signupDialog');
var reLoginBtn = document.querySelector('#reLoginBtn');
var userMenu = document.querySelector('#userMenu');
if(login){
login.addEventListener('click', function() {
  loginDialog.showModal();
});
}
signup.addEventListener('click', function() {
  loginDialog.close();
  signupDialog.showModal();
});
reLoginBtn.addEventListener('click', function() {
  signupDialog.close();
  loginDialog.showModal();
});

loginDialog.addEventListener('click', function (event) {
  var rect = loginDialog.getBoundingClientRect();
  var isInDialog=(rect.top <= event.clientY && event.clientY <= rect.top + rect.height && rect.left <= event.clientX && event.clientX <= rect.left + rect.width);
  if (!isInDialog) {
    loginDialog.close();
  }
});
signupDialog.addEventListener('click', function (event) {
  var rect = signupDialog.getBoundingClientRect();
  var isInDialog=(rect.top <= event.clientY && event.clientY <= rect.top + rect.height && rect.left <= event.clientX && event.clientX <= rect.left + rect.width);
  if (!isInDialog) {
    signupDialog.close();
  }
});
if(userMenu){
  userMenu.addEventListener('click', function() {
    $(this).toggleClass('extended');
  });
}