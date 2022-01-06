<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned()->index();;
            $table->unsignedBigInteger('library_id')->unsigned()->index();;
            $table->unsignedBigInteger('author_id')->unsigned()->index();;
            $table->unsignedBigInteger('publisher_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('publish_date');
            $table->timestamps();

        });
        Schema::table('books', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('library_id')->references('id')->on('libraries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('publisher_id')->references('id')->on('publishers')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
