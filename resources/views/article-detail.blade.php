@extends('layouts.app')

@section('content')
    <div class=text-center>
        <h1 class="text-center">{{ $article->title }}</h1>
        <p>by {{ $article->user->name }} </p>
        <p>category: {{ $article->category->name }}</p>
    </div>
    <div class="text-center">
        <img src="{{ Storage::url('images/' . $article->image)}}" alt="Article Image">
    </div>
    <div>
        {{ $article->content }}
    </div>
@endsection
