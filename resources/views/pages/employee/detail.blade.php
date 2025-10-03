@extends('layouts.app')

@section('title', 'Detail Pegawai')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center py-3">
            <h4 class="fs-18 fw-semibold m-0">Detail Pegawai</h4>
            <div class="d-flex gap-2">
                <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
                <a href="{{ route('employee.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <tbody>
                            <tr>
                                <th class="w-25">NIP</th>
                                <td>{{ $employee->nip }}</td>
                            </tr>
                            <tr>
                                <th class="w-25">Nama</th>
                                <td>{{ $employee->name }}</td>
                            </tr>
                            <tr>
                                <th class="w-25">SKPD</th>
                                <td>{{ $employee->skpd ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="w-25">Jabatan</th>
                                <td>{{ $employee->position ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="w-25">Email</th>
                                <td>{{ $employee->email ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="w-25">Telepon</th>
                                <td>{{ $employee->phone ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="w-25">Dibuat Pada</th>
                                <td>{{ $employee->created_at->format('d M Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th class="w-25">Diperbarui Pada</th>
                                <td>{{ $employee->updated_at->format('d M Y H:i') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
