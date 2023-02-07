<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;


class PageController extends Controller
{
    public function search(){
        return Inertia::render('Search');
    }

    public function searchApi(Request $request){

         $data = $request->validate([
            "artist" => "nullable|min:1|max:100",
            "release_title" => "nullable|min:1|max:100"
            ]);

          // Basic information about the API
          $baseUrl = 'https://api.discogs.com/database/search?';
          $token = 'HWiFdStcHwaqgBqEAoEjjvCFhQUNnZHqZFuelXuZ';
          // Information about the researched params
          $artist = request('artist');
          $release_title = request('release_title');

          // Options encapsulation in a context
          $context = get_ctx();

          // Make the call and save the results in response.
          $response = json_decode(file_get_contents("$baseUrl" . "token=$token" . "&artist=$artist" . "&release_title=$release_title" . "&per_page=48",false, $context), true);

          // I then save the pagination and the actual results in 2 different variables
          $pagination = $response['pagination'] ?? null;
          $results = $response['results'] ?? null;
          // Finally I return an Inertia view which loads a vue component with the props containing the results.
          return Inertia::render('Search', compact('pagination', 'results', 'artist', 'release_title'));
    }

    public function pagination(Request $request){

        $url = $request->input('link');

        $context = get_ctx();

        // Make the call and save the results in response.
        $response = json_decode(file_get_contents($url, false, $context), true);

        // I then save the pagination and the actual results in 2 different variables
        $pagination = $response['pagination'] ?? null;
        $results = $response['results'] ?? null;

        return Inertia::render('Search', compact('pagination', 'results'));

    }
}
