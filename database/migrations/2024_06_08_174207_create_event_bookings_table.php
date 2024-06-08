<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('event_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("event_id");
            $table->unsignedBigInteger("user_id");
            $table->string("contact");
            $table->enum("payment", ['paid', 'booked']);
            $table->timestamps();


            $table->foreign("event_id")->references("id")->on("events")->onDelete('restrict')->onUpdate("cascade");
            $table->foreign("user_id")->references('id')->on("users")->onDelete("restrict")->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_bookings');
    }
};
