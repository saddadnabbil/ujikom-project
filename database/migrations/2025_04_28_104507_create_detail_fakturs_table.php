<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('detail_fakturs', function (Blueprint $table) {
            $table->id();
            $table->string('no_faktur');
            $table->unsignedBigInteger('id_produk'); // or foreignId if it matches
            $table->integer('qty');
            $table->decimal('price', 15, 2);
            $table->decimal('subtotal', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraints
            $table->foreign('no_faktur')->references('no_faktur')->on('fakturs')->cascadeOnDelete();
            $table->foreign('id_produk')->references('id_produk')->on('produks')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_fakturs');
    }
};
