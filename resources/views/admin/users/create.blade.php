@extends('templates.main')

@section('content')
    <div class="container">
        <div class="card">
             <p class="login-card-description">Create New User</p>
                        <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
                            @csrf
                            @include('admin.users.partials.form' , ['create' => true])
                        </form>
                    </div>
    </div>
@endsection
