<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('name',60);
            $table->string('description',250)->nullable();
            $table->string('serial_number',60)->nullable();
            $table->string('model',60)->nullable();
            $table->string('manufacturer',60)->nullable();
            $table->foreignIdFor(\App\Models\Location::class)->nullable();
            $table->foreignIdFor(\App\Models\Treatment::class)->nullable();
            $table->string('image_path', 2048)->nullable();
            $table->decimal('price',10,2)->nullable();
            $table->string('status',10)->nullable();
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
        Schema::dropIfExists('equipment');
    }
}
