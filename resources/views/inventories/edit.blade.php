@extends('layouts.app')

@section('title', 'Edit Barang')
@section('page-title', 'Edit Barang Inventaris')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-indigo-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z"/>
                    <path d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z"/>
                </svg>
                <h2 class="text-lg font-semibold text-gray-900">Form Edit Barang</h2>
            </div>
        </div>
        <div class="p-6">
                <form action="{{ route('inventories.update', $inventory) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kode_barang" class="form-label">Kode Barang <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('kode_barang') is-invalid @enderror" 
                                       id="kode_barang" name="kode_barang" 
                                       value="{{ old('kode_barang', $inventory->kode_barang) }}" 
                                       placeholder="Contoh: INV001, PC001, etc." required>
                                @error('kode_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama_barang" class="form-label">Nama Barang <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" 
                                       id="nama_barang" name="nama_barang" 
                                       value="{{ old('nama_barang', $inventory->nama_barang) }}" 
                                       placeholder="Masukkan nama barang" required>
                                @error('nama_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                  id="deskripsi" name="deskripsi" rows="3" 
                                  placeholder="Deskripsi detail barang (opsional)">{{ old('deskripsi', $inventory->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select class="form-select @error('kategori') is-invalid @enderror" 
                                        id="kategori" name="kategori" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Elektronik" {{ old('kategori', $inventory->kategori) == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                                    <option value="Furniture" {{ old('kategori', $inventory->kategori) == 'Furniture' ? 'selected' : '' }}>Furniture</option>
                                    <option value="Alat Tulis" {{ old('kategori', $inventory->kategori) == 'Alat Tulis' ? 'selected' : '' }}>Alat Tulis</option>
                                    <option value="Perangkat Komputer" {{ old('kategori', $inventory->kategori) == 'Perangkat Komputer' ? 'selected' : '' }}>Perangkat Komputer</option>
                                    <option value="Kendaraan" {{ old('kategori', $inventory->kategori) == 'Kendaraan' ? 'selected' : '' }}>Kendaraan</option>
                                    <option value="Lainnya" {{ old('kategori', $inventory->kategori) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('jumlah') is-invalid @enderror" 
                                       id="jumlah" name="jumlah" 
                                       value="{{ old('jumlah', $inventory->jumlah) }}" 
                                       min="0" required>
                                @error('jumlah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="satuan" class="form-label">Satuan <span class="text-danger">*</span></label>
                                <select class="form-select @error('satuan') is-invalid @enderror" 
                                        id="satuan" name="satuan" required>
                                    <option value="">Pilih Satuan</option>
                                    <option value="Unit" {{ old('satuan', $inventory->satuan) == 'Unit' ? 'selected' : '' }}>Unit</option>
                                    <option value="Pcs" {{ old('satuan', $inventory->satuan) == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                                    <option value="Set" {{ old('satuan', $inventory->satuan) == 'Set' ? 'selected' : '' }}>Set</option>
                                    <option value="Buah" {{ old('satuan', $inventory->satuan) == 'Buah' ? 'selected' : '' }}>Buah</option>
                                    <option value="Pak" {{ old('satuan', $inventory->satuan) == 'Pak' ? 'selected' : '' }}>Pak</option>
                                </select>
                                @error('satuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga (Rp)</label>
                                <input type="number" class="form-control @error('harga') is-invalid @enderror" 
                                       id="harga" name="harga" 
                                       value="{{ old('harga', $inventory->harga) }}" 
                                       min="0" step="0.01" placeholder="0">
                                @error('harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Masukkan harga per unit (opsional)</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="lokasi" class="form-label">Lokasi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('lokasi') is-invalid @enderror" 
                                       id="lokasi" name="lokasi" 
                                       value="{{ old('lokasi', $inventory->lokasi) }}" 
                                       placeholder="Contoh: Ruang IT, Lantai 2" required>
                                @error('lokasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tanggal_masuk" class="form-label">Tanggal Masuk <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror" 
                                       id="tanggal_masuk" name="tanggal_masuk" 
                                       value="{{ old('tanggal_masuk', $inventory->tanggal_masuk->format('Y-m-d')) }}" required>
                                @error('tanggal_masuk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kondisi" class="form-label">Kondisi <span class="text-danger">*</span></label>
                                <select class="form-select @error('kondisi') is-invalid @enderror" 
                                        id="kondisi" name="kondisi" required>
                                    <option value="">Pilih Kondisi</option>
                                    <option value="Baik" {{ old('kondisi', $inventory->kondisi) == 'Baik' ? 'selected' : '' }}>Baik</option>
                                    <option value="Perlu Perbaikan" {{ old('kondisi', $inventory->kondisi) == 'Perlu Perbaikan' ? 'selected' : '' }}>Perlu Perbaikan</option>
                                    <option value="Rusak" {{ old('kondisi', $inventory->kondisi) == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                                </select>
                                @error('kondisi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <a href="{{ route('inventories.index') }}" class="btn btn-secondary me-md-2">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg"></i> Update Barang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection