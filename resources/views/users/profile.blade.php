@extends('layouts.master')
@section('title', 'Profile')

@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<div class="mt-5">
    <h4>Your Rent Log</h4>

    <div>
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
                @foreach ($rentlogs as $item)
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
                            <button type="submit" class="btn btn-primary">Return</button>
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

<!-- Modal -->
@foreach ($rentlogs as $item)
<div class="modal fade" id="reviewModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">Review Book: {{ $item->book->title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Review Form -->
                <form action="{{ route('books.review') }}" method="POST">
                    @csrf
                    <input type="hidden" name="rent_log_id" value="{{ $item->id }}">
                    <div class="form-group">
                        <label for="rating">Rating:</label>
                        <select name="rating" id="rating" class="form-control">
                            <option value="1">&#9733;</option> <!-- Bintang penuh -->
                            <option value="2">&#9733;&#9733;</option> <!-- Dua bintang penuh -->
                            <option value="3">&#9733;&#9733;&#9733;</option> <!-- Tiga bintang penuh -->
                            <option value="4">&#9733;&#9733;&#9733;&#9733;</option> <!-- Empat bintang penuh -->
                            <option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option> <!-- Lima bintang penuh -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="review">Review:</label>
                        <textarea name="review" id="review" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach









<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
