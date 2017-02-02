<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // Create table for storing packages
        Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('name');
            $table->text('description');
            $table->string('validity_type');
            $table->string('validity_quantity');
            $table->decimal('fee_amount');
            $table->string('fee_tax_code');
            $table->decimal('fee_tax_rate');
            $table->string('label_color')->nullable();
            $table->string('status');
            $table->nullableTimestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
}
