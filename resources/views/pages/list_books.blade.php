@include('partials.head')
@include('layouts.navigation');
    <div class="p-10 flex">
      @if($books)
        @foreach($books as $book)

        <!--Card 1-->
        <div class="max-w-sm rounded overflow-hidden shadow-lg m-8">
          <img class="w-full" src={{$book->coverImage}} alt="Mountain">
          <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">{{$book->name}}</div>
            <p class="text-gray-700 text-base">
                {{$book->description}}
                {{$book->year}}
            </p>
          </div>
          
          <div class="px-6 pt-4 pb-2">
            {{-- Delete --}}
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 deleteBtn" data-id={{$book->id}}>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
              </svg>
            </span>

            {{-- Edit --}}
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 showEditModal" 
              data-id={{$book->id}}
              data-name={{$book->name}} 
              data-isbn={{$book->ISBN}}
              data-year={{$book->year}} 
              data-description={{$book->description}}
              data-coverImage={{$book->coverImage}}>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
              </svg>
            </span>

            {{-- Favourite --}}
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 favouriteBtn" data-id={{$book->id}}>
            @if(in_array($book->id, $favBooks))
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" id='favouriteIcon' viewBox="0 0 20 20" fill="red">
              @else
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" id='favouriteIcon' viewBox="0 0 20 20" fill="currentColor">
              @endif
                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
              </svg>
            </span>

            {{-- View --}}
            <a class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 viewBtn" href='/book/{{$book->id}}'>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
              </svg>            
            </a>

          </div>
        </div>
        @endforeach
        @else
        <p>No books have been found</p>
        @endif
      </div>
@include('partials.edit_book_modal')

@include('partials.footer')
