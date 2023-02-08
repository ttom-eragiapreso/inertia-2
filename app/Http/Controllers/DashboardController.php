<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        $user_library = $user->albums;


       return Inertia::render('Dashboard', compact('user_library'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Get all the info from the clicked album - create a new instance of Album
        $album_info = $request->all();
        $new_album = new Album();
        // Populate the new album fields with the API data
        $new_album->title = getTitle($album_info['record']);
        $new_album->author = getAuthor($album_info['record']);
        $new_album->thumb = $album_info['record']['cover_image'];
        $new_album->release_year = $album_info['record']['year'];
        $new_album->country = $album_info['record']['country'];
        // Save the new album in DB
        $new_album->save();


        // If the genre already exists, I can attach it, but if it doesn't exist, I have to create it first to then attach it, otherwise I get an error where it's trying to use the value of the genre as the genre_id in the pivot.
        $genres = (array) Genre::all();

        // If the API response had genres, we use that info to populate the pivot table with the genres
        if(array_key_exists('genre',$album_info['record'])){
            foreach($album_info['record']['genre'] as $genre){
                if(in_array($genre, $genres)){
                    $new_album->genres()->attach($genre);
                }else {
                    $new_genre = new Genre();
                    $new_genre->name = $genre;
                    $new_genre->save();
                    $new_album->genres()->attach($new_genre->id);
                }
            }
        }
        // We do the same with styles, they are 2 separate fields on the API but I'm grouping them both under the Genre column.
        if(array_key_exists('style',$album_info['record'])){
            foreach($album_info['record']['style'] as $style){
                if(in_array($style, $genres)){
                    $new_album->genres()->attach($style);
                }else {
                    $new_genre = new Genre();
                    $new_genre->name = $style;
                    $new_genre->save();
                    $new_album->genres()->attach($new_genre->id);
                }
            }
        }

        $flash = [
            'message' => "The album $new_album->title by $new_album->author has been successfully added to your library.",
            'id' => $album_info['record']['id']
        ];

        return redirect()->back()->with($flash);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
