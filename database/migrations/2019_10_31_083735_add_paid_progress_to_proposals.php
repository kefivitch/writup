<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaidProgressToProposals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('proposals', 'paid_progress')) {
            Schema::table(
                'proposals',
                function (Blueprint $table) {
                    $table->enum(
                        'paid_progress',
                        ['in-progress', 'completed']
                    )->default('in-progress');
                }
            );
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'proposals',
            function (Blueprint $table) {
                $table->dropColumn('paid_progress');
            }
        );
    }
}
