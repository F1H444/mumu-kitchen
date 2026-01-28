<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categories = DB::table('kategoris')
            ->select('nama_kategori', DB::raw('count(*) as count'))
            ->groupBy('nama_kategori')
            ->having('count', '>', 1)
            ->get();

        foreach ($categories as $cat) {
            $duplicates = DB::table('kategoris')->where('nama_kategori', $cat->nama_kategori)->orderBy('id')->get();

            // Keep the first one, merge others into it
            $keep = $duplicates->first();
            $remove = $duplicates->slice(1);

            foreach ($remove as $rem) {
                // Update products to point to the 'keep' category
                DB::table('produks')->where('kategori_id', $rem->id)->update(['kategori_id' => $keep->id]);

                // Now delete the duplicate category
                DB::table('kategoris')->where('id', $rem->id)->delete();
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Cannot reverse merging without data loss or tracking
    }
};
