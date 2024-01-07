<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Data Siswa </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body style="background: lightgray">
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('siswa.update', $data->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="font-weight-bold">nisn</label>
                                <input type="varchar2" class="form-control @error('nisn') is-invalid @enderror"
                                    name="nisn" placeholder="nisn" value="{{ $data->nisn }}">

                                <!-- error message untuk jenis_cabor -->
                                @error('nisn')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Nama_siswa</label>
                                <input type="text" class="form-control @error('Nama_siswa') is-invalid @enderror"
                                    name="Nama_siswa" placeholder="Nama_siswa" value="{{ $data->Nama_siswa }}">

                                <!-- error message untuk jenis_cabor -->
                                @error('Nama_siswa')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Tempat_lahir</label>
                                <input type="text" class="form-control @error('Tempat_lahir') is-invalid @enderror"
                                    name="Tempat_lahir" placeholder="Tempat_lahir" value="{{ $data->Tempat_lahir }}">

                                <!-- error message untuk jenis_cabor -->
                                @error('Tempat_lahir')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal_lahir</label>
                                <input type="datetime-local" class="form-control @error('Tanggal_lahir') is-invalid @enderror"
                                    name="Tanggal_lahir" placeholder="Tanggal_lahir" value="{{ $data->Tanggal_lahir }}">

                                <!-- error message untuk tanggal_lahir -->
                                @error('Tanggal_lahir')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Jenis_kelamin</label>
                                <input type="text" class="form-control @error('Jenis_kelamin') is-invalid @enderror"
                                    name="Jenis_kelamin" placeholder="Jenis_kelamin" value="{{ $data->Jenis_kelamin }}">

                                <!-- error message untuk jenis_cabor -->
                                @error('Jenis_kelamin')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Kelas</label>
                                <input type="text" class="form-control @error('Kelas') is-invalid @enderror"
                                    name="Kelas" placeholder="Kelas" value="{{ $data->Kelas }}">

                                <!-- error message untuk jenis_cabor -->
                                @error('Kelas')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
</body>

</html>
