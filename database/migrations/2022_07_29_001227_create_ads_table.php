<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('tags');
            $table->date('start_date');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('advertiser_id')->nullable();
            $table->enum("type",["free","paid"])->default("free");
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('cascade');
            $table->foreign('advertiser_id')->references('id')->on('advertisers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
}
