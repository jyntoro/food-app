<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\MealType;

class CreateMealTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('meals', function (Blueprint $table) {
            $table->foreignId('meal_type_id')->constrained();
        });

        $meal_types = [
            'Breakfast',
            'Brunch',
            'Lunch',
            'Dinner',
            'Supper',
            'Snack',
        ];

        foreach ($meal_types as $name) {
            MealType::create([
                'name' => $name,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumns('meals', ['meal_type_id']);
        Schema::dropIfExists('meal_types');
    }
}
