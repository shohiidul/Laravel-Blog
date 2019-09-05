<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBookmarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookmarks', function (Blueprint $table) {
            $table->string('url_unique_key',32)->unique()->change();
            $table->string('short_desc',250)->nullable()->change();
            $table->text('details')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookmarks', function (Blueprint $table) {
        });
    }
}
