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
            $table->text("question");
            $table->text("answer");
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("question_id");
            $table->unsignedBigInteger("form_id");

            $table->timestamps();


            $table->foreign("user_id")->references("id")->on("users")->onUpdate("cascade")->onDelete("restrict");
            $table->foreign("question_id")->references("id")->on("questions")->onUpdate("cascade")->onDelete("restrict");
            $table->foreign("form_id")->references("id")->on("forms")->onUpdate("cascade")->onDelete("restrict");

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
