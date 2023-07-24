@extends('layouts.app')

@section('content')
    <div class="container">
        @if (Session::has('message'))
            <div class="alert"><img class="success-alert" src="{{ Storage::url('assets/success.png') }}">
                <h3>{{ Session::get('message') }}</h3>
            </div>
        @endif
        <div class="main-form ms-3 mt-3 me-3">
            <h1>Update Category</h1>
            <form action="/updateCategory/{{ $category->id}}" enctype="multipart/form-data" method=POST>
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nameInput" name="name" placeholder="Your category name">
                    <label for="name">Category Name</label>
                </div>
                <br>
                <div class="error-msg">
                    @error('name')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
                <hr>
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>
@endsection
