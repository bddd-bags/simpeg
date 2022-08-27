@extends('.layouts.main')
@section('content-body')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pegawai</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah</a></li>
        </ol>
    </div>
</div>
<!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px !important;">
                <div class="card-header" style="background-color: rgba(0,0,0,.03) !important">
                    <div class="d-flex justify-content-center align-items-center">
                        <h5 class="my-2 text-uppercase" style="color: #555555 !important">Tambah Data Pegawai</h5>
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" placeholder="Masukkan nama pegawai">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nik">NIK</label>
                                <input type="number" class="form-control" id="nik">
                            </div>
                            <div class="form-group col-md-6">
                              <label for="nidn">NIDN</label>
                              <input type="number" class="form-control" id="nidn">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="email">Email</label>
                              <input type="email" class="form-control" id="email">
                            </div>
                            <div class="form-group col-md-3">
                              <label for="jenkel">Jenis Kelamin</label>
                              <select id="jenkel" class="form-control">
                                <option selected>Laki-Laki</option>
                                <option>Perempuan</option>
                              </select>
                            </div>
                            <div class="form-group col-md-3">
                              <label for="no_telp">Nomor Telp</label>
                              <input type="number" class="form-control" id="no_telp">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir">
                            </div>
                            <div class="form-group col-md-4">
                              <label for="tanggal_lahir">Tanggal Lahir</label>
                              <input type="date" class="form-control" id="tanggal_lahir">
                            </div>
                            <div class="col-md-4">
                                <label for="customFile">Tambah Gambar</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                <div id="emailHelp" class="form-text"><i>format gambar jpg, jpeg, png | max:2MB</i></div>
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="alamat">Alamat</label>
                          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="px-0 px-md-4">
                            <div class="py-3 d-flex justify-content-end">
                                <a href="" class="btn btn-secondary" style="color: white !important">Kembali</a>
                                <button type="button" class="btn btn-success mx-2" style="color: white !important">Simpan</button>
                            </div>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #/ container -->
@endsection