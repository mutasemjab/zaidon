<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('identity_number')->nullable()->unique();
            $table->string('address')->nullable();
            $table->string('name_of_parent')->nullable();
            $table->string('phone_of_parent')->nullable();
            $table->double('annual_installment');
            $table->double('past_balance')->default(0);
            $table->tinyInteger('activate')->default(1); // 1 yes //2 no
             $table->text('note')->nullable();
            $table->unsignedBigInteger('clas_id')->nullable(); // الصف التابع له
            $table->foreign('clas_id')->references('id')->on('clas')->onDelete('cascade');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
