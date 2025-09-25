@extends('layouts.app')

@section('title', 'Detail Barang')
@section('page-title', 'Detail Barang Inventaris')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-info-circle"></i> Informasi Detail Barang
                </h5>
                <div class="btn-group" role="group">
                    <a href="{{ route('inventories.edit', $inventory) }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <form action="{{ route('inventories.destroy', $inventory) }}" method="POST" class="d-inline" 
                          onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kode Barang:</label>
                            <p class="form-control-plaintext"><code class="fs-6">{{ $inventory->kode_barang }}</code></p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Barang:</label>
                            <p class="form-control-plaintext">{{ $inventory->nama_barang }}</p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kategori:</label>
                            <p class="form-control-plaintext">
                                <span class="badge bg-secondary fs-6">{{ $inventory->kategori }}</span>
                            </p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Jumlah:</label>
                            <p class="form-control-plaintext">{{ number_format($inventory->jumlah) }} {{ $inventory->satuan }}</p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Harga:</label>
                            <p class="form-control-plaintext">
                                @if($inventory->harga)
                                    <span class="text-success fw-bold">Rp {{ number_format($inventory->harga, 0, ',', '.') }}</span>
                                    <br><small class="text-muted">Total: Rp {{ number_format($inventory->harga * $inventory->jumlah, 0, ',', '.') }}</small>
                                @else
                                    <span class="text-muted">Tidak ada data harga</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Lokasi:</label>
                            <p class="form-control-plaintext">
                                <i class="bi bi-geo-alt text-primary"></i> {{ $inventory->lokasi }}
                            </p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kondisi:</label>
                            <p class="form-control-plaintext">
                                @php
                                    $badgeClass = match($inventory->kondisi) {
                                        'Baik' => 'bg-success',
                                        'Rusak' => 'bg-danger',
                                        'Perlu Perbaikan' => 'bg-warning text-dark',
                                        default => 'bg-secondary'
                                    };
                                    $icon = match($inventory->kondisi) {
                                        'Baik' => 'bi-check-circle',
                                        'Rusak' => 'bi-x-circle',
                                        'Perlu Perbaikan' => 'bi-exclamation-triangle',
                                        default => 'bi-question-circle'
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }} fs-6">
                                    <i class="{{ $icon }}"></i> {{ $inventory->kondisi }}
                                </span>
                            </p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal Masuk:</label>
                            <p class="form-control-plaintext">
                                <i class="bi bi-calendar-date text-primary"></i> 
                                {{ $inventory->tanggal_masuk->translatedFormat('d F Y') }}
                                <br><small class="text-muted">{{ $inventory->tanggal_masuk->diffForHumans() }}</small>
                            </p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Terakhir Diubah:</label>
                            <p class="form-control-plaintext">
                                <i class="bi bi-clock text-primary"></i> 
                                {{ $inventory->updated_at->translatedFormat('d F Y, H:i') }}
                                <br><small class="text-muted">{{ $inventory->updated_at->diffForHumans() }}</small>
                            </p>
                        </div>
                    </div>
                </div>
                
                @if($inventory->deskripsi)
                <div class="row">
                    <div class="col-12">
                        <hr>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi:</label>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <p class="card-text mb-0">{{ $inventory->deskripsi }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                <hr>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('inventories.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection