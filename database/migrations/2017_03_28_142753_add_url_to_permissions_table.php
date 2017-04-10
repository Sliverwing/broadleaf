<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUrlToPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permissions', function (Blueprint $table){
            $table->string('url')->nullable();
            $table->boolean('is_url_enabled')->default(false);
            $table->integer('parent_id')->unsigned()->nullable();

            $table->foreign('parent_id')->references('id')->on('permissions')
                ->upUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permissions', function (Blueprint $table){
            $table->dropColumn('url');
            $table->dropColumn('is_url_enabled');
            $table->dropForeign('permissions_parent_id_foreign');
            $table->dropColumn('parent_id');
        });
    }
}
