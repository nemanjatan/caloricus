@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        {{ $article->title }}

                        @if ( $article->featured_image )
                            <img src="{{ $imagePath }}" width="400">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
