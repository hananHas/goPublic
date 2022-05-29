<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TvChannel;
use App\Models\TvProgram;
use App\Models\TvHostingOrder;
use App\Http\Resources\TvChannelResource;
use App\Http\Resources\LightProgramResource;
use App\Http\Resources\ProgramResource;
use App\Http\Resources\ProgramDetailsResource;
use App\Http\Resources\ProgramTimeResource;
use App\Http\Requests\TvHostingOrderRequest;
use Auth;
use App\Helpers\ListHelper;

class TvHostingController extends Controller
{
    public function browse_tv_channel($channel_id)
    {
        $channel = TvChannel::find($channel_id);
        $programs = TvProgram::where('tv_channel_id',$channel->id)->where('is_program' ,1)->get();
        $series = TvProgram::where('tv_channel_id',$channel->id)->where('is_program' ,0)->get();
        
        return response()->json([
            'channel' => new TvChannelResource($channel),
            'programs' => LightProgramResource::collection($programs),
            'series' => LightProgramResource::collection($series),
        ]);
    }

    public function tv_programs($channel_id)
    {
        $programs = TvProgram::where('tv_channel_id',$channel_id)->where('is_program' ,1)->get();

        return response()->json([
            'programs' => ProgramResource::collection($programs),
        ]);
    }

    public function program_details($program_id)
    {
        $program = TvProgram::find($program_id);
        return response()->json([
            'program' => new ProgramDetailsResource($program),
        ]);
    }

    public function program_hosting_details($program_id)
    {
        $program = TvProgram::find($program_id);

        return response()->json([
            'times' => ProgramTimeResource::collection($program->times),
            'price' => $program->hosting_price
        ]);
    }

    public function set_hosting_order(TvHostingOrderRequest $request)
    {
        $user = Auth::user();

        $hosting_price = TvProgram::find($request->program_id)->hosting_price;
        $price = $hosting_price * $request->hosting_period;
        
        $order = ListHelper::create_update_order($user->id, $price);

        $tv_order = ListHelper::create_tv_order($order->id, 9, $request->tv_channel_id);

        $hosting_order = new TvHostingOrder;
        $hosting_order->program_id = $request->program_id;
        $hosting_order->hosting_date = $request->hosting_date;
        $hosting_order->hosting_period = $request->hosting_period;
        $hosting_order->price = $price;
        $hosting_order->notes = $request->notes;
        $hosting_order->tv_order_id = $tv_order->id;
        $hosting_order->save();

        return response()->json([
            'status' => 'success',
            'message' => trans('messages.added_successfully'),
        ]);
    }
}
