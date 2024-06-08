/**
 * Notification Functionality
 */

$('#notification_cta').on('click', (e) =>  {
    e.stopPropagation();
    $('#account_dropdown_menu').hide();
    $('#notification_box').toggle();
});

$('#account_dropdown_menu_link').on('click', (e) => {
    e.stopPropagation();
    $('#notification_box').hide();
    $('#account_dropdown_menu').toggle();
});

$('#notification_popup').on('click', (e) => {
    e.stopPropagation();
});

$(window).on('click', () => {
    $('#notification_box').hide();
    $('#account_dropdown_menu').hide();
});

/**
 * End Notification Functionality
 */