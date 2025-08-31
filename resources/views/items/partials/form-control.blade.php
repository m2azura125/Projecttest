<div class="grid grid-cols-1 gap-6">
    <div>
        <x-input-label for="kode_barang" :value="__('Kode Barang')" />
        <x-text-input id="kode_barang" class="block mt-1 w-full" type="text" name="kode_barang" :value="old('kode_barang', $item->kode_barang ?? '')" required />
        <x-input-error :messages="$errors->get('kode_barang')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="nama_barang" :value="__('Nama Barang')" />
        <x-text-input id="nama_barang" class="block mt-1 w-full" type="text" name="nama_barang" :value="old('nama_barang', $item->nama_barang ?? '')" required />
        <x-input-error :messages="$errors->get('nama_barang')" class="mt-2" />
    </div>
     <div>
        <x-input-label for="jumlah" :value="__('Jumlah')" />
        <x-text-input id="jumlah" class="block mt-1 w-full" type="number" name="jumlah" :value="old('jumlah', $item->jumlah ?? '')" required />
        <x-input-error :messages="$errors->get('jumlah')" class="mt-2" />
    </div>
     <div>
        <x-input-label for="harga" :value="__('Harga')" />
        <x-text-input id="harga" class="block mt-1 w-full" type="number" step="100" name="harga" :value="old('harga', $item->harga ?? '')" required />
        <x-input-error :messages="$errors->get('harga')" class="mt-2" />
    </div>
</div>
<div class="mt-6 flex items-center justify-end gap-x-6">
    <a href="{{ route('items.index') }}" class="text-sm font-semibold leading-6 text-gray-900 dark:text-gray-100">Batal</a>
    <x-primary-button>
        {{ isset($item) ? 'Update' : 'Simpan' }}
    </x-primary-button>
</div>