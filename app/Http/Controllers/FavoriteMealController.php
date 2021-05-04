<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use Illuminate\Support\Facades\Auth;

class FavoriteMealController extends Controller
{
    public function index() {

        return view('favorite.index', [
            'meals' => Meal::join('meal_types', 'meal_types.id', '=', 'meals.meal_type_id')
            ->join('users', 'users.id', '=', 'meals.user_id')
            ->with(['meal_type', 'user'])
            ->when(!Auth::user()->isAdmin(), function($query) {
                return $query->where('users.email', '=', Auth::user()->email);
            })
            ->where('is_favorite', '=', 'true')
            ->orderBy('meals.favorited_at', 'desc')
            ->select('*', 'meals.id as id', 'meals.name as name')
            ->get()
        ]);
    }

    public function create($id) {
        return redirect()->route('favorite.store', [ 'id' => $id ]);
    }

    public function store($id) {
        $meal = Meal::find($id);
        
        if (!$meal) {
            return redirect()->route('favorite.index');
        }

        $meal->is_favorite = true;
        $meal->favorited_at = now();
        $meal->save();

        return redirect()->route('favorite.index')
            ->with('success', "You have successfully added {$meal->name} to your favorites list");
    }

    public function deleteForm($id) {
        $meal = Meal::find($id);
        
        if (!$meal) {
            return redirect()->route('meal.index');
        }

        return view('favorite.delete', [ 
            'id' => $id, 
            'meal' => $meal 
        ]);
    }

    public function delete($id) {
        $meal = Meal::find($id);
        $meal->is_favorite = false;
        $meal->save();

        return redirect()->route('favorite.index')
            ->with('success', "You have successfully removed {$meal->name} from your favorites list");
    }
}
