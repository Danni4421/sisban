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