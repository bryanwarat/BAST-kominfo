@extends('layouts.app')

@section('title', 'Dashboard - Employees')
@section('meta_description', 'Data dari tabel employees')
@section('meta_author', 'Admin')

@section('content')
    <div class="py-3 d-flex align-items-center justify-content-between">
        <h4 class="fs-18 fw-semibold m-0">Daftar Pegawai</h4>
        <div class="ms-auto">
            <a href="{{ route('employee.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Data
            </a>
        </div>
    </div>

    <!-- Tampilkan flash message sukses/error di sini jika perlu -->
    @if (session('success') || session('error'))
        <!-- SweetAlert2 akan menangani tampilan pesan ini, tapi disarankan tetap ada div untuk fallbacks -->
    @endif

    <div class="card mt-3 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table id="employeesTable" class="table table-bordered table-striped table-hover w-100">
                    <thead class="bg-light">
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>SKPD</th>
                            <th>Jabatan</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data akan diisi oleh DataTables -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Pastikan Anda sudah memuat CSS DataTables/Bootstrap di layout utama -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables
            let table = $('#employeesTable').DataTable({
                processing: true,
                serverSide: true,
                // Menggunakan route yang sudah Anda definisikan di controller sebelumnya
                ajax: "{{ route('employee.data') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nip',
                        name: 'nip'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'skpd',
                        name: 'skpd'
                    },
                    {
                        // Mengganti 'instansi' menjadi 'position'
                        data: 'position',
                        name: 'position'
                    },
                    {
                        data: 'email',
                        name: 'email',
                        // Tampilkan tanda strip jika email kosong
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                        // Tampilkan tanda strip jika telepon kosong
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center text-nowrap' // Membuat kolom aksi tidak pecah
                    }
                ],
                language: {
                    // Penyesuaian bahasa Indonesia
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        first: "<i class='fas fa-angle-double-left'></i>",
                        last: "<i class='fas fa-angle-double-right'></i>",
                        next: "<i class='fas fa-angle-right'></i>",
                        previous: "<i class='fas fa-angle-left'></i>"
                    },
                    zeroRecords: "Tidak ada data yang ditemukan",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(disaring dari _MAX_ total data)",
                    processing: "Memproses..."
                },
                responsive: true
            });

            // Tampilkan flash message dari session menggunakan SweetAlert2
            const successMessage = "{{ session('success') }}";
            const errorMessage = "{{ session('error') }}";

            if (successMessage) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: successMessage,
                    timer: 2000,
                    showConfirmButton: false
                });
            }

            if (errorMessage) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: errorMessage,
                });
            }
        });

        // Fungsi hapus global dengan SweetAlert2
        function deleteEmployee(id) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: "Apakah Anda yakin ingin menghapus data pegawai ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endpush
