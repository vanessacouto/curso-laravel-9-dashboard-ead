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
        Schema::create('reply_support', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('support_id')->index();
            $table->uuid('user_id')->nullable(); // id de user pois um aluno pode responder o support
            $table->uuid('admin_id')->nullable(); // support pode ser respondido por um admin
            $table->text('description');
            $table->timestamps();

            $table->foreign('support_id')
            ->references('id')
            ->on('supports');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reply_supports');
    }
};