@include('partials.head')
@include('layouts.navigation')
<div class="max-w-4xl flex items-center h-auto lg:h-screen flex-wrap mx-auto my-32 lg:my-0 bookCard">
    @if($book)
	<!--Img Col-->
	<div class="w-full lg:w-2/5">
		<img src={{$book->coverImage}} class="rounded-none lg:rounded-lg shadow-2xl hidden lg:block cover">
	</div>
	<!--Main Col-->
	<div id="profile" class="w-full lg:w-3/5 rounded-lg lg:rounded-l-lg lg:rounded-r-none shadow-2xl bg-white opacity-75 mx-6 lg:mx-0">
	
		<input type="hidden" class='id' value={{$book->id}}>
		<input type="hidden" class='isbn' value={{$book->ISBN}}>
		<input type="hidden" class='year' value={{$book->year}}>
		<span class='hidden description-hidden'>{{$book->description}}</span>

		<div class="p-4 md:p-12 text-center lg:text-left">
			<!-- Image for mobile view-->
			<div class="block lg:hidden rounded-full shadow-xl mx-auto -mt-16 h-48 w-48 bg-cover bg-center" style="background-image: url({{$book->coverImage}})"></div>
			
			<h1 class="text-3xl font-bold pt-8 lg:pt-0 bookName">{{$book->name}}</h1>
			<div class="mx-auto lg:mx-0 w-4/5 pt-3 border-b-2 border-green-500 opacity-25"></div>
			<p class="pt-4 text-base font-bold flex items-center justify-center lg:justify-start">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
				</svg>
				ISBN: {{$book->ISBN}}</p>
			<p class="pt-2 text-gray-600 text-xs lg:text-sm flex items-center justify-center lg:justify-start">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
				</svg>
        		Written in {{$book->year}}</p>
			<p class="pt-8 text-sm description">{{$book->description}}</p>

			<div class="pt-12 pb-8">
				<button class="bg-green-700 hover:bg-green-900 text-white font-bold py-2 px-4 rounded-full showEditModal">
				  Edit
				</button> 
			</div>
			
			<!-- Use https://simpleicons.org/ to find the svg for your preferred product --> 

		</div>

	</div>
	@else
		<p>Book not found.</p>
	@endif

	
</div>
@include('partials.edit_book_modal')

@include('partials.footer')