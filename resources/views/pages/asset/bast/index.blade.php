@extends('layouts.app')

@section('title', 'Tambah BAST')
@section('content')
    <div class="container">
        <h4 class="mb-3">Tambah BAST untuk Asset</h4>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('asset.bast.store', $asset->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Asset</label>
                        <input type="text" class="form-control" value="{{ $asset->item_code }} - {{ $asset->merk }}"
                            disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pilih Pegawai</label>
                        <select name="employee_id" class="form-select" required>
                            <option value="">-- Pilih Pegawai --</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor BAST</label>
                        <input type="text" name="bast_number" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal BAST</label>
                        <input type="date" name="bast_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="0">Draft</option>
                            <option value="1">Final</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Dokumen (PDF/DOC)</label>
                        <input type="file" name="document" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto (JPG/PNG)</label>
                        <input type="file" name="photo" class="form-control">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('asset.show', $asset->id) }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
