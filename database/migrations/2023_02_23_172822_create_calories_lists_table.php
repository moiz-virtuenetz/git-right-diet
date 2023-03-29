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
        Schema::create('calories_lists', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('serving');
            $table->integer('macro_id');
            $table->integer('subgroup_id');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('calories_lists');
    }
};
