@extends('layouts.master')
@section('title', 'Halaman Kategori')

@section('content')
    <h1>Category List</h1>

    <div class="d-flex justify-content-start mt-5">
        <a href="{{ route('category.add') }}" class="btn btn-primary me-2">Add Data</a>
        <a href="{{ route('category.deleted') }}" class="btn btn-danger me-2">View Data Deleted</a>
        <a href="{{ route('category.cetak') }}"  target="blank" class="btn btn-success me-2">Cetak</a>
    </div>

    <div class="mt-5">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <div class="card-body mt-5 col-lg-7">

        <table class="table table-bordered">
            <thead class="table-light">
                <tr class="">
                    <th  width="5%">No.</th>
                    <th >Name</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->name }}</td>
                        <td>
                            <div class="d-flex ">
                                <a href="{{ route('category.edit', $data->slug) }}" class="btn btn-warning me-2">edit</a>
                                <form method="POST" action="{{ route('category.delete', $data->slug) }}">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" onclick="return confirm('apakah yakin mau dihapus?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
