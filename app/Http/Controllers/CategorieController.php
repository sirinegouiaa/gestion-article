<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $categories = Categorie::all(); //jibli tout les categorie 
            return response()->json($categories);

        }catch(\Exception $e) {
            return response()->json("probleme de recuperation ");

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) //post 
    {
        try{
            $categorie = new Categorie([
                "nomcategorie"=>$request->input("nomcategorie"),
                "imagecategorie"=>$request->input("imagecategorie")
            ]);
            $categorie->save();
            return response()->json($categorie);
        }
        catch(\Exception $e){
            return response()->json("insertion impossible ");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{
            $categorie=Categorie::findOrFail($id);
            return response()->json($categorie);
        }catch (\Exception $e){
            return response()->json("recuperation de categorie est impossible {$e->getMessage()}");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
            $categorie=Categorie::findOrFail($id);
            $categorie->update($request->all()); 
            return response()->json($categorie);
        }catch(\Exception $e){
            return response()->json($e->getMessage());  
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $categorie=Categorie::findOrFail($id);
            $categorie->delete();
            return response()->json("suppression reussie");

        }catch(\Exception $e){
            return response()->json("suppression de categorie est impossible ");
        }
    }
}
