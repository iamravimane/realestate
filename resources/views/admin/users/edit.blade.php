@extends('templates.main')

@section('content')
    <div class="container">
        <div class="card">
            <p class="login-card-description">Edit User</p>
            <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                @method('patch')
                @include('admin.users.partials.form')
            </form>
        </div>
    </div>
@endsection
