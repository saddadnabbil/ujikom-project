<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fakturs', function (Blueprint $table) {
            $table->id();
            $table->string('no_faktur')->unique();
            $table->date('tanggal_faktur');
            $table->date('due_date')->nullable();
            $table->string('metode_bayar')->nullable();
            $table->decimal('ppn', 15, 2)->default(0);
            $table->decimal('dp', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0); // sebelum ppn/dp
            $table->decimal('grand_total', 15, 2)->default(0); // sesudah ppn dan dp
    
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->foreignId('perusahaan_id')->constrained('perusahaans')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
    
            $table->timestamps();
            $table->softDeletes();
        });
    
    }

    public function down(): void
    {
        Schema::dropIfExists('fakturs');
    }
};
