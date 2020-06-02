@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Chats</div>

                    <div class="card-body">
                        <ul class="list-group">
                            @if(count($users) > 0)
                                @foreach($users as $user)
                                    <li class="list-group-item">
                                        <a href="{{ route('chat.show', ['user' => $user]) }}">{{ $user->name }}
                                    </li>
                                @endforeach
                            @else
                                <p class="justify-center">No chats</p>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
