$(window).load(function () {
    hideLoader();
    $('.dataTables_empty').html('No data available');
});

function showLoader() {
    $('#loader').fadeIn();
}

function hideLoader() {
    $('#loader').fadeOut();
    $('.dataTables_empty').html('No data available');
}
