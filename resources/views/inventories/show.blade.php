@extends('layouts.app')

@section('title', 'Detail Barang')
@section('page-title', 'Detail Barang Inventaris')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-indigo-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd"/>
                    </svg>
                    <h2 class="text-lg font-semibold text-gray-900">Informasi Detail Barang</h2>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('inventories.edit', $inventory) }}" 
                       class="inline-flex items-center px-3 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z"/>
                            <path d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z"/>
                        </svg>
                        Edit
                    </a>
                    <form action="{{ route('inventories.destroy', $inventory) }}" method="POST" class="inline" 
                          onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center px-3 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd"/>
                            </svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="p-6">
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