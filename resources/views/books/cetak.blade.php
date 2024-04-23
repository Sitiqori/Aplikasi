@section('title', '')

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
                    <th>No.</th>
                    <th>Code</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Publication Year:</th>
                    <th>Status</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($datacetak as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->book_code }}</td>
                        <td>{{ $data->title }}</td>
                        <td>{{ $data->author }}</td>
                        <td>{{ $data->publisher }}</td>
                        <td>{{ $data->publication_year  }}</td>
                        <td>{{ $data->status }}</td>
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
