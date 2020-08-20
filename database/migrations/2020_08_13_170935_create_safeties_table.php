<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSafetiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('safeties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('disaster_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->string('myself');
            $table->string('contact_information')->nullable();
            $table->timestamps();
            // 外部キー制約
            $table->foreign('disaster_id')->references('id')->on('disasters')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // user_idとdisaster_idの組み合わせの重複を許さない
            $table->unique(['user_id', 'disaster_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('safeties');
    }
}
