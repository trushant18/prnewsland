<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobile_number')->nullable()->after('password');
            $table->string('company_name')->nullable()->after('mobile_number');
            $table->string('company_website')->nullable()->after('company_name');
            $table->string('country')->nullable()->after('company_website');
            $table->text('bio')->nullable()->after('country');
            $table->string('twitter_link')->nullable()->after('bio');
            $table->string('facebook_link')->nullable()->after('twitter_link');
            $table->string('linkedin_link')->nullable()->after('facebook_link');
            $table->string('youtube_link')->nullable()->after('linkedin_link');
            $table->string('image')->nullable()->after('youtube_link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('mobile_number');
            $table->dropColumn('company_name');
            $table->dropColumn('company_website');
            $table->dropColumn('country');
            $table->dropColumn('bio');
            $table->dropColumn('twitter_link');
            $table->dropColumn('facebook_link');
            $table->dropColumn('linkedin_link');
            $table->dropColumn('youtube_link');
            $table->dropColumn('image');
        });
    }
}
