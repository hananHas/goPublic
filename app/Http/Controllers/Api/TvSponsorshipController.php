<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TvProgram;
use App\Models\TvSponsorshipOrder;
use App\Http\Resources\ProgramResource;
use App\Http\Resources\ProgramTimeResource;
use App\Http\Requests\TvSponsorshipOrderRequest;
use Auth;
use App\Helpers\ListHelper;

class TvSponsorshipController extends Controller
{
    public function sponsorship_programs($channel_id)
    {
        $programs = TvProgram::where('tv_channel_id',$channel_id)->with('domain')->get();

        return response()->json([
            'programs' => ProgramResource::collection($programs),
        ]);

    }

    public function sponsorship_details($program_id)
    {
        $program = TvProgram::find($program_id);

        return response()->json([
            'times' => ProgramTimeResource::collection($program->times),
            'price' => $program->sponsorship_price
        ]);
    }

    public function set_sponsorship_order(TvSponsorshipOrderRequest $request)
    {
        $user = Auth::user();
        $price =  TvProgram::find($request->program_id)->sponsorship_price * $request->period;
        $order = ListHelper::create_update_order($user->id, $price);

        $tv_order = ListHelper::create_tv_order($order->id,10, $request->tv_channel_id);

        $sponsorship_order = new TvSponsorshipOrder;
        $sponsorship_order->program_id = $request->program_id;
        $sponsorship_order->date = $request->date;
        $sponsorship_order->price = $price;
        $sponsorship_order->period = $request->period;
        $sponsorship_order->notes = $request->notes;
        $sponsorship_order->tv_order_id = $tv_order->id;
        $sponsorship_order->save();

        return response()->json([
            'status' => 'success',
            'message' => trans('messages.added_successfully'),
        ]);
    }
}
