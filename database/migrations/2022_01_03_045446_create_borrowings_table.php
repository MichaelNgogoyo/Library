<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('book_id');
            $table->timestamp('date_borrowed')->useCurrent();
            $table->timestamp('return_date')->useCurrent();
            $table->boolean('approved')->default(0);
            $table->timestamp('actual_return_date')->nullable();
            $table->text('return_condition')->nullable();
            $table->float('fine')->nullable();
            $table->timestamps();

        });
        Schema::table('borrowings', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');;
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade')->onUpdate('cascade');;
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('borrowings');
    }
}
