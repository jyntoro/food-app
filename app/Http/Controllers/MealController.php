<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use App\Models\MealType;
use Illuminate\Support\Facades\Auth;

class MealController extends Controller
{
    public function index() {
        
        return view('meal.index', [
            'meals' => Meal::join('meal_types', 'meal_types.id', '=', 'meals.meal_type_id')
            ->join('users', 'users.id', '=', 'meals.user_id')
            ->with(['meal_type', 'user'])
            ->when(!Auth::user()->isAdmin(), function($query) {
                return $query->where('users.email', '=', Auth::user()->email);
            })
            ->orderBy('meals.created_at', 'desc')
            ->select('*', 'meals.id as id', 'meals.name as name', 'meals.created_at as created_at')
            ->get()
        ]);
    }

    public function create() {
        return view('meal.create', [
            'meal_types' => MealType::all()
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:50',
            'meal_type' => 'required|exists:meal_types,id',
        ]);

        $meal = new Meal();
        $meal->name = $request->input('name');
        $meal->meal_type_id = $request->input('meal_type');
        $meal->user_id = Auth::user()->id;
        $meal->save();

        return redirect()->route('meal.index')
            ->with('success', "You have successfully added {$request->input('name')}");
    }

    public function edit($id) {

        $meal = Meal::find($id);

        if (!$meal) {
            return redirect()->route('meal.index');
        }

        return view('meal.edit', [
            'meal_types' => MealType::all(),
            'meal' => $meal,
        ]);

    }

    public function update($id, Request $request) {
        $request->validate([
            'name' => 'required|max:50',
            'meal_type' => 'required|exists:meal_types,id',
        ]);

        $meal = Meal::where('id', '=', $id)->first();
        $meal->name = $request->input('name');
        $meal->meal_type_id = $request->input('meal_type');        
        $meal->is_favorite = $request->input('favorite');
        if (!$request->input('favorite')) {
            $meal->is_favorite = false;
        } 

        $meal->save();

        return redirect()
        ->route('meal.edit', [ 'id' => $id ])
        ->with('success', "You have successfully updated {$request->input('name')}");
    }

    public function deleteForm($id) {
        
        $meal = Meal::find($id);

        if (!$meal) {
            return redirect()->route('meal.index');
        }

        return view('meal.delete', [ 
            'id' => $id, 
            'meal' => $meal
        ]);
    }

    public function delete($id) {

        $meal = Meal::find($id);
        $meal->delete();

        return redirect()->route('meal.index')
            ->with('success', "You have successfully deleted {$meal->name}");
        
    }

}
