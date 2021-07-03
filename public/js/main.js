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
        let descriptionTxt = card.find('.description-hidden').text();
        const description = $.trim(descriptionTxt);
        console.log(descriptionTxt);
        const coverImage = card.find('.cover').attr('src');

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
            },
            error: function(err){
                console.log(err);
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
         
        reader.onload = (e) => {    
          $('#image-preview-edit').attr('src', e.target.result); 
          $('.no-cover').hide();

        }   
        reader.readAsDataURL(this.files[0]);       
    });

    //Only run on all-books & favourite-books, not single book view
    if (window.location.href.indexOf('all-books') > -1 || window.location.href.indexOf('favourite-books') > -1 ) {
        $('.description').each(function(i, obj) {
            //Grab the trimmed text
            let description = $.trim($(obj).text());
            const maxLength = 50;
            if(description.length > maxLength){
                //Trim descr
                description = description.substring(0,maxLength);
                description = description.concat('...');
                //Show 'View Full Book' txt
                $(obj).parent().find('.show-more').show();
            }
            $(obj).text(description)
        
        });
    } 
});
