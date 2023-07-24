@extends('layouts.app')

@section('content')
    <div class="container">
        @if (Session::has('message'))
            <div class="alert"><img class="success-alert" src="{{ Storage::url('assets/success.png') }}">
                <h3>{{ Session::get('message') }}</h3>
            </div>
        @endif
        <div class="main-form ms-3 mt-3 me-3">
            <h1>Update Article</h1>

            <form action="/updateArticle/{{ $article->id }}" enctype="multipart/form-data" method=POST>
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="titleInput" name="title" placeholder="Your article content">
                    <label for="title">Article Title</label>
                </div>
                <br>
                <div class="error-msg">
                    @error('title')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
                <hr>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="contentInput" name="content" placeholder="Your article content">
                    <label for="content">Article Content</label>
                </div>
                <br>
                <div class="error-msg">
                    @error('content')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
                <hr>
                <div class="form-floating mb-3">
                    <h4>Article image</h4>
                    <input type="file" name="image">
                </div>
                <br>
                <div class="error-msg">
                    @error('image')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
                <hr>
                <div class="form-floating mb-3">
                    <select class="form-select" name="category" id="category" name="category">
                        @foreach($category as $categories)
                        <option value="{{ $categories->name}}">{{ $categories->name }}</option>
                        @endforeach
                    </select>
                    <label for="content">Article Category</label>
                </div>
                <br>
                <div class="error-msg">
                    @error('category')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>
@endsection
