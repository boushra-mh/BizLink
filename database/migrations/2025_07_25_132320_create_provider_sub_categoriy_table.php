<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('provider_sub_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_category_id')->constrained()->onDelete('cascade');
                        $table->foreignId('provider_id')->constrained()->onDelete('cascade');
            $table->timestamps();
              $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provider_sub_category');
    }
};
