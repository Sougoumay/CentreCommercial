<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::create('products', function(Blueprint $table){
            $table->id();
            $table->foreignId('amazon_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->text('description');
            $table->string('image');
            $table->timestamps();
            /*$table->foreign('boutique_id')->references('id')->on('amazons')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('boutique_id')->unsigned();*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
