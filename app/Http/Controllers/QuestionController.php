<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Country;
use App\User;
use App\Http\Requests\QuestionStoreRequest;
use App\Http\Resources\Question as QuestionResource;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  App\Http\Requests\QuestionStoreRequest  $request
     * @return App\Http\Resources\Question
     */
    public function store(QuestionStoreRequest $request)
    {
        // Prepare a new question data to store
        $aQuestionData['text'] = $request->text;
        $aQuestionData['user_id'] = User::where('email', $request->email)->firstOrFail()->id;
        $aQuestionData['country_id'] = Country::where('name', $request->country)->firstOrFail()->id;

        // Store the question
        $oQuestion = Question::create($aQuestionData);

        return new QuestionResource($oQuestion);
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
