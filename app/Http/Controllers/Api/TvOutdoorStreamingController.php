<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TvChannel;
use App\Models\TvOutdoorStreamingOrder;
use App\Http\Requests\TvOutdoorStreamingOrderRequest;
use Auth;
use App\Helpers\ListHelper;

class TvOutdoorStreamingController extends Controller
{
    public function outdoor_streaming_details($channel_id)
    {
        $channel = TvChannel::find($channel_id);

        return response()->json([
            'price_30_minutes' => $channel->outdoor_straeming_30,
            'price_60_minutes' => $channel->outdoor_straeming_60,
        ]);
    }

    public function set_outdoor_streaming_order(TvOutdoorStreamingOrderRequest $request)
    {
        $user = Auth::user();
        $tv_channel = TvChannel::find($request->tv_channel_id);
        $price =  $request->period == 30 ? $tv_channel->outdoor_straeming_30 : $tv_channel->outdoor_straeming_60;
        $order = ListHelper::create_update_order($user->id, $price);

        $tv_order = ListHelper::create_tv_order($order->id,11, $request->tv_channel_id);

        $streaming_order = new TvOutdoorStreamingOrder;
        $streaming_order->date = $request->date;
        $streaming_order->period = $request->period;
        $streaming_order->presenter_type = $request->presenter_type;
        $streaming_order->price = $price;
        $streaming_order->notes = $request->notes;
        $streaming_order->tv_order_id = $tv_order->id;
        $streaming_order->save();

        return response()->json([
            'status' => 'success',
            'message' => trans('messages.added_successfully'),
        ]);
    }
}
