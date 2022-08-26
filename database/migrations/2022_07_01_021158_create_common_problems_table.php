<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('common_problems', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->references('id')
                ->on('categories')->onDelete('cascade');

            $table->string('title')->nullable();
            $table->longText('description')->nullable();

            $table->string('image')->nullable();
            $table->string('file')->nullable();

            $table->longText('tags')->nullable();

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
        Schema::dropIfExists('common_problems');
    }
};
