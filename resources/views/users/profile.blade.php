

@extends('layouts.master')
@section('title', 'Profile')

@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<div class="mt-2">
    <h4 style="margin-bottom: 3rem">Your Rent Log</h4>


    <div style="margin-bottom: 4rem">
        <h5>Unreturned Books</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Book</th>
                    <th>ٌRent Date</th>
                    <th>ٌReturn Date</th>
                    <th>ٌActual Return Date</th>
                    <th>Riview</th>
                    <th>ٌAction</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($unreturnedRentLogs as $item)
                        <tr
                    class="{{ $item->actual_return_date == null ? '' : ($item->return_date < $item->actual_return_date ? 'text-bg-danger' : 'text-bg-success') }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->book->title }}</td>
                    <td>{{ $item->tanggal_peminjaman }}</td>
                    <td>{{ $item->tanggal_pengembalian  }}</td>
                    <td>{{ $item->tanggal_harus_dikembalikan }}</td>
                    <td>
                        @if($item->status_peminjaman == 'dipinjam' || $item->status_peminjaman == 'dikembalikan')
                            @if($item->ulasanBuku && $item->ulasanBuku->user_id == auth()->user()->id)
                                Review Submitted
                            @else
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reviewModal{{ $item->id }}">
                                    Review
                                </button>
                            @endif
                        @endif

                    </td>
                    <td>
                        @if($item->status_peminjaman == 'dipinjam')
                        <form action="{{ route('books.kembali', ['id' => $item->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Return</button>
                        </form>
                        @else
                        Book Returned
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>




    <div>
        <h5 class="mt-2">Returned Books</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Book</th>
                    <th>ٌRent Date</th>
                    <th>ٌReturn Date</th>
                    <th>ٌActual Return Date</th>
                    <th>Riview</th>
                    <th>ٌAction</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($returnedRentLogs as $item)
                <tr
                class="{{ $item->actual_return_date == null ? '' : ($item->return_date < $item->actual_return_date ? 'text-bg-danger' : 'text-bg-success') }}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->book->title }}</td>
                <td>{{ $item->tanggal_peminjaman }}</td>
                <td>{{ $item->tanggal_pengembalian  }}</td>
                <td>{{ $item->tanggal_harus_dikembalikan }}</td>
                <td>
                    @if($item->status_peminjaman == 'dipinjam' || $item->status_peminjaman == 'dikembalikan')
                        @if($item->ulasanBuku && $item->ulasanBuku->user_id == auth()->user()->id)
                            Review Submitted
                        @else
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reviewModal{{ $item->id }}">
                                Review
                            </button>
                        @endif
                    @endif

                </td>
                <td>
                    @if($item->status_peminjaman == 'dipinjam')
                    <form action="{{ route('books.kembali', ['id' => $item->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Return</button>
                    </form>
                    @else
                    Book Returned
                    @endif
                </td>
            </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection


