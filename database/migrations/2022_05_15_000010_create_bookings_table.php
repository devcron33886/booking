<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('meeting_time');
            $table->string('name');
            $table->string('email');
            $table->string('address');
            $table->string('phone_number');
            $table->longText('notes')->nullable();
            $table->string('status')->nullable();
            $table->boolean('privacy')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
