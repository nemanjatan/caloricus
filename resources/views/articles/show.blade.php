@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body" style="max-width:800px">
                        {{ $article->title }}

                        @if ( $article->featured_image )
                            <img src="{{ $imagePath }}" width="700">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
