@extends('layouts.app')

@section('title', 'Tambah Barang')
@section('meta_description', 'Form tambah barang / asset')
@section('meta_author', 'Admin')

@section('content')
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Tambah Barang / Asset</h4>
        </div>
        <div class="ms-auto mt-2 mt-sm-0">
            <a href="{{ route('asset.index') }}" class="btn btn-secondary">
                <i class="mdi mdi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <form action="{{ route('asset.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Kode Barang</label>
                        <input type="text" name="item_code" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Nomor Urut</label>
                        <input type="text" name="sort_number" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Nama/Jenis Barang</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Merk</label>
                        <input type="text" name="merk" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Nomor Mesin</label>
                        <input type="text" name="machine_number" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Bahan</label>
                        <input type="text" name="material" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Asal Perolehan</label>
                        <input type="text" name="acquisition_source" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Tahun Perolehan</label>
                        <input type="date" name="acquisition_year" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Satuan</label>
                        <input type="text" name="unit" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Kondisi</label>
                        <select name="condition" class="form-control" required>
                            <option value="Baik">Baik</option>
                            <option value="Rusak Ringan">Rusak Ringan</option>
                            <option value="Rusak Berat">Rusak Berat</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Jumlah (Qty)</label>
                        <input type="number" name="qty" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Harga</label>
                        <input type="number" name="price" class="form-control" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Spesifikasi</label>
                        <textarea name="specification" class="form-control"></textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Catatan</label>
                        <textarea name="notes" class="form-control"></textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="mdi mdi-content-save"></i> Simpan
                </button>
            </form>
        </div>
    </div>
@endsection
