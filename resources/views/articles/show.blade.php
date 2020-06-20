@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h1>{{ $article->title }}</h1>
                        <p>Date published: {{ date("d M Y", strtotime( $article->updated_at )) }}</p>

                        @if ( $article->featured_image )
                            <img src="{{ $imagePath }}" width="400">
                        @endif

                        {!! $article->body !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
