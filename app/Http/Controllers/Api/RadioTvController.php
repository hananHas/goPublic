<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RadioTvBanner;
use App\Models\RadioTvOrder;
use App\Http\Resources\BannersResource;
use App\Http\Requests\RadioTvPriceRequest;
use App\Http\Requests\RadioTvOrderRequest;
use Carbon\Carbon;
use Auth;
use App\Helpers\ListHelper;

class RadioTvController extends Controller
{
    public function radio_tv_details($radio_id)
    {
        $banners = RadioTvBanner::where('radio_id',$radio_id)->get();

        return response()->json([
            'banners' => BannersResource::collection($banners),
        ]);

    }

    public function radio_tv_get_price(RadioTvPriceRequest $request)
    {
        $banner_price = RadioTvBanner::find($request->radio_tv_banner_id)->price;

        // find days number between two dates
        $end_date = Carbon::createFromFormat('Y-m-d', $request->end_date);
        $start_date = Carbon::createFromFormat('Y-m-d', $request->start_date);

        $duration = $end_date->diffInDays($start_date) + 1;
        
        $price = $banner_price * $duration;
        

        return response()->json([
            'price' => $price
        ]);
        
    }

    public function set_tv_order(RadioTvOrderRequest $request)
    {
        $user = Auth::user();
        $price = $this->radio_tv_get_price(new RadioTvPriceRequest($request->toArray()))->getData()->price;
        $order = ListHelper::create_update_order($user->id, $price);

        $radio_order = ListHelper::create_radio_order($order->id, 6, $request->radio_id);
        
        $tv_order = new RadioTvOrder;
        $tv_order->start_date = $request->start_date;
        $tv_order->end_date = $request->end_date;
        $tv_order->radio_tv_banner_id = $request->radio_tv_banner_id;
        $tv_order->price = $price;
        $tv_order->notes = $request->notes;
        $tv_order->radio_order_id = $radio_order->id;
        $tv_order->save();

        return response()->json([
            'status' => 'success',
            'message' => trans('messages.added_successfully'),
        ]);
        
    }
}
