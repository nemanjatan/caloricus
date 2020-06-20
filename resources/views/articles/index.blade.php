@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @forelse ($articles as $article)
                            <a href="/articles/{{ $article->slug }}">{{ $article->title }}</a>
                            <hr/>
                        @empty
                            <p>No articles yet!</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
