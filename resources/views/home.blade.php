@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (auth()->user()->hasRole('super admin'))
                        You are logged in as Super Admin!
                    @else
                        {{ __('You are logged in!') }}
                    @endif

                    <ul>
                        @can('create posts')
                            <li><a href="">Create Posts</a></li>
                        @endcan
                        @can('edit posts')
                            <li><a href="">Edit Posts</a></li>
                        @endcan
                        @can('delete posts')
                            <li><a href="">Delete Posts</a></li>
                        @endcan
                    </ul>

                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
