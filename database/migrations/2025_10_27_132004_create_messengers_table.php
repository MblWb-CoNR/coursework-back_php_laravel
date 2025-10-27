<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('messengers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('messengers')->insert([
            ['name' => 'Telegram', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'WhatsApp', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Viber', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Instagram', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('messengers');
    }
};
