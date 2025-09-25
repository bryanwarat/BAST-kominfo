@extends('layouts.app')

@section('title', 'Detail BAST')

@section('content')
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Detail BAST</h4>
        </div>
        <div class="ms-auto">
            <a href="{{ route('bast.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Tanggal</th>
                    <td>{{ \Carbon\Carbon::parse($bast->bast_date)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <th>Nomor</th>
                    <td>{{ $bast->bast_number }}</td>
                </tr>
                <tr>
                    <th>Merk Barang</th>
                    <td>{{ $bast->merk }} ({{ $bast->item_code }})</td>
                </tr>
                <tr>
                    <th>Pegawai</th>
                    <td>{{ $bast->employee_name }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        @if ($bast->status == 1)
                            <span class="badge bg-success">Final</span>
                        @else
                            <span class="badge bg-secondary">Draft</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Dokumen</th>
                    <td>
                        @if ($bast->document)
                            <a href="{{ asset('storage/' . $bast->document) }}" target="_blank"
                                class="btn btn-sm btn-info">Lihat Dokumen</a>
                        @else
                            <span class="text-muted">Tidak ada</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Foto</th>
                    <td>
                        @if ($bast->photo)
                            <img src="{{ asset('storage/' . $bast->photo) }}" class="img-thumbnail" width="120">
                        @else
                            <span class="text-muted">Tidak ada</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
