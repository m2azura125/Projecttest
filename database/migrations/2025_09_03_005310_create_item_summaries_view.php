<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB; // <-- Jangan lupa import DB

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Perintah SQL untuk membuat view
        DB::statement("
            CREATE VIEW item_summaries AS
            SELECT
                id,
                nama_barang,
                jumlah,
                harga,
                (jumlah * harga) AS total_harga
            FROM
                items
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Perintah untuk menghapus view jika migration di-rollback
        DB::statement("DROP VIEW IF EXISTS item_summaries");
    }
};