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
        Schema::create('items', function (Blueprint $table) {
            $table->string("collection_id",8);
            $table->unsignedBigInteger("id");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("collection_id")->references("key")->on("collections")->onDelete("cascade");
            $table->primary(['collection_id', 'id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
