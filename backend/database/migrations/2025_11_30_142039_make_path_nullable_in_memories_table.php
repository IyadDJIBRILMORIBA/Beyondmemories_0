<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('memories', function (Blueprint $table) {
            $table->string('path')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('memories', function (Blueprint $table) {
            $table->string('path')->nullable(false)->change();
        });
    }
};