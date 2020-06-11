<?php

namespace App\Http\Controllers;

use App\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create-offers', ['only' => ['create', 'store']]);
        $this->middleware('permission:read-offers'  , ['only' => ['index']]);
        $this->middleware('permission:update-offers', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-offers', ['only' => ['destroy','destroySelecteds']]);

    }

    public function index()
    {
        $offers = Offer::where('parent_id',null)->orderBy('id','desc')->get();
        return view('admin.offers.index',compact('offers'));

    }


    public function create()
    {
        return view('admin.offers.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'string|nullable',
            'media' => 'required',
        ]);

        $offer = new Offer();
        $offer->title = $request->title;
        $offer->text = $request->text;
        $offer->order = getLastOrder('offers');
        $offer->target = $request->target;
        $offer->status = $request->status?true:false;
        $offer->author_id = user()->id;
        $offer->save();

        foreach($request->media as $order => $media_id){
            $subOffer = new Offer();
            $subOffer->parent_id = $offer->id;
            $subOffer->media_id = $media_id;
            $subOffer->order = $order;
            $subOffer->title = $request->mediaTitles[$media_id]??'';
            $subOffer->text = $request->mediaTexts[$media_id]??'';
            $subOffer->target = null;
            $subOffer->author_id = user()->id;
            $subOffer->save();
        }


        $data = [
            'status'    => 'success',
            'message'   => "Offer <code>#{$offer->id}</code> is created successfully"
        ];
        return response()->json($data,200);
    }


    public function show()
    {
        //
    }


    public function edit(Offer $offer)
    {

        $subOffers = Offer::where('parent_id',$offer->id)->get();
        return view('admin.offers.edit')->with(compact('offer','subOffers'));
    }


    public function update(Request $request,Offer $offer)
    {
        $request->validate([
            'title' => 'string|nullable',
            'media' => 'required',
        ]);


        $offer->title = $request->title;
        $offer->target = $request->target;
        $offer->status = $request->status?true:false;
        $offer->save();

        $subOffers = Offer::where('parent_id',$offer->id)->get();
        foreach ($subOffers as $subOffer){
            $subOffer->delete();
        }
        foreach($request->media as $order => $media_id){
            $subOffer = new Offer();
            $subOffer->parent_id = $offer->id;
            $subOffer->media_id = $media_id;
            $subOffer->order = $order;
            $subOffer->title = $request->mediaTitles[$media_id]??'';
            $subOffer->text = $request->mediaTexts[$media_id]??'';
            $subOffer->target = null;
            $subOffer->author_id = user()->id;
            $subOffer->save();
        }


        $data = [
            'status'    => 'success',
            'message'   => "Offer <code>#{$offer->id}</code> is updated successfully"
        ];
        return response()->json($data,200);
    }


    public function destroy(Offer $offer)
    {
        $offer->delete();

        $data = [
            'status'    => 'success',
            'message'   => "Offer - <span class='font-weight-semibold'>#{$offer->id}</span> is deleted successfully!"
        ];
        return response()->json($data,200);
    }

    public function destroySelecteds(Request $request)
    {
        foreach ($request->selecteds as $selected) {
            $deleteData = Offer::findOrFail($selected);
            $deleteData->delete();
        }

        $data = [
            'status'    => 'success',
            'message'   => "Selected <span class='font-weight-semibold'>offers</span> are deleted successfully!"
        ];
        return response()->json($data,200);
    }
}
