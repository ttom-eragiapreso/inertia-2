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
        $user = auth()->user();
        // Get all the info from the clicked album
        $album_info = $request->all();

        // Find out if the album already exists.
        $album_exists = Album::where('discogs_id', $album_info['record']['id'])->first();


        if(is_null($album_exists)){
        // If it doesn't exist, we did as previously, so we create the album and attach all the genres and styles.
        $new_album = new Album();
        // Populate the new album fields with the API data
        $new_album->title = getTitle($album_info['record']);
        $new_album->author = getAuthor($album_info['record']);
        $new_album->thumb = $album_info['record']['cover_image'];
        $new_album->release_year = $album_info['record']['year'];
        $new_album->country = $album_info['record']['country'];
        // Save the new album in DB
        $new_album->save();


        $new_album->users()->attach($user->id);


        // If the genre already exists, I can attach it, but if it doesn't exist, I have to create it first to then attach it, otherwise I get an error where it's trying to use the value of the genre as the genre_id in the pivot.

        $genres =  Genre::all()->pluck('name')->toArray();

        // If the API response had genres, we use that info to populate the pivot table with the genres
        if(array_key_exists('genre',$album_info['record'])){
            foreach($album_info['record']['genre'] as $genre){
                if(in_array($genre, $genres)){
                    // If it exists, I have to find the id of that genre and then attach it.
                    $existingGenre = Genre::where('name', $genre)->first();
                    $new_album->genres()->attach($existingGenre);
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
                    $existingGenre = Genre::where('name', $style)->first();

                    $new_album->genres()->attach($existingGenre);
                }else {
                    $new_genre = new Genre();
                    $new_genre->name = $style;
                    $new_genre->save();
                    $new_album->genres()->attach($new_genre->id);
                }
            }
        }
        return redirect()->back();

        }elseif($album_exists->users->contains($user->id)) {
            // If the user already has that album saved, we just return back with a message;

            $message = "You already have $album_exists->title in your collection";
            return Inertia::render('Search', compact('message'));

        }else {
            // If the album already exists, but it's not already associated with that user we just have to attach that album to the logged user ID
            $album_exists->users()->attach($user->id);
            return redirect()->back();
        }

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

