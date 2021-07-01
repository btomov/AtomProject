@include('partials.head')
@include('layouts.navigation')


@foreach($books as $book)
    <p>{{$book->name}}
@endforeach

@include('partials.footer')
