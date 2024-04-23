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
    <div style="margin: 2rem" class="">Cetak data Categories</div>
    <div class="card-body ">

        <table class="table">
            <thead class="table-light">
                <tr class="">
                    <th  scope="col" >No.</th>
                    <th  scope="col">Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datacetak as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
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
