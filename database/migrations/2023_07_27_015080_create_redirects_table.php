<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRedirectsTable extends Migration
{
    public function up(): void
    {
        Schema::create('redirects', static function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_active')
                ->default(1);
            $table->string('type');
            $table->string('from');
            $table->string('to');
            $table->integer('sort')
                ->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('redirects');
    }
}
