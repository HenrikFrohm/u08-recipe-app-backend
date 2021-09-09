<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()) {
            $recipe_lists = RecipeList::all()->toArray();
            return $recipe_lists;
        } else {
            return response()->json([
                'success' => false,
                'message' => "No recipe lists was found",
            ]);
        }
    }

    public function get($id)
    {
        if (auth()->user()) {
            $recipe_list = RecipeList::find($id);
            return $recipe_list;
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Recipe list do not exist'
            ]);
        }
    }

     public function store(Request $request)
     {
        $input = $request->all();
        if(auth()->user()) {
            $list = RecipeList::create(['title' => $request->input('title'), 'user_id' => auth()->user()->id]);
            return response()->json([
                'success' => true,
                'recipeList' => $list
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Recipe list can not be added'
            ]);
        }
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RecipeList  $recipelist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(auth()->user()) {
            $recipeList = RecipeList::find($id);
            $recipeList->update($request->all());
            return $recipeList;
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Recipe list did not get updated'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()) {
            $list = RecipeList::find($id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Recipe list was removed',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Recipe list did not get removed'
            ]);
        }
    }
}
