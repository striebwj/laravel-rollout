<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolloutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('laravel-rollout.connection');
        $table = config('laravel-rollout.table');

        Schema::connection($connection)->create($table, function (Blueprint $table) {
            $table->string('key')->unique();
            $table->text('value');
            $table->integer('expiration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $connection = config('laravel-rollout.connection');
        $table = config('laravel-rollout.table');

        Schema::connection($connection)->dropIfExists($table);
    }
}
