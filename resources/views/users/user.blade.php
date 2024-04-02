@extends('layouts.master')
@section('title', 'Halaman User')

@section('content')
    <h1>User List</h1>

    <div class="mt-5 justify-content-end">
        <a href="{{ route('users.banned') }}" class="btn btn-danger">View Banned Users</a>
        <a href="{{ route('users.registered') }}" class="btn btn-primary">Registered Users</a>
    </div>

    <div class="mt-5">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <div class="mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th width="5%">No.</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->username }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ ($data->email == true ? $data->email : '-') }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="/users/user-detail/{{ $data->slug }}" class="btn btn-warning me-2">Detail</a>
                                <form method="POST" action="{{ route('users.delete', $data->slug) }}">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" onclick="return confirm('apakah yakin mau dihapus?')">Banned User</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection