@extends('layouts.app')

@section('title', 'Tambah BAST')

@push('styles')
    <!-- Select2 CSS -->
@endpush

@section('content')
    <div class="container">

        <!-- Header Page -->
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Tambah BAST</h4>
            </div>

            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="{{ route('asset.index') }}">Asset</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('asset.detail', $asset->id) }}">Detail Asset</a></li>
                    <li class="breadcrumb-item active">Tambah BAST</li>
                </ol>
            </div>
        </div>

        <!-- Form Create BAST -->
        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Form Tambah BAST</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('asset.bast.store', $asset->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <!-- Pegawai -->
                            <div class="mb-3">
                                <label for="employee_id" class="form-label">Pegawai</label>
                                <select id="employee_id" name="employee_id" class="form-control" required>
                                    <option value="">-- Pilih Pegawai --</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Nomor BAST -->
                            <div class="mb-3">
                                <label for="bast_number" class="form-label">Nomor BAST</label>
                                <input type="text" class="form-control" id="bast_number" name="bast_number" required>
                            </div>

                            <!-- Tanggal BAST -->
                            <div class="mb-3">
                                <label for="bast_date" class="form-label">Tanggal BAST</label>
                                <input type="date" class="form-control" id="bast_date" name="bast_date" required>
                            </div>

                            <!-- Status -->
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="1">Aktif</option>
                                    <option value="2">Tidak Aktif</option>
                                </select>
                            </div>

                            <!-- Upload Document -->
                            <div class="mb-3">
                                <label for="document" class="form-label">Upload Dokumen (PDF/DOC)</label>
                                <input type="file" class="form-control" id="document" name="document">
                            </div>

                            <!-- Upload Photo -->
                            <div class="mb-3">
                                <label for="photo" class="form-label">Upload Foto</label>
                                <input type="file" class="form-control" id="photo" name="photo">
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('asset.detail', $asset->id) }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- jQuery (wajib sebelum select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#employee_id').select2({
                placeholder: "-- Pilih Pegawai --",
                allowClear: true,
                width: '100%' // penting biar full
            });
        });
    </script>
@endpush
