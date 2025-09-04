@extends('layouts.admin_layout')

@section('content')
<div class="container mx-auto px-6 py-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">📌 Product Features</h1>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Add Feature Form -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h2 class="text-lg font-semibold mb-4">➕ Add New Feature</h2>
        <form action="{{ route('product.features.store') }}" method="POST" class="flex items-center gap-4">
            @csrf
            <input type="text" name="feature_name" placeholder="Feature name..."
                   class="flex-1 border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            <button type="submit" 
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-700 transition">
                Save
            </button>
        </form>
    </div>

    <!-- Features Table -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-4">📋 Features List</h2>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left text-gray-700">
                    <th class="p-3 border-b">#</th>
                    <th class="p-3 border-b">Feature Name</th>
                    <th class="p-3 border-b text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($features as $key => $feature)
                    <tr class="hover:bg-gray-50">
                        <td class="p-3 border-b">{{ $key+1 }}</td>
                        <td class="p-3 border-b">{{ $feature->feature_name }}</td>
                        <td class="p-3 border-b text-center flex justify-center gap-3">
                            <!-- Edit -->
                            <form action="{{ route('product.features.update', $feature->id) }}" method="POST" class="flex gap-2">
                                @csrf
                                @method('PUT')
                                <input type="text" name="feature_name" value="{{ $feature->feature_name }}" 
                                       class="border rounded px-2 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                                <button type="submit" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">
                                    Update
                                </button>
                            </form>

                            <!-- Delete -->
                            <form action="{{ route('product.features.destroy', $feature->id) }}" method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete this feature?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-4 text-center text-gray-500">No features found 🚫</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
