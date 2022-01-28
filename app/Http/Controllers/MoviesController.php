<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;

class MoviesController extends Controller
{

    /**
     * GET
     * URI: /api/movies
     */
    public function index(Request $request)
    {
        $movies = Movie::all();

        if (!$movies) {
            return response()->json(['result' => 'No movies exist'], 404);
        }

        return response()->json($movies, 200);
    }


    /**
     * GET
     * URI: /api/movies/{movie_id}
     * @param $movie_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($movie_id)
    {
        $movie = Movie::find($movie_id);

        if (!$movie) {
            return response()->json(['result' => 'No movie under this ID'], 404);
        }

        return response()->json($movie, 200);
    }


    /**
     * POST
     * URI: /api/movie
     * @param Movie $movie
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $movie)
    {

        //This is assuming a user will need to be logged in in order to create a movie record
//        if(!Auth::check()){
//            return response()->json([ 'result' => 'User not authenticated'], 401);
//        }


        //create movie with request parameters
        Movie::create($movie->all());


        $new_movie = Movie::all()->last();

        return response()->json($new_movie, 200);
    }


    /**
     * PUT
     * URI: /api/movies/{movie}
     * @param Movie $request
     * @param $movie
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Movie $request, $movie_to_update)
    {
        //This is assuming a user will need to be logged in in order to update a movie record
//        if(!Auth::check()){
//            return response()->json([ 'result' => 'User not authenticated'], 401);
//        }

        $movie = Movie::findOrFail($movie_to_update);


        if (!$movie) {
            return response()->json(['result' => 'This movie does not exist'], 404);
        }

        $movie->update($request->all());

        return response()->json($movie, 200);
    }


    /**
     * DELETE
     * URI: /api/movies/{movie}
     * @param Movie $request
     * @param $movie
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Movie $request, $movie_to_delete)
    {

        //This is assuming a user will need to be logged in in order to delete a book request record
//        if(!Auth::check()){
//            return response()->json([ 'result' => 'User not authenticated'], 401);
//        }

        $movie = Movie::findOrFail($movie_to_delete);

        if (!$movie) {
            return response()->json(['result' => 'This movie does not exist'], 404);
        }

        $movie->delete();

        return response()->json(['result' => 'Movie deleted successfully'], 204);
    }



}
