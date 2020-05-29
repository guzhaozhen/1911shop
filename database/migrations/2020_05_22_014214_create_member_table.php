<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('member')) { 
                Schema::create('member', function (Blueprint $table) {
                $table->increments('member_id');
                $table->string('member_name')->nullable($value=true);
                $table->bigInteger('mobile')->nullable($value=true);
                $table->string('member_email')->nullable($value1=true);
                $table->string('pwd');
                $table->timestamps();
            });
         }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member');
    }
}
