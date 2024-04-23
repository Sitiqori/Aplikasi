@extends('layouts.master')
@section('title', 'Halaman Book')

@section('content')

 <h1 >Book List</h1>

 <div class="mt-5 d-flex justify-content-end">
    <a href="{{ route('books.deleted') }}" class="btn btn-danger  me-2">View Deleted Data</a>
    <a href="{{ route('books.add') }}" class="btn btn-primary  me-2">Add Data</a>
    <a href="{{ route('books.cetak') }}"  target="blank" class="btn btn-success me-2">Cetak</a>

 </div>

 <div class="mt-5">
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
</div>

<div class="my-5 card-body">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Code</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->book_code }}</td>
                    <td>{{ $data->title }}</td>
                    <td>
                        @foreach ($data->categories as $item)
                            {{ $item->name }} <br>
                        @endforeach
                    </td>
                    <td>{{ $data->status }}</td>
                    <td>
                        <div class="d-flex">
                            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#detailModal{{ $data->id }}">
                                Detail
                            </button>
                            <form method="POST" action="{{ route('books.delete', $data->slug) }}">
                                <a href="{{ route('books.edit', $data->slug) }}" class="btn btn-warning me-2">edit</a>
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" onclick="return confirm('apakah yakin mau dihapus?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="detailModal{{ $data->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $data->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailModalLabel{{ $data->id }}">{{ $data->title }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="{{ asset('path/to/book/cover.jpg') }}" class="img-fluid" alt="Book Cover">
                                        </div>
                                        <div class="col-md-8">
                                            <p><strong>Book Code:</strong> {{ $data->book_code }}</p>
                                            <p><strong>Title:</strong> {{ $data->title }}</p>
                                            <p><strong>Author:</strong> {{ $data->author }}</p>
                                            <p><strong>Publisher:</strong> {{ $data->publisher }}</p>
                                            <p><strong>Publication Year:</strong> {{ $data->publication_year }}</p>
                                            <p><strong>Sinopsis:</strong> {{ $data->sinopsis }}</p>
                                            <p><strong>Status:</strong> {{ $data->status }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>


<script>
    function pinjamBuku(bookId) {
        // Kirim request AJAX untuk melakukan peminjaman buku
        $.ajax({
            url: '{{ route("books.pinjam") }}',
            type: 'POST',
            data: {
                book_id: bookId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Tambahkan kode di sini untuk menangani respons dari server
                alert('Buku berhasil dipinjam');
            },
            error: function(xhr, status, error) {
                // Tambahkan kode di sini untuk menangani kesalahan
                console.error(error);
            }
        });
    }
</script>
@endsection
