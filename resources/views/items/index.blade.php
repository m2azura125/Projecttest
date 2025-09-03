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
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="fixed top-5 right-5 z-50 flex items-start max-w-sm p-4 bg-green-600 border border-green-700 rounded-lg shadow-lg"
    >
        <div class="flex-shrink-0">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <div class="ml-3">
            <p class="text-sm font-semibold text-white">
                {{ session('success') }}
            </p>
        </div>
        <button @click="show = false" class="ml-4 -mr-1 -mt-1 p-1 rounded-md text-white/70 hover:text-white focus:outline-none focus:ring-2 focus:ring-white">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>
@endif

                    <form action="{{ route('items.bulkDestroy') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item yang dipilih?');">
                        @csrf
                        @method('DELETE')

                        <div class="flex justify-between items-center mb-4">
                            {{-- Tombol Hapus Terpilih di sisi kiri --}}
                            <div>
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Hapus Terpilih
                                </button>
                            </div>

                            {{-- Grup tombol di sisi kanan --}}
                            <div class="flex items-center space-x-2">
                                {{-- TOMBOL BARU UNTUK KE HALAMAN SUMMARY --}}
                                <a href="{{ route('items.summary') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Lihat Ringkasan
                                </a>

                                <a href="{{ route('items.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Tambah Item
                                </a>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                {{-- ... sisa tabel Anda tidak berubah ... --}}
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
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $items->firstItem() + $loop->index }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->kode_barang }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->nama_barang }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->jumlah }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($item->harga, 2, ',', '.') }}</td>
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
                    </form>

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