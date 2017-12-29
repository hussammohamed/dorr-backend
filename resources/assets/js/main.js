//login dailog
var login = document.querySelector('#loginBtn');
var loginDialog = document.querySelector('#loginDialog');
var signup = document.querySelector('#signupBtn');
var signupDialog = document.querySelector('#signupDialog');
var reLoginBtn = document.querySelector('#reLoginBtn');
var userMenu = document.querySelector('#userMenu');
if (login) {
  login.addEventListener('click', function () {
    loginDialog.showModal();
  });
}
signup.addEventListener('click', function () {
  loginDialog.close();
  signupDialog.showModal();
});
reLoginBtn.addEventListener('click', function () {
  signupDialog.close();
  loginDialog.showModal();
});

loginDialog.addEventListener('click', function (event) {
  var rect = loginDialog.getBoundingClientRect();
  var isInDialog = (rect.top <= event.clientY && event.clientY <= rect.top + rect.height && rect.left <= event.clientX && event.clientX <= rect.left + rect.width);
  if (!isInDialog) {
    loginDialog.close();
  }
});
signupDialog.addEventListener('click', function (event) {
  var rect = signupDialog.getBoundingClientRect();
  var isInDialog = (rect.top <= event.clientY && event.clientY <= rect.top + rect.height && rect.left <= event.clientX && event.clientX <= rect.left + rect.width);
  if (!isInDialog) {
    signupDialog.close();
  }
});
if (userMenu) {
  userMenu.addEventListener('click', function () {
    $(this).toggleClass('extended');
  });
}

$("#zakah").on("change paste keyup", function () {
  let value = $(this).val()
  let result = $('#zakahResult');
  if (!isNaN(value)) {
    result.empty().append((value * .25) + ' ' + 'ريال')
  }
});


$(window).scroll(function (e) {
  var stickyContainer = $('.sticky-container');
  var stickyEl = $('.sticky-item');
  var Position = stickyContainer.offset();
  var scrollTop = $(this).scrollTop();
  if (stickyContainer.length) {
    if (scrollTop > (Position.top + 100) && (scrollTop - Position.top) < (stickyContainer.height() - stickyEl.height() + 204)) {
      stickyEl.css({ 'top': scrollTop - Position.top - 200 });
    }
    if ($(this).scrollTop() < Position.top) {
      stickyEl.css({ 'top': 8 });
    }
  }
});