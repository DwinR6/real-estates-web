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
        Schema::create('projects', function (Blueprint $table) {
            $table->id('project_id');
            $table->integer('developer_id');
            $table->integer('category_id');
            $table->string('name');
            $table->text('description');
            $table->text('lot_description');
            $table->text('infrastructure_description');
            $table->text('area_description');
            $table->string('location');
            $table->string('status');
            $table->date('start_date');
            $table->date('end_date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('project_id');
            $table->dropColumn('developer_id');
            $table->dropColumn('category_id');
            $table->dropColumn('name');
            $table->dropColumn('description');
            $table->dropColumn('lot_description');
            $table->dropColumn('infrastructure_description');
            $table->dropColumn('area_description');
            $table->dropColumn('location');
            $table->dropColumn('status');
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');

            $table->dropTimestamps();
        });
    }
};
