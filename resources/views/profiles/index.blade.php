@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h>Profiles</h>
            @foreach($profiles as $profile)
                <div class="col-md-12">
                    <a href="{{ route('profile.show', ['profile' => $profile]) }}">{{ $profile->user->name }}</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
