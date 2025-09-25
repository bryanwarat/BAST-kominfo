@extends('layouts.app')

@section('title', 'Detail Pegawai')

@section('content')
    <div class="container">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Detail Pegawai</h4>
            </div>
            <div class="text-end">
                <a href="{{ route('employee.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>NIP</th>
                            <td>{{ $employee->nip }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $employee->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $employee->email }}</td>
                        </tr>
                        <tr>
                            <th>Telepon</th>
                            <td>{{ $employee->phone }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
