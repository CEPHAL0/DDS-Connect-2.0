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
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("response_user_id");
            $table->text("question");
            $table->longText("answer");
            $table->unsignedBigInteger("question_id");



            $table->foreign("response_user_id")->references("id")->on("response_users")->onUpdate("cascade")->onDelete("restrict");
            $table->foreign("question_id")->references("id")->on("questions")->onUpdate("cascade")->onDelete("restrict");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responses');
    }
};
