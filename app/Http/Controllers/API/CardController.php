<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreCardRequest;
use App\Http\Requests\UpdateCardRequest;
use App\Http\Resources\CardResource;
use App\Models\Card;

use Illuminate\Http\Request;

class CardController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date = $request->query("date");
        $status = $request->query("status");


        $cards = Card::all()
            ->when($date, fn ($query, $date) => $query->where("created_at", '>', $date))
            ->when(
                $status,
                function ($query, $status) {
                    $status= $status==="true"? true:false;
                    return $query->where('status' , $status);
                }
            );
        return $this->sendResponse(CardResource::collection($cards), "retrieved successufully");
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCardRequest $request)
    {
        $validated = $request->validated();
        $card = Card::create($validated);
        return $this->sendResponse(new CardResource($card), "created successufully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
        return $this->sendResponse(new CardResource($card), "retrieved successufully");
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCardRequest  $request
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCardRequest $request, Card $card)
    {
        $validated = $request->validated();
        $card->update($validated);
        return $this->sendResponse(new CardResource($card), "updated successufully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
        $card->delete();
        return  $this->sendResponse([], "deleted Successfully");
    }
}
