
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body style="margin: 2rem">
    <div style="margin: 2rem" class="">Cetak data Buku</div>
    <div class="card-body ">

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
                @foreach ($rent as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->username }}</td>
                    <td>{{ $item->book->title }}</td>
                    <td>{{ $item->tanggal_peminjaman }}</td>
                    <td>{{ $item->tanggal_pengembalian }}</td>
                    <td>{{ $item->tanggal_harus_dikembalikan }}</td>
                    <td>{{ $item->status_peminjaman }}</td>
                        <td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>
