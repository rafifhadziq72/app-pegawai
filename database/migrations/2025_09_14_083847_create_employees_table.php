<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap', 100);
            $table->string('email', 100);
            $table->string('nomor_telepon', 15);
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->date('tanggal_masuk');
            $table->foreignId('departemen_id')->default(1)->constrained('departemens');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
        Schema::table('employees', function (Blueprint $table) {
            $table->unsignedBigInteger('position_id')->nullable(); 
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('set null'); // Add if missing
            
        });
    }



    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
