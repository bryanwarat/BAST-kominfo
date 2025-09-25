@extends('layouts.app')

@section('title', 'Dashboard - Barang')
@section('meta_description', 'Data dari tabel items')
@section('meta_author', 'Admin')

@section('content')
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Daftar Barang / Asset</h4>
        </div>
        <div class="ms-auto mt-2 mt-sm-0">
            <a href="{{ route('asset.import.form') }}" class="btn btn-success">
                <i class="mdi mdi-plus"></i> Import Data
            </a>
            <a href="{{ route('asset.create') }}" class="btn btn-primary">
                <i class="mdi mdi-plus"></i> Tambah Data
            </a>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <table id="itemsTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nomor Urut</th>
                        <th>Merk</th>
                        <th>Nomor Mesin</th>
                        <th>Bahan</th>
                        <th>Tahun Perolehan</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Kondisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- jQuery & DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Init DataTables
            $('#itemsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('asset.data') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'item_code',
                        name: 'item_code'
                    },
                    {
                        data: 'sort_number',
                        name: 'sort_number'
                    },
                    {
                        data: 'merk',
                        name: 'merk'
                    },
                    {
                        data: 'machine_number',
                        name: 'machine_number'
                    },
                    {
                        data: 'material',
                        name: 'material'
                    },
                    {
                        data: 'acquisition_year',
                        name: 'acquisition_year'
                    },
                    {
                        data: 'qty',
                        name: 'qty'
                    },
                    {
                        data: 'price',
                        name: 'price',

                    },
                    {
                        data: 'condition',
                        name: 'condition',
                        render: function(data) {
                            if (data === 'Baik') {
                                return '<span class="badge bg-success">Baik</span>';
                            } else if (data === 'Rusak Ringan') {
                                return '<span class="badge bg-warning text-dark">Rusak Ringan</span>';
                            } else {
                                return '<span class="badge bg-danger">Rusak Berat</span>';
                            }
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "›",
                        previous: "‹"
                    },
                }
            });

            // Konfirmasi hapus dengan SweetAlert
            $(document).on('submit', '.delete-form', function(e) {
                e.preventDefault();
                let form = this;

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

    {{-- SweetAlert Flash Message --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
            });
        </script>
    @endif
@endpush
