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
        const elem = $(event.currentTarget);
        const card = elem.closest('.bookCard');
        const id = card.find('.id').val();
        const name = card.find('.bookName').text();
        const isbn = card.find('.isbn').val();
        const year = card.find('.year').val();
        let descriptionTxt = card.find('.description').text();
        const description = $.trim(descriptionTxt);
        const coverImage = card.find('.cover').attr('src');
        console.log(card)
        console.log(name)
        console.log(isbn)
        console.log(year)

        const editModal = $('#editBookModal');
        editModal.show();
        editModal.find('#id').val(id);
        editModal.find('#name').val(name);
        editModal.find('#isbn').val(isbn);
        editModal.find('#year').val(year);
        editModal.find('#image-preview-edit').attr('src', coverImage);
        editModal.find('#description').val(description);
    });

    $('.deleteBtn').on('click', function(e){
        const id = e.currentTarget.getAttribute("data-id");
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

    $('.image-uploader-new').change(function(){
        let reader = new FileReader(); 
        
         
        reader.onload = (e) => {    
          $('#image-preview-new').attr('src', e.target.result); 
          $('.no-cover').hide();
        }   
        reader.readAsDataURL(this.files[0]);       
    });
    $('.image-uploader-edit').change(function(){
        let reader = new FileReader(); 
        console.log('swapping src')
         
        reader.onload = (e) => {    
          $('#image-preview-edit').attr('src', e.target.result); 
          $('.no-cover').hide();

        }   
        reader.readAsDataURL(this.files[0]);       
    });
});
