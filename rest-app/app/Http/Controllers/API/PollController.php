<?php

namespace App\Http\Controllers\API;

use App\Models\Poll;
use App\Http\Requests\PollRequest;
use App\Http\Resources\PollResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Poll::get(), 200);
        // 200 means everything is fine

        // Paginate
        // return response()->json(Poll::paginate(3), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PollRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PollRequest $request)
    {
        $poll = Poll::create($request->validated());

        return response()->json($poll, 201);
        // 201 means the request created a new resource.
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function show(Poll $poll)
    {
        return response()->json(new PollResource($poll), 200);
        // 200 means everything is fine

        // Nested Loading
        // $poll = Poll::with('questions')->whereId($poll->id)->first();
        // return response()->json($poll, 200);

        // Side Loading
        // $poll = ['poll' => $poll, 'questions' => $poll->questions];
        // return response()->json($poll, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PollRequest  $request
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function update(PollRequest $request, Poll $poll)
    {
        $poll->update($request->validated());

        return response()->json($poll, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poll $poll)
    {
        $poll->delete();

        return response()->json(null, 204);
        // 204 is the status code for no response.
    }

    /**
     * Get all questions of a specified resource poll.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Poll $poll
     *
     * @return \Illuminate\Http\Response
     */
    public function questions(Request $request, Poll $poll)
    {
        return response()->json($poll->questions, 200);
    }

    /**
     * Get error for any kind of request.
     *
     * @return \Illuminate\Http\Response
     */
    public function errors()
    {
        return response()->json(['msg' => 'Payment is required'], 501);
        // 501 is the error code when the server doesn't implement the code needed to fulfill the request.
        // You request to do something but the server doesn't know how to do.
    }
}
