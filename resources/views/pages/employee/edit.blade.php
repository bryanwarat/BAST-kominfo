@extends('layouts.app')

@section('title', 'Edit Pegawai')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center py-3">
            <h4 class="fs-18 fw-semibold m-0">Edit Pegawai</h4>
            <a href="{{ route('employee.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <form action="{{ route('employee.update', $employee->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nip" class="form-label">NIP <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip"
                            name="nip" value="{{ old('nip', $employee->nip) }}" required>
                        @error('nip')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $employee->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="skpd" class="form-label">SKPD (Dinas)</label>
                        <input type="text" class="form-control @error('skpd') is-invalid @enderror" id="skpd"
                            name="skpd" value="{{ old('skpd', $employee->skpd) }}">
                        @error('skpd')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="position" class="form-label">Jabatan</label>
                        <input type="text" class="form-control @error('position') is-invalid @enderror" id="position"
                            name="position" value="{{ old('position', $employee->position) }}">
                        @error('position')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email', $employee->email) }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Telepon</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                            name="phone" value="{{ old('phone', $employee->phone) }}">
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
