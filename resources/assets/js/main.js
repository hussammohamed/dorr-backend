//login dailog
var loginDialog = document.querySelector('#loginDialog');
var signupDialog = document.querySelector('#signupDialog');
var userMenu = document.querySelector('#userMenu');
var url = null;
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
    result.empty().append((value * .025).toFixed(2) + ' ' + 'ريال')
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
//login 

function loginShow(currentUrl){
  if(currentUrl){
    url = currentUrl;
  }
  loginDialog.showModal();
}
