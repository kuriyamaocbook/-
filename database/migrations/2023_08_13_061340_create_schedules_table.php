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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('scadule_title')->comment('スケジュール名');
            $table->string('scadule_body')->nullable()->comment('スケジュール内容');
            $table->date('start_date')->comment('開始日');
            $table->date('end_date')->comment('終了日');
            $table->string('family_role')->nullable() ;// 家族役割カラムを追加
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
};
