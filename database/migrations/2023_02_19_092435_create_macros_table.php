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
        Schema::create('macros', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->float('carbohydrate');
            $table->float('protein');
            $table->float('fat');
            $table->float('calories');
            $table->string('count_as')->unique();
            $table->integer('subgroup_id');
            $table->integer('status');
            $table->integer('created_by');
            $table->softDeletes();

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
        Schema::dropIfExists('macros');
    }
};
