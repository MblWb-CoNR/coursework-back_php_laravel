<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Базовые услуги
        DB::table('services')->insert([
            ['name' => 'Консультация', 'description' => 'Предварительная консультация по дизайну', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Татуировка', 'description' => 'Нанесение татуировки', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Перекрытие', 'description' => 'Перекрытие старой татуировки', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Коррекция', 'description' => 'Коррекция существующей татуировки', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
};
