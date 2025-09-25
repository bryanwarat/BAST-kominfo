@extends('layouts.app')

@section('title', 'Detail Asset')

@section('content')
    <!-- Header & Breadcrumb -->
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Detail Asset & Riwayat BAST</h4>
        </div>
        <div class="text-end">
            <ol class="breadcrumb m-0 py-0">
                <li class="breadcrumb-item"><a href="{{ route('asset.index') }}">Asset</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <!-- Kolom Kiri: Detail Asset -->
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Detail Asset</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <th>Kode Barang</th>
                                    <td>{{ $asset->item_code }}</td>
                                </tr>
                                <tr>
                                    <th>Nomor Urut</th>
                                    <td>{{ $asset->sort_number }}</td>
                                </tr>
                                <tr>
                                    <th>Merk</th>
                                    <td>{{ $asset->merk }}</td>
                                </tr>
                                <tr>
                                    <th>Nomor Mesin</th>
                                    <td>{{ $asset->machine_number }}</td>
                                </tr>
                                <tr>
                                    <th>Bahan</th>
                                    <td>{{ $asset->material }}</td>
                                </tr>
                                <tr>
                                    <th>Tahun Perolehan</th>
                                    <td>{{ $asset->acquisition_year }}</td>
                                </tr>
                                <tr>
                                    <th>Sumber Perolehan</th>
                                    <td>{{ $asset->acquisition_source }}</td>
                                </tr>
                                <tr>
                                    <th>Kondisi</th>
                                    <td>{{ $asset->condition }}</td>
                                </tr>
                                <tr>
                                    <th>Qty</th>
                                    <td>{{ $asset->qty }}</td>
                                </tr>
                                <tr>
                                    <th>Harga</th>
                                    <td>Rp {{ number_format($asset->price, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <td>{{ $asset->notes }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Riwayat BAST -->
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Riwayat BAST</h5>
                    <a href="{{ route('asset.bast.create', $asset->id) }}" class="btn btn-primary btn-sm">
                        <i class="mdi mdi-plus"></i> Tambah BAST
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0 table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Pegawai</th>
                                    <th>Nomor</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bast as $index => $row)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $row->employee_name ?? '-' }}</td>
                                        <td>{{ $row->bast_number }}</td>
                                        <td>{{ \Carbon\Carbon::parse($row->bast_date)->format('d-m-Y') }}</td>
                                        <td>
                                            @if ($row->status == 1)
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-secondary">Tidak Aktif</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('asset.bast.detail', [$asset->id, $row->id]) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="mdi mdi-eye"></i> Detail
                                            </a>

                                            <form action="" method="POST" class="d-inline"
                                                onsubmit="return confirm('Yakin ingin menghapus BAST ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="mdi mdi-delete"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">Data kosong</td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
