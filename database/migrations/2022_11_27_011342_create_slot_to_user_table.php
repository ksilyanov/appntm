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
        Schema::create('slot_to_user', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Slot::class);
            $table->foreignIdFor(\App\Models\User::class);
            $table->boolean('approved')->nullable(false)->default(false);
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
        Schema::dropIfExists('slot_to_user');
    }
};
