<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    const
        Clients = "clients",
        BUSINESSES = " businesses",
        FAVORITES = "favorites",
        IMAGES = "images";

    const  CLIENT_ID = "client_id",
        BUSSINESS_ID = "businnes_id";

    /**
     * Run the migrations.
     */
    public function up(): void
    {
       self::createTables();
       self::createPolyTables();
    }

    public  function createPolyTables(){
       self::createPolyTable();
    }

    public  function createTables(){
        self::createClientsTable();
        self::createBusinessesTable();
        self::createFavoritesTable();
    }

    public function createClientsTable(){
            Schema::create(self::Clients , function (Blueprint $table){
               $table->id();
               $table->string("name");
               $table->string("email")->unique();
               $table->string("password");
               $table->boolean("active")->default(true);
            });
    }

    public function createBusinessesTable(){
        Schema::create(self::BUSINESSES , function (Blueprint $table){
            $table->id();
            $table->string("name");
            $table->string("email")->unique();
            $table->string("phone");
            $table->string("password");
            $table->boolean("active")->default(true);
        });
    }

    public function createFavoritesTable(){
        Schema::create(self::FAVORITES , function (Blueprint $table){
            $table->id();
            $table->foreignId(self::CLIENT_ID)->constrained(self::Clients);
            $table->foreignId(self::BUSSINESS_ID)->constrained(self::BUSINESSES);
        });
    }

    public function createPolyTable(){
        Schema::create(self::IMAGES , function (Blueprint $table){
            $table->id();
            $table->string("url" );
            $table->morphs("imageable");
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        $polyTables = [
            self::IMAGES
        ];

        $tables = [
            self::FAVORITES,
            self::BUSINESSES,
            self::Clients,
        ];
    }
};
