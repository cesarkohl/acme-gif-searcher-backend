<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $request->validate([
            'keyword' => 'required',
        ]);

        $search = new Search([
            'user_id' => Auth::user()->id,
            'keyword' => $request->keyword
        ]);

        $search->save();

        $client = new \GuzzleHttp\Client();
        $request = $client->get(
            config('services.tenor.uri') .
            "search?key=" . config('services.tenor.key') .
            "&q=" . $request->keyword);

        $resultsParsed = [];
        foreach (json_decode($request->getBody()->getContents())->results as $result)
            $resultsParsed[] = $result->media[0]->gif->url;

        return json_encode($resultsParsed);
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
        //
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

    /**
     * Get historic of search requests by user_id
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getByUserId()
    {
        $searches = Search::where('user_id', Auth::user()->id)->get();
        return response()->json($searches);
    }
}
