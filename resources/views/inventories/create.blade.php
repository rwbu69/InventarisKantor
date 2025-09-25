@extends('layouts.app')

@section('title', 'Tambah Barang Baru')
@section('page-title', 'Tambah Barang Inventaris')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-indigo-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z" clip-rule="evenodd"/>
                </svg>
                <h2 class="text-lg font-semibold text-gray-900">Form Tambah Barang Baru</h2>
            </div>
        </div>
        <div class="p-6">
            <form action="{{ route('inventories.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="kode_barang" class="block text-sm font-medium text-gray-700 mb-2">Kode Barang <span class="text-red-500">*</span></label>
                        <input type="text" 
                               class="w-full px-3 py-2 border {{ $errors->has('kode_barang') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                               id="kode_barang" name="kode_barang" value="{{ old('kode_barang') }}" 
                               placeholder="Contoh: INV001, PC001, etc." required>
                        @error('kode_barang')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="nama_barang" class="block text-sm font-medium text-gray-700 mb-2">Nama Barang <span class="text-red-500">*</span></label>
                        <input type="text" 
                               class="w-full px-3 py-2 border {{ $errors->has('nama_barang') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                               id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}" 
                               placeholder="Masukkan nama barang" required>
                        @error('nama_barang')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea class="w-full px-3 py-2 border {{ $errors->has('deskripsi') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                              id="deskripsi" name="deskripsi" rows="3" 
                              placeholder="Deskripsi detail barang (opsional)">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="md:col-span-2">
                        <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                        <select class="w-full px-3 py-2 border {{ $errors->has('kategori') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                                id="kategori" name="kategori" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Elektronik" {{ old('kategori') == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                            <option value="Furniture" {{ old('kategori') == 'Furniture' ? 'selected' : '' }}>Furniture</option>
                            <option value="Alat Tulis" {{ old('kategori') == 'Alat Tulis' ? 'selected' : '' }}>Alat Tulis</option>
                            <option value="Perangkat Komputer" {{ old('kategori') == 'Perangkat Komputer' ? 'selected' : '' }}>Perangkat Komputer</option>
                            <option value="Kendaraan" {{ old('kategori') == 'Kendaraan' ? 'selected' : '' }}>Kendaraan</option>
                            <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('kategori')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="jumlah" class="block text-sm font-medium text-gray-700 mb-2">Jumlah <span class="text-red-500">*</span></label>
                        <input type="number" 
                               class="w-full px-3 py-2 border {{ $errors->has('jumlah') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                               id="jumlah" name="jumlah" value="{{ old('jumlah', 1) }}" 
                               min="0" required>
                        @error('jumlah')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="satuan" class="block text-sm font-medium text-gray-700 mb-2">Satuan <span class="text-red-500">*</span></label>
                        <select class="w-full px-3 py-2 border {{ $errors->has('satuan') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                                id="satuan" name="satuan" required>
                            <option value="">Pilih Satuan</option>
                            <option value="Unit" {{ old('satuan') == 'Unit' ? 'selected' : '' }}>Unit</option>
                            <option value="Pcs" {{ old('satuan') == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                            <option value="Set" {{ old('satuan') == 'Set' ? 'selected' : '' }}>Set</option>
                            <option value="Buah" {{ old('satuan') == 'Buah' ? 'selected' : '' }}>Buah</option>
                            <option value="Pak" {{ old('satuan') == 'Pak' ? 'selected' : '' }}>Pak</option>
                        </select>
                        @error('satuan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="harga" class="block text-sm font-medium text-gray-700 mb-2">Harga (Rp)</label>
                        <input type="number" 
                               class="w-full px-3 py-2 border {{ $errors->has('harga') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                               id="harga" name="harga" value="{{ old('harga') }}" 
                               min="0" step="0.01" placeholder="0">
                        @error('harga')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Masukkan harga per unit (opsional)</p>
                    </div>
                    <div>
                        <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">Lokasi <span class="text-red-500">*</span></label>
                        <input type="text" 
                               class="w-full px-3 py-2 border {{ $errors->has('lokasi') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                               id="lokasi" name="lokasi" value="{{ old('lokasi') }}" 
                               placeholder="Contoh: Ruang IT, Lantai 2" required>
                        @error('lokasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="tanggal_masuk" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Masuk <span class="text-red-500">*</span></label>
                        <input type="date" 
                               class="w-full px-3 py-2 border {{ $errors->has('tanggal_masuk') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                               id="tanggal_masuk" name="tanggal_masuk" 
                               value="{{ old('tanggal_masuk', date('Y-m-d')) }}" required>
                        @error('tanggal_masuk')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="kondisi" class="block text-sm font-medium text-gray-700 mb-2">Kondisi <span class="text-red-500">*</span></label>
                        <select class="w-full px-3 py-2 border {{ $errors->has('kondisi') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                                id="kondisi" name="kondisi" required>
                            <option value="">Pilih Kondisi</option>
                            <option value="Baik" {{ old('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                            <option value="Perlu Perbaikan" {{ old('kondisi') == 'Perlu Perbaikan' ? 'selected' : '' }}>Perlu Perbaikan</option>
                            <option value="Rusak" {{ old('kondisi') == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                        </select>
                        @error('kondisi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-4 pt-6">
                    <a href="{{ route('inventories.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 bg-white rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M7.72 12.53a.75.75 0 010-1.06l7.5-7.5a.75.75 0 111.06 1.06L9.31 12l6.97 6.97a.75.75 0 11-1.06 1.06l-7.5-7.5z" clip-rule="evenodd"/>
                        </svg>
                        Kembali
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-lg hover:from-indigo-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd"/>
                        </svg>
                        Simpan Barang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection