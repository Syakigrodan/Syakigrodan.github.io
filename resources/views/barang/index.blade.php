@extends('template.main')

@section('konten')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Mall Shop</h1>
        <p class="mb-4">Manajemen Barang dan Jasa</p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">CRUD Laravel
                    <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#tambahData">Tambah
                        Data</button>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Jenis Barang</th>
                                <th>Harga Barang</th>
                                <th>Jumlah Barang</th>
                                <th>Total Biaya</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($barang as $row)
                                <tr>
                                    <td width="5%">{{ $no++ }}</td>
                                    <td>{{ $row->nama_barang }}</td>
                                    <td>
                                        <span
                                            class="badge badge-{{ $row->jenis_barang == 'jasa' ? 'primary' : 'danger' }} p-1">
                                            {{ $row->jenis_barang }}
                                        </span>
                                    </td>
                                    <td>{{ $row->harga_barang }}</td>
                                    <td>{{ $row->jumlah_barang }}</td>
                                    <td>
                                        @php
                                            $totalBiaya = $row->total_biaya;
                                            $diskon = 0;
                                            if ($row->jenis_barang == 'barang' && $totalBiaya > 100) {
                                                $diskon = $totalBiaya * 0.05;
                                            } elseif ($row->jenis_barang == 'jasa' && $totalBiaya > 50) {
                                                $diskon = $totalBiaya * 0.03;
                                            }
                                            $totalBiaya -= $diskon;
                                        @endphp
                                        {{ $totalBiaya }}
                                    </td>
                                    <td>Edit | Hapus</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahData" tabindex="-1" role="dialog" arialabelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-dialog-centered modaldialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('barang/save') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" class="form-control" id="nama_barang" aria-describedby="nama_barang"
                                name="nama_barang">
                        </div>
                        <div class="form-group">
                            <label for="jenis_barang">Jenis Barang</label>
                            <select name="jenis_barang" id="jenis_barang" class="form-control">
                                <option value="" selected>Pilih</option>
                                <option value="jasa">Jasa</option>
                                <option value="barang">Barang</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="harga_barang">Harga Barang</label>
                            <input type="number" class="form-control" id="harga_barang" name="harga_barang">
                        </div>
                        <div class="form-group">
                            <label for="jumlah_barang">Jumlah Barang</label>
                            <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang">
                        </div>
                        <div class="form-group">
                            <label for="total_biaya">Total Biaya</label>
                            <input type="number" class="form-control" id="total_biaya" name="total_biaya">
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-primary" value="Simpan" name="simpan">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        @if ($message = Session::get('dataTambah'))
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: 'Data Barang Berhasil Ditambahkan'
            })
        @endif
    </script>
@endsection
