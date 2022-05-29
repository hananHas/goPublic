<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Time;
use App\Models\TvTime;
use App\Models\TvTimePrice;
use App\Models\TvNarrationOrder;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\ChannelResource;
use App\Http\Resources\TVTimeResource;
use App\Http\Requests\TvNarrationsTimesRequest;
use App\Http\Requests\TvNarrationOrderRequest;
use Carbon\Carbon;
use Auth;
use App\Helpers\ListHelper;

class TvNarrationsController extends Controller
{
    public function tv_services()
    {
        $services = Service::where('type','tv')->get();
        return response()->json([
            'services' => ServiceResource::collection($services)
        ]);
    }

    public function get_service_channels($service_id)
    {
        $channels = Service::find($service_id)->channels;
        return response()->json([
            'channels' => ChannelResource::collection($channels)
        ]);
    }

    public function tv_narrations($channel_id)
    {
        $times = Time::where('type','tv')->with(['tvhours'=> function($q)use($channel_id){
            $q->where('tv_channel_id' , $channel_id);
        }])->get();

        // return $times;

        return response()->json([
            'times' => TVTimeResource::collection($times),
        ]);
    }

    public function narrations_select_times(TvNarrationsTimesRequest $request)
    {
        $tv_time = TvTime::where('time_id',$request->time_id)->where('tv_channel_id',$request->tv_channel_id)->first();
   
        
        if($request->period <= 30){
            // price if narration period under 30 (each 5 seconds has different price)
            if($request->show_timing == 'within'){
                $price = TvTimePrice::where('tv_time_id',$tv_time->id)->where('period',$request->period)
                ->first()->price_within;
            }else{
                $price = TvTimePrice::where('tv_time_id',$tv_time->id)->where('period',$request->period)
                ->first()->price_before;
            }
        }else{
            // price if narration period above 60 (each 5 seconds after 60 has same value added to price)
            $price_above = TvTimePrice::where('tv_time_id',$tv_time->id)->whereIn('period',[30 , 35])->get();
            if($request->show_timing == 'within'){
                $price_30 = $price_above->where('period',30)->first()->price_within;
                $price_additional = $price_above->where('period',35)->first()->price_within;
            }else{
                $price_30 = $price_above->where('period',30)->first()->price_before;
                $price_additional = $price_above->where('period',35)->first()->price_before;
            }
            
            $price_by_period = (($request->period - 30) / 5 ) * $price_additional;
            $price = $price_30 + $price_by_period;
        }
        //price with narrations number per day 
        $price_with_repetition = $price * $request->narrations_per_day;

        // find days number between two dates
        $end_date = Carbon::createFromFormat('Y-m-d', $request->end_date);
        $start_date = Carbon::createFromFormat('Y-m-d', $request->start_date);

        $campaign_duration = $end_date->diffInDays($start_date) + 1;
        
        $final_price = $price_with_repetition * $campaign_duration;

        return response()->json([
            'price' => $final_price
        ]);
        
    }

    public function set_narration_order(TvNarrationOrderRequest $request)
    {
        $user = Auth::user();
        $tv_time = TvTime::where('time_id',$request->time_id)->where('tv_channel_id',$request->tv_channel_id)->first();
        $price = $this->narrations_select_times(new TvNarrationsTimesRequest($request->toArray()))->getData()->price;
        $order = ListHelper::create_update_order($user->id, $price);

        $tv_order = ListHelper::create_tv_order($order->id, 8, $request->tv_channel_id);
        
        $narration_order = new TvNarrationOrder;
        $narration_order->start_date = $request->start_date;
        $narration_order->end_date = $request->end_date;
        $narration_order->narration_period = $request->period;
        $narration_order->tv_time_id = $tv_time->id;
        $narration_order->narrations_per_day = $request->narrations_per_day;
        $narration_order->show_timing = $request->show_timing;
        $narration_order->price = $price;
        $narration_order->notes = $request->notes;
        $narration_order->tv_order_id = $tv_order->id;
        $narration_order->save();

        return response()->json([
            'status' => 'success',
            'message' => trans('messages.added_successfully'),
        ]);
        
    }
}
