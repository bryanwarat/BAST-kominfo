@extends('layouts.app')

@section('title', 'Import Data Asset')
@section('meta_description', 'Import data asset dari file Excel')
@section('meta_author', 'Admin')

@section('content')
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Import Data Asset</h4>
        </div>
        <div class="ms-auto mt-2 mt-sm-0">
            <a href="{{ route('asset.index') }}" class="btn btn-secondary">
                <i class="mdi mdi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-3">
                {{-- <a href="{{ route('asset.template') }}" class="btn btn-success"> --}}
                <a href="" class="btn btn-success">
                    <i class="mdi mdi-download"></i> Download Template
                </a>
            </div>
            <hr>

            <form action="{{ route('asset.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="file" class="form-label">Pilih File</label>
                    <input type="file" name="file" id="file" class="form-control" required>
                    <small class="text-muted">Format yang didukung: .xlsx, .xls, .csv</small>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="mdi mdi-upload"></i> Import
                </button>
            </form>
        </div>
    </div>

@endsection
