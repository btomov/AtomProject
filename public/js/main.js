$(document).ready(function () {
    $('.openModal').on('click', function(e){
        $('#newBookModal').show();
    });
    $('.closeModal').on('click', function(e){
        $('#newBookModal').hide();
        $('#editBookModal').hide();
    });
    
    
    $('.showEditModal').on('click', function(event){
        console.log(event.target);
        let id = event.currentTarget.getAttribute("data-id");
        let name = event.currentTarget.getAttribute("data-name");
        let isbn = event.currentTarget.getAttribute("data-isbn");
        let year = event.currentTarget.getAttribute("data-year");
        let description = event.currentTarget.getAttribute("data-description");
        let coverImage = event.currentTarget.getAttribute("data-coverImage");
        console.log(isbn);
        console.log(year);
        const editModal = $('#editBookModal');
        editModal.show();
        editModal.find('#id').val(id);
        editModal.find('#name').val(name);
        editModal.find('#isbn').val(isbn);
        editModal.find('#year').val(year);
        editModal.find('#coverImage').val(coverImage);
        editModal.find('#description').val(description);
    });

    $('.deleteBtn').on('click', function(e){
        const id = e.currentTarget.getAttribute("data-id");
        console.log(id);
        $.ajax({
            url: '/delete-book/'+ id,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            success: function(result) {
                window.location.reload();
            }
        });
        
    });
});
