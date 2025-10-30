<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('positions', function(Blueprint $table){
            $table->string('nama_jabatan', 100)->after('id');
            $table->decimal('gaji_pokok', 10,2)->after('nama_jabatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('positions', function(Blueprint $table){
            $table->dropColumn('nama_jabatan');
            $table->dropColumn('gaji_pokok');
        });
    }
};
