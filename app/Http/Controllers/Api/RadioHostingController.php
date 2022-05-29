<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Radio;
use App\Models\RadioProgram;
use App\Models\RadioProgramTime;
use App\Models\RadioHostingOrder;
use App\Http\Resources\RadioResource;
use App\Http\Resources\LightProgramResource;
use App\Http\Resources\ProgramResource;
use App\Http\Resources\ProgramTimeResource;
use App\Http\Resources\ProgramDetailsResource;
use App\Http\Requests\RadioHostingOrderRequest;
use Auth;
use App\Helpers\ListHelper;

class RadioHostingController extends Controller
{
    public function browse_radio($radio_id)
    {
        $radio = Radio::find($radio_id);
        $programs = RadioProgram::where('radio_id',$radio->id)->get();
        
        return response()->json([
            'radio' => new RadioResource($radio),
            'programs' => LightProgramResource::collection($programs),
        ]);
    }

    public function radio_programs($radio_id)
    {
        $programs = RadioProgram::where('radio_id',$radio_id)->get();

        return response()->json([
            'programs' => ProgramResource::collection($programs),
        ]);
    }

    public function program_details($program_id)
    {
        $program = RadioProgram::find($program_id);
        return response()->json([
            'program' => new ProgramDetailsResource($program),
        ]);
    }

    public function program_hosting_details($program_id)
    {
        $program = RadioProgram::find($program_id);

        return response()->json([
            'times' => ProgramTimeResource::collection($program->times),
            'price' => $program->hosting_price
        ]);
    }


    public function set_hosting_order(RadioHostingOrderRequest $request)
    {
        $user = Auth::user();

        $hosting_price = RadioProgram::find($request->program_id)->hosting_price;
        $price = $hosting_price * $request->hosting_period;
        
        $order = ListHelper::create_update_order($user->id, $price);

        $radio_order = ListHelper::create_radio_order($order->id, 2, $request->radio_id);

        $hosting_order = new RadioHostingOrder;
        $hosting_order->program_id = $request->program_id;
        $hosting_order->hosting_date = $request->hosting_date;
        $hosting_order->hosting_period = $request->hosting_period;
        $hosting_order->price = $price;
        $hosting_order->notes = $request->notes;
        $hosting_order->radio_order_id = $radio_order->id;
        $hosting_order->save();

        return response()->json([
            'status' => 'success',
            'message' => trans('messages.added_successfully'),
        ]);
    }
}
