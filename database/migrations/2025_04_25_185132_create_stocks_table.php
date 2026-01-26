<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('sid', 100)
                ->unique();
            $table->string('thumbnail')
                ->nullable();
            $table->text('images')
                ->nullable();
            $table->string('chassis');
            $table->foreignId('make_id')
                ->nullable()
                ->constrained('makes')
                ->onDelete('set null');
            $table->string('model', 100);
            $table->string('year', 4);
            $table->integer('fob');
            $table->integer('cnf')
                ->nullable();
            $table->foreignId('currency_id')
                ->default(1)
                ->nullable()
                ->constrained('currencies')
                ->onDelete('set null');
            $table->string('mileage');
            $table->string('doors', 4);
            $table->enum(
                'transmission',
                ['manual', 'automatic']
            );
            $table->foreignId('body_type_id')
                ->nullable()
                ->constrained('body_types')
                ->onDelete('set null');
            $table->enum(
                'fuel',
                ['diesel', 'petrol', 'electric', 'hybrid', 'gasoline']
            );
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->onDelete('set null');
            $table->foreignId('country_id')
                ->nullable()
                ->constrained('countries')
                ->onDelete('set null');
            $table->string('color')
                ->nullable();
            $table->text('features');
            $table->foreignId('customer_account_id')
                ->nullable()
                ->constrained('customer_accounts')
                ->onDelete('set null');
            $table->foreignId('agent_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
