@extends('layouts.app')

@section('title', 'Daftar Inventaris')
@section('page-title', 'Daftar Inventaris Kantor')

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-bg-primary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title">Total Barang</h6>
                                <h3 class="mb-0">{{ $inventories->total() }}</h3>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-box-seam fs-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-bg-success">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title">Kondisi Baik</h6>
                                <h3 class="mb-0">{{ $inventories->where('kondisi', 'Baik')->count() }}</h3>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-check-circle fs-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-bg-warning">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title">Perlu Perhatian</h6>
                                <h3 class="mb-0">{{ $inventories->whereIn('kondisi', ['Rusak', 'Perlu Perbaikan'])->count() }}</h3>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-exclamation-triangle fs-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-bg-info">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title">Total Nilai</h6>
                                <h3 class="mb-0">Rp {{ number_format($inventories->sum('harga'), 0, ',', '.') }}</h3>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-currency-dollar fs-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Table Card -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-table"></i> Daftar Inventaris
                </h5>
                <a href="{{ route('inventories.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> Tambah Barang Baru
                </a>
            </div>
            <div class="card-body">
                @if($inventories->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Jumlah</th>
                                    <th>Lokasi</th>
                                    <th>Kondisi</th>
                                    <th>Harga</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inventories as $inventory)
                                <tr>
                                    <td><code>{{ $inventory->kode_barang }}</code></td>
                                    <td>
                                        <strong>{{ $inventory->nama_barang }}</strong>
                                        @if($inventory->deskripsi)
                                            <br><small class="text-muted">{{ Str::limit($inventory->deskripsi, 50) }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $inventory->kategori }}</span>
                                    </td>
                                    <td>{{ number_format($inventory->jumlah) }} {{ $inventory->satuan }}</td>
                                    <td>
                                        <i class="bi bi-geo-alt"></i> {{ $inventory->lokasi }}
                                    </td>
                                    <td>
                                        @php
                                            $badgeClass = match($inventory->kondisi) {
                                                'Baik' => 'bg-success',
                                                'Rusak' => 'bg-danger',
                                                'Perlu Perbaikan' => 'bg-warning',
                                                default => 'bg-secondary'
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ $inventory->kondisi }}</span>
                                    </td>
                                    <td>
                                        @if($inventory->harga)
                                            Rp {{ number_format($inventory->harga, 0, ',', '.') }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('inventories.show', $inventory) }}" 
                                               class="btn btn-sm btn-outline-info" title="Lihat Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('inventories.edit', $inventory) }}" 
                                               class="btn btn-sm btn-outline-primary" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('inventories.destroy', $inventory) }}" 
                                                  method="POST" class="d-inline" 
                                                  onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $inventories->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-inbox display-1 text-muted"></i>
                        <h4 class="text-muted mt-3">Belum ada data inventaris</h4>
                        <p class="text-muted">Mulai menambahkan barang inventaris dengan mengklik tombol "Tambah Barang Baru" di atas.</p>
                        <a href="{{ route('inventories.create') }}" class="btn btn-primary mt-2">
                            <i class="bi bi-plus-lg"></i> Tambah Barang Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection