<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-4">
    <h3 align="center">Laporan Data Transaksi</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col" class="text-center">No</th>
                 <th scope="col" class="text-center">Status</th>
                <th scope="col" class="text-center">Nama User</th>
                  <th scope="col" class="text-center">Email User</th>
                  <th scope="col" class="text-center">Nama Kursus</th>
                  <th scope="col" class="text-center">Harga Kursus</th>
                </tr>
            </thead>
            <tbody>
                 @foreach ($data as $key => $value)
                <tr>
                  <td class="text-center">{{$loop->iteration}}</td>
                  <td class="text-center">
                    @if($value->status == 0)
                    <a class="btn btn-success btn-sm" href="{{ route('admin.transaction.approval', ['id' => $value->id, 'status' => 1]) }}">Approve</a>
                    <a class="btn btn-danger btn-sm" href="{{ route('admin.transaction.approval', ['id' => $value->id, 'status' => 2]) }}">Reject</a>
                    @elseif($value->status == 1)
                    <span class="text-success">Approved</span>
                    @else
                    <span class="text-danger">Rejected</span>
                    @endif
                  </td>
                  <td>{{ $value->user_name }}</td>
                  <td>{{ $value->user_email }}</td>
                  <td class="text-center">{{ $value->course_name }}</td>
                  <td class="text-right">Rp. {{ number_format($value->course_price, 2) }}</td>
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