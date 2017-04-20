<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameSubmissionRequirementsField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('submission_requirements', function (Blueprint $table) {
            $table->boolean('mandatory')->after('field_type')->change();
            $table->renameColumn('mandatory', 'field_required');
            $table->dropColumn('require_file');
            $table->integer('sequence')->unsigned()->after('id');
        });

        Schema::table('evaluation_requirements', function (Blueprint $table) {
            $table->renameColumn('mandatory', 'required');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('submission_requirements', function (Blueprint $table) {
            $table->renameColumn('field_required', 'mandatory');
            $table->boolean('require_file')->after('field_required');
            $table->dropColumn('sequence');
        });

        Schema::table('evaluation_requirements', function (Blueprint $table) {
            $table->renameColumn('required', 'mandatory');
        });
    }
}
