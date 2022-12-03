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
        Schema::create('slot', function (Blueprint $table) {
            $table->id();
            $table->dateTimeTz('from')->nullable(false)->comment('Время начала');
            $table->dateTimeTz('to')->nullable(false)->comment('Время конца');
            $table->integer('type_id')->nullable()->comment('Тип');
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
        Schema::dropIfExists('slot');
    }
};
