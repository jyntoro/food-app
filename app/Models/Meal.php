<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use App\Models\MealType;
use App\Models\User;

class Meal extends Model
{
    use HasFactory;

    public function meal_type() {
        return $this->belongsTo(MealType::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
