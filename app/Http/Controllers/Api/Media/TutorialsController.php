<?php

namespace App\Http\Controllers\Api\Media;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tutorials\MediaResource;
use App\Http\Resources\Tutorials\TutorialResource;
use App\Models\Media;
use App\Models\Tutorial;
use Illuminate\Http\Request;

class TutorialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TutorialResource::collection(Tutorial::where('parent_id',0)->with('children')->paginate(25));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $tutorial = Tutorial::create([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'parent_id'=>$request->parent_id ?? 0
            ]);

            return new TutorialResource($tutorial);

        } catch(\Exception $exception) {
            return response([
                'status' => 'error',
                'message' => "Error: Media not created!, please try again. - {$exception->getMessage()}"
            ], 500);
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
        $tutorial = Tutorial::findOrfail($id);

        return new TutorialResource($tutorial);
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
