<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RadioSponsorshipProgram;
use App\Models\RadioSponsorshipOrder;
use App\Http\Resources\SponsorshipProgramResource;
use App\Http\Resources\ProgramTimeResource;
use App\Http\Requests\RadioSponsorshipOrderRequest;
use Auth;
use App\Helpers\ListHelper;

class RadioSponsorshipController extends Controller
{
    public function sponsorship_programs($radio_id)
    {
        $programs = RadioSponsorshipProgram::where('radio_id',$radio_id)->with('domain')->get();

        return response()->json([
            'programs' => SponsorshipProgramResource::collection($programs),
        ]);

    }

    public function sponsorship_details($program_id)
    {
        $program = RadioSponsorshipProgram::find($program_id);

        return response()->json([
            'times' => ProgramTimeResource::collection($program->times),
            'price' => $program->sponsorship_price
        ]);
    }

    public function set_sponsorship_order(RadioSponsorshipOrderRequest $request)
    {
        $user = Auth::user();
        $price =  RadioSponsorshipProgram::find($request->sponsorship_program_id)->sponsorship_price * $request->period;
        $order = ListHelper::create_update_order($user->id, $price);

        $radio_order = ListHelper::create_radio_order($order->id,3, $request->radio_id);

        $sponsorship_order = new RadioSponsorshipOrder;
        $sponsorship_order->sponsorship_program_id = $request->sponsorship_program_id;
        $sponsorship_order->date = $request->date;
        $sponsorship_order->price = $price;
        $sponsorship_order->period = $request->period;
        $sponsorship_order->notes = $request->notes;
        $sponsorship_order->radio_order_id = $radio_order->id;
        $sponsorship_order->save();

        return response()->json([
            'status' => 'success',
            'message' => trans('messages.added_successfully'),
        ]);
    }
}
