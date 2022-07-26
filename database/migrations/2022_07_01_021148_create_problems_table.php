<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problems', function (Blueprint $table) {
            $table->id();

            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('tags')->nullable();
            $table->foreignId('category_id')->nullable()->references('id')
                ->on('categories')->onDelete('cascade');

            $table->foreignId('user_id')->nullable()->references('id')
                ->on('users')->onDelete('cascade');
            $table->integer('status')->default(0);
            $table->boolean('important')->default(0);//important




            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('problems');
    }
};