<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocsisUpdateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docsis_update', function (Blueprint $table) {
            $table->string('modem_macaddr')->primary()->nullable(false)->default('');
            $table->string('ipaddr')->nullable(false)->default('');
            $table->string('cmts_ip')->nullable(false)->default('');
            $table->string('agentid')->nullable(false)->default('');
            $table->string('version')->nullable(false)->default('');
            $table->enum('mce_concat',['YES','NO'])->nullable(true)->default(null);
            $table->enum('mce_ver',['v1.0','v1.1','v2.0'])->nullable(true)->default(null);
            $table->enum('mce_frag',['YES','NO'])->nullable(true)->default(null);
            $table->enum('mce_phs',['YES','NO'])->nullable(true)->default(null);
            $table->enum('mce_igmp',['YES','NO'])->nullable(true)->default(null);
            $table->enum('mce_bpi',['BPI','BPI+'])->nullable(true)->default(null);
            $table->tinyInteger('mce_ds_said')->nullable(true)->default(null);
            $table->tinyInteger('mce_us_sid')->nullable(true)->default(null);
            $table->enum('mce_filt_dot1p',['YES','NO'])->nullable(true)->default(null);
            $table->enum('mce_filt_dot1q',['YES','NO'])->nullable(true)->default(null);
            $table->tinyInteger('mce_tetps')->nullable(true)->default(null);
            $table->tinyInteger('mce_ntet')->nullable(true)->default(null);
            $table->enum('mce_dcc',['YES','NO'])->nullable(true)->default(null);
            $table->dateTime('thetime')->nullable(true);
            $table->dateTime('offer_time')->nullable(true);
            $table->dateTime('ack_time')->nullable(true);
            $table->unsignedSmallInteger('net_id')->nullable(false)->default(0);
            $table->unsignedSmallInteger('cluster_id')->nullable(false)->default(0);
            $table->unsignedSmallInteger('ra_id')->nullable(false)->default(0);
            $table->string('vsi_devtype')->nullable(false)->default('');
            $table->string('vsi_esafetypes')->nullable(false)->default('');
            $table->string('vsi_serialno')->nullable(false)->default('');
            $table->string('vsi_hwver')->nullable(false)->default('');
            $table->string('vsi_swver')->nullable(false)->default('');
            $table->string('vsi_bootrom')->nullable(false)->default('');
            $table->string('vsi_oui')->nullable(false)->default('');
            $table->string('vsi_model')->nullable(false)->default('');
            $table->string('vsi_vendor')->nullable(false)->default('');
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
        Schema::dropIfExists('docsis_update');
    }
}
