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
        Schema::create('phones', function (Blueprint $table) {
            $table->id('phone_id');
            $table->morphs('phoneable');
            $table->string('phone_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('phones', function (Blueprint $table) {
            $table->dropColumn('phone_id');
            $table->dropColumn('phoneable_id');
            $table->dropColumn('phoneable_type');
            $table->dropColumn('phone_number');
            $table->dropTimestamps();
        });
    }
};
