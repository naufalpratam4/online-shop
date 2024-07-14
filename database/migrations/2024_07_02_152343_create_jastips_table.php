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
        Schema::create('jastips', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('nama_cus');
            $table->bigInteger('no_wa');
            $table->string('kategori');
            $table->enum('pengantaran', ['COD', 'Diantar']);
            $table->text('alamat');
            $table->text('deskripsi');
            $table->bigInteger('total_harga');
            $table->boolean('status')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jastips');
    }
};
