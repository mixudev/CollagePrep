@extends('layouts.app')

@section('title', 'Manajemen Kategori')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center space-x-3 mb-2">
                    <div class="flex-shrink-0 bg-gray-100 rounded-lg p-2.5">
                        <svg class="h-6 w-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Manajemen Kategori</h1>
                        <p class="text-sm text-gray-600 mt-0.5">Kelola kategori mata pelajaran</p>
                    </div>
                </div>
            </div>

            <!-- Add Category Form -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6 mb-6">
                <div class="flex items-center space-x-2 mb-4">
                    <svg class="h-5 w-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <h3 class="text-base font-semibold text-gray-900">Tambah Kategori Baru</h3>
                </div>
                <form action="{{ route('admin.categories.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-5 gap-4" data-confirm-submit="Apakah Anda yakin ingin menambahkan kategori baru?">
                    @csrf
                    <input type="text" name="name" placeholder="Nama Kategori" required class="px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 text-sm">
                    <input type="text" name="code" placeholder="Kode (TPS, MAT)" required class="px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 text-sm">
                    <input type="text" name="icon" placeholder="Icon" class="px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 text-sm">
                    <input type="color" name="color" value="#111827" class="px-3 py-2 border border-gray-300 rounded-lg h-10 cursor-pointer">
                    <button type="submit" class="px-4 py-2.5 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors font-medium text-sm">Tambah</button>
                </form>
            </div>

            <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kode</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Icon</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Warna</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3.5 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($categories as $category)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded bg-gray-100 text-gray-700 border border-gray-300">
                                        {{ $category->code }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $category->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $category->icon ?: '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-6 h-6 rounded-full mr-2 border border-gray-300" style="background-color: {{ $category->color ?? '#111827' }}"></div>
                                        <span class="text-sm text-gray-600">{{ $category->color ?? '#111827' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded {{ $category->is_active ? 'bg-gray-100 text-gray-700 border border-gray-300' : 'bg-gray-50 text-gray-500 border border-gray-200' }}">
                                        {{ $category->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-600 hover:text-gray-900 font-medium" data-confirm-delete="Hapus kategori ini?">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    <h3 class="text-sm font-medium text-gray-900 mb-1">Belum ada kategori</h3>
                                    <p class="text-sm text-gray-500">Mulai dengan menambahkan kategori pertama</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @if($categories->hasPages())
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                        {{ $categories->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

