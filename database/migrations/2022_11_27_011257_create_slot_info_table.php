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
        Schema::create('slot_info', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Slot::class);
            $table->string('name')->nullable(false);
            $table->text('description')->nullable();
            $table->integer('capacity')->nullable(false)->default(1);
            $table->integer('price')->nullable(false)->default(0);
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
        Schema::dropIfExists('slot_info');
    }
};
