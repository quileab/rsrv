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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name',120);
            $table->integer('pid')->nullable();
            $table->string('address',120)->nullable();
            $table->string('phone',40)->nullable();
            $table->string('email',80)->nullable();
            $table->foreignIdFor(\App\Models\Location::class)->nullable();
            $table->foreignIdFor(\App\Models\User::class)->nullable();
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
        Schema::dropIfExists('customers');
    }
};
