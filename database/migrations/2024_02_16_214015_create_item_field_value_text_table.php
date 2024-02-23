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
        Schema::create('item_field_value_text', function (Blueprint $table){
            $table->id();
            $table->string("collection_id",8);
            $table->unsignedBigInteger('item_id');
            $table->string('field_id');
            $table->text('value');

            $table->foreign('collection_id')->references('key')->on('collections')->onDelete("cascade");
            $table->foreign(['collection_id','item_id'])->references(['collection_id','id'])->on('items')->onDelete("cascade");
            $table->foreign(['collection_id','field_id'])->references(['collection_id','name'])->on('fields')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_field_value_text');
    }
};
