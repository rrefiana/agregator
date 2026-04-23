@extends('layouts.app')

@php
use Illuminate\Support\Str;
@endphp

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-lg-8">
            <h2 class="fw-bold mb-1">Daftar Berita</h2>
            <p class="text-muted mb-0">
                Data berita diambil dari website SMKN 1 Bawang dan disimpan ke database lokal.
            </p>
        </div>
        <div class="col-lg-4 mt-3 mt-lg-0">
            <div class="d-flex gap-2 justify-content-lg-end">
                <a href="{{ route('berita.sync') }}" class="btn btn-success">
                    Sinkronisasi Berita
                </a>

                <form action="{{ route('berita.truncate') }}"
                    method="POST" onsubmit="return confirm('Yakin ingin menghapus semua berita?')">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        Hapus Semua Berita
                    </button>
                </form>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('berita.index') }}" method="GET">
                <div class="row g-2">
                    <div class="col-md-10">
                        <input
                            type="text"
                            name="keyword"
                            class="form-control"
                            placeholder="Cari judul, deskripsi, atau kategori..."
                            value="{{ $keyword ?? '' }}"
                        >
                    </div>
                    <div class="col-md-2 d-grid">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @forelse($beritas as $berita)
        <div class="card card-berita border-0 shadow-sm mb-3">
            <div class="card-body">
                <h4 class="fw-bold mb-2">{{ $berita->judul }}</h4>
                <div class="mb-2 text-muted small">
                    <span class="me-3">{{ $berita->author ?? 'Penulis tidak diketahui' }}</span>
                    <span>{{ $berita->tanggal_publish?->format('d M Y H:i') ?? 'Belum dipublish' }}</span>
                </div>
                <p>{{ Str::limit($berita->deskripsi, 200, '...') }}</p>
                <a href="{{ $berita->link }}" target="_blank" class="btn btn-sm btn-outline-primary">
                    Baca Selengkapnya
                </a>
            </div>
        </div>
    @empty
        <div class="alert alert-warning shadow-sm">
            Belum ada berita yang tersedia.
        </div>
    @endforelse
</div>
@endsection