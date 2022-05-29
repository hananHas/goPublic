<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Radio;
use App\Models\RadioRecordingOrder;
use App\Http\Requests\RadioRecordingOrderRequest;
use Auth;
use App\Helpers\ListHelper;

class RadioRecordingController extends Controller
{
    public function radio_recording_details($radio_id)
    {
        $price = Radio::find($radio_id)->recording_price;
        return response()->json([
            'price' => $price
        ]);
        
    }

    public function set_recording_order(RadioRecordingOrderRequest $request)
    {
        $user = Auth::user();
        $price =  Radio::find($request->radio_id)->recording_price * $request->presenters_num;
        $order = ListHelper::create_update_order($user->id, $price);

        $radio_order = ListHelper::create_radio_order($order->id,4, $request->radio_id);

        $sponsorship_order = new RadioRecordingOrder;
        $sponsorship_order->type = $request->type;
        $sponsorship_order->presenters_num = $request->presenters_num;
        $sponsorship_order->price = $price;
        $sponsorship_order->notes = $request->notes;
        $sponsorship_order->radio_order_id = $radio_order->id;
        $sponsorship_order->save();

        return response()->json([
            'status' => 'success',
            'message' => trans('messages.added_successfully'),
        ]);
    }
}
