<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data siswa - Penerimaan siswa Baru</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body style="background: lightgray">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('siswa.create') }}" class="btn btn-md btn-success mb-3">TAMBAH siswa</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">nisn</th>
                                    <th scope="col">Nama_siswa</th>
                                    <th scope="col">Tempat_lahir</th>
                                    <th scope="col">Tanggal_lahir</th>
                                    <th scope="col">Jenis_kelamin</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $siswa)
                                    <tr>
                                        <td>{{ $siswa->nisn }}</td>
                                        <td>{{ $siswa->Nama_siswa }}</td>
                                        <td>{{ $siswa->Tempat_lahir }}</td>
                                        <td>{{ $siswa->Tanggal_lahir }}</td>
                                        <td>{{ $siswa->Jenis_kelamin }}</td>
                                        <td>{{ $siswa->Kelas }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('siswa.destroy', $siswa->id) }}" method="post" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        // message with toastr
        @if (session()->has('success'))
            toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif (session()->has('error'))
            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif
    </script>
</body>

</html>
