<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_customer'); // Name of the customer
            $table->string('perusahaan_cust'); // Company name
            $table->string('alamat'); // Address of the customer
            $table->timestamps();
            $table->softDeletes(); // For soft deleting records
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
