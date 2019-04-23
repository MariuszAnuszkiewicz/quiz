@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Access Page</div>
                <div class="card-body">
                  @guest
                    Hello, do you want to register?
                  @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
