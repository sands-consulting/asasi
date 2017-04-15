<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticeAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice_awards', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('price', 20, 2);
            $table->string('period')->nullable();
            $table->unsignedInteger('submission_id');
            $table->unsignedInteger('vendor_id');
            $table->unsignedInteger('notice_id');
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->timestamp('awarded_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('notice_awards');
    }
}
