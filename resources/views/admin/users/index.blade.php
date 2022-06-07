@extends('templates.main')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="float-start">
                Users
            </h1>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary float-end" role="button">Create</a>
        </div>
    </div>


        <form action="{{ route('admin.users.search') }}" method="post" role="search"   class="row g-3 mb-2">
            @csrf
            <div class="col-auto">
            <input type="text" placeholder="Search.." name="search" class="form-control">
            </div>
            <div class="col-auto">
            <button type="submit" class="btn btn-primary">Search</button>
            </div>
            <div class="col-auto">
                Total:{{$users->total()}}
                Current page:{{$users->count()}}
            </div>
        </form>
    <div class="card">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#Id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Avatar</th>
                <th scope="col">action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td><img src="{{ $user->getFirstMediaUrl() }}" width="120px"></td>
                <td>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary" role="button">Edit</a>
                    <button type="button" class="btn btn-sm btn-danger"
                    onclick="event.preventDefault(); document.getElementById('delete-user-form-{{ $user->id }}').submit()"
                    > Delete </button>
                    <form id="delete-user-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="post" style="display: none">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

        {{ $users->links() }}
    </div>
@endsection
