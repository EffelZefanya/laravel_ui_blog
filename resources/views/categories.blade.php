@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="text-center">
            <h1>Categories</h1>
        </div>
        <div class="row justify-content-center">
            @foreach ($categories as $category)
            <div class="col-sm card">
                <h4 class="card-title p-3">{{ $category->name }}</h4>
                <div class="card-body">
                    <h6 class="card-subtitle">{{"by " . $category->user->name }}</h6>
                    <br>
                    <form action="/deleteCategory/{{$category->id}}" method="POST">
                        {{method_field('DELETE')}}
                        @csrf
                        <input type="submit" value="Delete">
                    </form>
                    {{-- <form action="/updateArticlePage/{{ $article->id }}" method="GET">
                        @csrf
                        <input class="btnact" type="submit" value="Update">
                    </form> --}}
                </div>
            </div>
            <div style="height:50px">

            </div>
            @endforeach
        </div>
    </div>
@endsection
