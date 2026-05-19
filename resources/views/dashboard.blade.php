<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <!-- Form Tambah Kategori -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Tambah Kategori</h2>
        <form action="{{ route('admin.category.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                <input type="text" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 border focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Urutan (Sort Order)</label>
                <input type="number" name="sort_order" value="0" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 border" required>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Kategori</button>
        </form>
    </div>

    <!-- Form Tambah Produk -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Tambah Produk / Layanan</h2>
        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 border" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
                    <input type="text" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 border" required>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" rows="2" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 border" required></textarea>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                    <input type="number" name="price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 border" required>
                </div>
                <div class="flex items-center mt-6">
                    <input type="checkbox" name="is_cbt_panel" value="1" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label class="ml-2 block text-sm text-gray-900">Produk ini adalah Panel K-CBT</label>
                </div>
            </div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan Produk</button>
        </form>
    </div>
</div>

<!-- Manajemen Pesanan -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-bold text-gray-800">Manajemen Pesanan K-Host</h2>
    </div>
    <div class="p-6">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Layanan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi / Setting API CBT</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($orders as $order)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->user->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->product->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                            {{ strtoupper($order->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium">
                        <form action="{{ route('admin.order.update', $order->id) }}" method="POST" class="flex items-center space-x-2">
                            @csrf
                            @method('PUT')
                            <select name="status" class="border border-gray-300 rounded p-1">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="active" {{ $order->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            @if($order->product->is_cbt_panel)
                                <input type="text" name="cbt_api_endpoint" placeholder="URL Endpoint API CBT" value="{{ $order->cbt_api_endpoint }}" class="border border-gray-300 rounded p-1 w-32 text-xs">
                                <input type="text" name="cbt_api_key" placeholder="API Key CBT" value="{{ $order->cbt_api_key }}" class="border border-gray-300 rounded p-1 w-24 text-xs">
                            @endif
                            <button type="submit" class="bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700 text-xs">Update</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada pesanan masuk.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection