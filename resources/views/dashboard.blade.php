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

                    {{-- Form untuk Aksi Massal (Bulk Action) --}}
                    <form action="{{ route('items.bulkDestroy') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item yang dipilih?');">
                        @csrf
                        @method('DELETE')

                        {{-- Baris Tombol Aksi --}}
                        <div class="flex justify-between items-center mb-4">
                            {{-- Tombol Hapus Terpilih (BARU) --}}
                            <div>
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Hapus Terpilih
                                </button>
                            </div>

                            {{-- Tombol Tambah Item --}}
                            <a href="{{ route('items.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Tambah Item
                            </a>
                        </div>

                        {{-- Notifikasi Sukses --}}
                        @if ($message = Session::get('success'))
                            <div class="bg-green-200 border-green-600 text-green-900 border-l-4 p-4 mb-4" role="alert">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        {{-- Tabel Data Inventaris --}}
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        {{-- Header Checkbox untuk "Pilih Semua" (BARU) --}}
                                        <th scope="col" class="px-6 py-3">
                                            <input type="checkbox" id="select-all-checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">No</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Kode Barang</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama Barang</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Jumlah</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Harga</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Dibuat Pada</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Diperbarui Pada</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @forelse ($items as $item)
                                        <tr>
                                            {{-- Kolom Checkbox untuk setiap item (BARU) --}}
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <input type="checkbox" name="selected_items[]" value="{{ $item->id }}" class="item-checkbox rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $items->firstItem() + $loop->index }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->kode_barang }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->nama_barang }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->jumlah }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->created_at->format('d-m-Y H:i') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->updated_at->format('d-m-Y H:i') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                {{-- Form untuk Hapus tunggal tidak diubah --}}
                                                <form action="{{ route('items.destroy', $item->id) }}" method="POST">
                                                    <a href="{{ route('items.edit', $item->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900">Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 ml-4" onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                                Data inventaris masih kosong ges
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </form> {{-- Penutup Form Aksi Massal --}}

                    {{-- Link Paginasi --}}
                    <div class="mt-4">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script untuk "Pilih Semua" (BARU) --}}
    @push('scripts')
    <script>
        document.getElementById('select-all-checkbox').addEventListener('click', function(event) {
            let checkboxes = document.querySelectorAll('.item-checkbox');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = event.target.checked;
            });
        });
    </script>
    @endpush

</x-app-layout>