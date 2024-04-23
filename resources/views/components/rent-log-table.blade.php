<div>
    <div class="d-flex justify-content-end mt-5">
        <a href="{{ route('rent_logs.cetak') }}"  target="blank" class="btn btn-success me-2">Cetak</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Book</th>
                <th>ٌRent Date</th>
                <th>ٌReturn Date</th>
                <th>ٌActual Return Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentlog as $item)
            <tr
                class="{{ $item->actual_return_date == null ? '' : ($item->return_date < $item->actual_return_date ? 'text-bg-danger' : 'text-bg-success') }}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->user->username }}</td>
                <td>{{ $item->book->title }}</td>
                <td>{{ $item->tanggal_peminjaman }}</td>
                <td>{{ $item->tanggal_pengembalian }}</td>
                <td>{{ $item->tanggal_harus_dikembalikan }}</td>
                <td>{{ $item->status_peminjaman }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
