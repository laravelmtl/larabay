<?php

namespace App\Http\Controllers;

use App\Bid;
use App\Events\BidWasCreated;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Event;

class AppController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::with(['bids' => function($q) {
            $q->orderBy('created_at', 'desc');
        }])->whereSlug($slug)->first();

        return view('bid', compact('product'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $productId
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function bid($productId, Request $request)
    {

        $lastBid = Bid::whereProductId($productId)->orderBy('amount', 'desc')->first();

        if (isset($lastBid) and $request->get('amount') <= $lastBid->amount)
            return redirect('/'.$lastBid->product->slug)->with('errors', collect(['You must bid a higher amount, idiot...']));

        $bid = Bid::create($request->all());

        Event::fire(new BidWasCreated($bid));

        return redirect('/'.Product::find($productId)->slug)->with('success', collect(['Well done my friend, keep on bidding']));
    }


}
