@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                <div class="card">
                    <div class="card-header">{{ __('Users') }}</div>


                    <ul class="card-body">
                        @foreach ($users as $user)
                            <li>
                                {{ $user }}
                                <ol>
                                    @foreach ($user->getAttributes() as $key => $value)
                                        <li>{{ $key }} | {{ $value }} </li>
                                    @endforeach
                                </ol>

                                <span> {{ $user['mail'] }}</span>
                                <p>{{ $user['role']['name'] }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <x-data-table {{-- :table-data="$users"  --}} :filling="$users" :mail="$users[0]['mail']" />
            </div>

        </div>
    @endsection
