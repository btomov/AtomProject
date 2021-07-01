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
            {{-- assistme client_settings --}}

            
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 deleteBtn" data-id={{$book->id}}>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
              </svg>
            </span>

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
          </div>
        </div>
        @endforeach
        @else
        <p>No books have been found</p>
        @endif
      </div>
@include('partials.edit_book_modal')

@include('partials.footer')
