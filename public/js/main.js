$(document).ready(function () {
    $('.openModal').on('click', function(e){
        $('#newBookModal').show();
    });
    $('.settings-dropdown').on('click', function(e){
        $('#editUserModal').show();
    });
    $('.closeModal').on('click', function(e){
        $('#newBookModal').hide();
        $('#editBookModal').hide();
    });
    
    
    $('.showEditModal').on('click', function(event){
        let id = event.currentTarget.getAttribute("data-id");
        let name = event.currentTarget.getAttribute("data-name");
        let isbn = event.currentTarget.getAttribute("data-isbn");
        let year = event.currentTarget.getAttribute("data-year");
        let description = event.currentTarget.getAttribute("data-description");
        let coverImage = event.currentTarget.getAttribute("data-coverImage");

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

    $('.favouriteBtn').on('click', function(e){
        const btn = $( e.target );
        const id = e.currentTarget.getAttribute("data-id");
        $.ajax({
            url: '/toggle-favourite-book/'+ id,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            success: function(result) {
                //Change the icon's color based on whether we're removing or adding to favourites
                switch(result.action){
                    case 'added':
                        btn.closest('#favouriteIcon').css({ fill: 'red' })
                        break;
                    case 'deleted':
                        btn.closest('#favouriteIcon').css({ fill: 'black' })
                        //Reload to get it out of sight if we're looking at favourites
                        if (window.location.href.indexOf('favourite-books') > -1) {
                            window.location.reload();
                        }
                        break;
                }
            },
            error: function(err){
                console.log(err);
            }
        });
    });

    $('.viewBtn').on('click', function(e){
        const id = e.currentTarget.getAttribute("data-id");
        console.log(id);
        $.ajax({
            url: '/book/'+ id,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET'
        });      
    });
});
