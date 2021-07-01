$(document).ready(function () {
    $('.openModal').on('click', function(e){
        $('#newBookModal').show();
    });
    $('.closeModal').on('click', function(e){
        $('#newBookModal').hide();
    });
});
