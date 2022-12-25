<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('moy_sklad_configs', function (Blueprint $table) {
            $table->id();
            $table->string('app_id')->nullable()->index();
            $table->string('account_id')->nullable()->index();
            $table->text('info_message')->nullable();
            $table->string('store')->nullable();
            $table->text('access_token')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('moy_sklad_configs');
    }
};
