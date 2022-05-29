<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Radio;
use App\Models\RadioOutdoorStreamingOrder;
use Auth;
use App\Helpers\ListHelper;
use App\Http\Requests\RadioOutdoorStreamingOrderRequest;

class RadioOutdoorStreamingController extends Controller
{
    public function outdoor_streaming_details($radio_id)
    {
        $radio = Radio::find($radio_id);

        return response()->json([
            'price_30_minutes' => $radio->outdoor_straeming_30,
            'price_60_minutes' => $radio->outdoor_straeming_60,
        ]);
    }

    public function set_outdoor_streaming_order(RadioOutdoorStreamingOrderRequest $request)
    {
        $user = Auth::user();
        $radio = Radio::find($request->radio_id);
        $price =  $request->period == 30 ? $radio->outdoor_straeming_30 : $radio->outdoor_straeming_60;
        $order = ListHelper::create_update_order($user->id, $price);

        $radio_order = ListHelper::create_radio_order($order->id,5, $request->radio_id);

        $streaming_order = new RadioOutdoorStreamingOrder;
        $streaming_order->date = $request->date;
        $streaming_order->period = $request->period;
        $streaming_order->presenter_type = $request->presenter_type;
        $streaming_order->price = $price;
        $streaming_order->notes = $request->notes;
        $streaming_order->radio_order_id = $radio_order->id;
        $streaming_order->save();

        return response()->json([
            'status' => 'success',
            'message' => trans('messages.added_successfully'),
        ]);
    }
}
