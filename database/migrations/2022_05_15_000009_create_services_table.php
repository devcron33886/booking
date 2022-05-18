<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('service_name')->unique();
            $table->string('slug')->nullable();
            $table->string('duration');
            $table->decimal('price', 15, 2);
            $table->string('currency')->nullable();
            $table->string('status')->nullable();
            $table->longText('service_description');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
