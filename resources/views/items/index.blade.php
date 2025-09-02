<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Inventaris Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session('success'))
                        <div class="bg-green-200 border-green-600 text-green-900 border-l-4 p-4 mb-4" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    {{-- Form untuk Aksi Massal (Bulk Action) --}}
                    <form action="{{ route('items.bulkDestroy') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item yang dipilih?');">
                        @csrf
                        @method('DELETE')

                        <div class="flex justify-between items-center mb-4">
                            {{-- Tombol Hapus Terpilih --}}
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Hapus Terpilih
                            </button>

                            {{-- Tombol Tambah Item --}}
                            <a href="{{ route('items.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Tambah Item
                            </a>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            <input type="checkbox" id="select-all-checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode Barang</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Barang</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @forelse ($items as $item)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <input type="checkbox" name="selected_items[]" value="{{ $item->id }}" class="item-checkbox rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                            </td>
                                            {{-- PERBAIKAN: Penomoran yang benar untuk paginasi --}}
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $items->firstItem() + $loop->index }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->kode_barang }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->nama_barang }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->jumlah }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($item->harga, 2, ',', '.') }}</td>
                                            
                                            {{-- PERBAIKAN: Kesalahan sintaks dan struktur form diperbaiki di sini --}}
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('items.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                <button onclick="event.preventDefault(); if(confirm('Apakah Anda yakin ingin menghapus item ini?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }" class="text-red-600 hover:text-red-900 ml-4">
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                                Data inventaris masih kosong.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </form> {{-- Penutup Form Aksi Massal --}}

                    <div class="mt-4">
                        {{ $items->links() }}
                    </div>

                    <div class="hidden">
                        @foreach ($items as $item)
                            <form id="delete-form-{{ $item->id }}" action="{{ route('items.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('select-all-checkbox').addEventListener('click', function(event) {
            let checkboxes = document.querySelectorAll('.item-checkbox');
            checkboxes.forEach(function(checkbox) { checkbox.checked = event.target.checked; });
        });
    </script>
    @endpush
</x-app-layout>