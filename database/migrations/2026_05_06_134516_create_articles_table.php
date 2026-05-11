<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('contenu');
            $table->enum('categorie', [
                'data',
                'cybersecurite',
                'reseau',
                'ia',
                'cloud',
                'developpement',
                'hardware'
            ]);
            $table->string('source')->nullable();
            $table->string('url_source')->nullable();
            $table->string('image')->nullable();
            $table->timestamp('publie_le')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
