(function () {
  const DATA_THEME = localStorage.getItem('theme');
  const DATA_FONT = localStorage.getItem('font');
  $('html').attr('data-theme', DATA_THEME);
  $('html').attr('data-font', DATA_FONT);
  
  if (DATA_THEME == "light") {
    $('#main-sidebar').removeClass('sidebar-dark-primary')
    $('#main-sidebar').addClass('sidebar-light-primary')
    $('body').removeClass('dark-mode');
    $('table').removeClass('table-dark');
    $('nav').removeClass('navbar-dark')
    $('nav').addClass('navbar-light')
  } else {
    $('body').addClass('dark-mode');
    $('table').addClass('table-dark');
    $('nav').removeClass('navbar-light')
    $('nav').addClass('navbar-dark')
    $('#main-sidebar').removeClass('sidebar-light-primary')
    $('#main-sidebar').addClass('sidebar-dark-primary')
  }
})()

$('#sidebar-account').on('click', function() {
  if ($('#collapse-sidebar-account').hasClass('collapse-sidebar-account-active')) {
    $('#collapse-sidebar-account').removeClass('collapse-sidebar-account-active');
    $('#collapse-sidebar-account').addClass('collapse-sidebar-account-disabled');
  } else {
    $('#collapse-sidebar-account').removeClass('collapse-sidebar-account-disabled');
    $('#collapse-sidebar-account').addClass('collapse-sidebar-account-active');
  }

  $('#arrow-sidebar-account').toggleClass('fa-angle-left fa-angle-up');
});