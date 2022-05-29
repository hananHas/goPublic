<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RadioProgram;
use App\Models\RadioQuickNewsOrder;
use App\Http\Resources\ProgramTimeResource;
use App\Http\Requests\RadioQuickNewsOrderRequest;
use Auth;
use App\Helpers\ListHelper;

class RadioQuickNewsController extends Controller
{
    public function quick_news_details($program_id)
    {
        $program = RadioProgram::find($program_id);

        return response()->json([
            'times' => ProgramTimeResource::collection($program->times),
            'price' => $program->quick_news_price,
        ]);
    }

    public function set_quick_news_order(RadioQuickNewsOrderRequest $request)
    {
        $user = Auth::user();
        $price =  RadioProgram::find($request->program_id)->quick_news_price;
        $order = ListHelper::create_update_order($user->id, $price);

        $radio_order = ListHelper::create_radio_order($order->id,7, $request->radio_id);

        $news_order = new RadioQuickNewsOrder;
        $news_order->program_id = $request->program_id;
        $news_order->date = $request->date;
        $news_order->price = $price;
        $news_order->notes = $request->notes;
        $news_order->radio_order_id = $radio_order->id;
        $news_order->save();

        return response()->json([
            'status' => 'success',
            'message' => trans('messages.added_successfully'),
        ]);
    }
}
