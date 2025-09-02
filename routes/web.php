<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;
use App\Models\Item; // <-- DITAMBAHKAN: Untuk mengambil data dari database

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rute ini sekarang mengambil data item dan mengirimkannya ke view dashboard
Route::get('/', function () {
    $items = Item::latest()->paginate(10); // Mengambil data
    return view('dashboard', compact('items')); // Mengirim data ke view
})->middleware(['auth', 'verified'])->name('dashboard');

// Route untuk hapus massal (BARU)
Route::delete('items/bulk-destroy', [ItemController::class, 'bulkDestroy'])->name('items.bulkDestroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute Resource untuk CRUD Item tetap diperlukan untuk form Tambah, Edit, dan Hapus
    Route::resource('items', ItemController::class);
});

require __DIR__.'/auth.php';
