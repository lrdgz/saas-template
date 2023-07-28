@extends('layouts.default')

@section('content')
    <div class="prose lg:prose-xl container">
        <h1 class="text-3xl text-center text-primary">{{ $page->title  }}</h1>
        {!! $page->content !!}
    </div>
@endsection
