<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $articles=Article::with("scategories")->get();
            return response()->json($articles);
        }catch(\Exception $e){
            return response()->json($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $article=new Article([
            "designation"=>$request->input("designation"),
            "reference"=>$request->input("reference"),
            "marque"=>$request->input("marque"),
            "prix"=>$request->input("prix"),
            "qtestock"=>$request->input("qtestock"),
            "imageart"=>$request->input("imageart"),
            "scategorieID"=>$request->input("scategorieID"),

            ]);
            $article->save();
            return response()->json($article);}
             catch (\Exception $e) {
                return response()->json("insertion impossible {$e->getMessage()}");
                }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $article=Article::with('scategorie')->findOrFail($id);
            return response()->json($article);
            } catch (\Exception $e) {
            return response()->json($e->getMessage(),$e->getCode());
            }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $article=Article::findorFail($id);
            $article->update($request->all());
            return response()->json($article);
            } catch (\Exception $e) {
            return response()->json($e->getMessage(),$e->getCode());
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $article=Article::findOrFail($id);
            $article->delete();
            return response()->json("Article supprimée avec succes");
            } catch (\Exception $e) {
            return response()->json("Suppression impossible {$e->getMessage()}");
            }
    }
    public function showArticlesBySCAT($idscat)
    {
        try{
            $articles = Article::where('scategorieID',$idscat)->with('scategorie')->get();
            return response()->json($articles);
        }catch(\Exception $e){
            return response()->json("selection impossible {$e->getMessage()}");
        }
    }

    public function paginationPaginate() 
{ 
$perPage = request()->input('pageSize', 2); // Récupère la valeur dynamique pour la pagination 
$articles = Article::with('scategories')->paginate($perPage); 
// Retourne le résultat en format JSON API 
return response()->json([ 
'products' => $articles->items(), // Les articles paginés 
'totalPages' =>  $articles->lastPage(), // Le nombre de pages 
              ]); 
    } 
 

}
