<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Time;
use App\Models\RadioTime;
use App\Models\RadioTimePrice;
use App\Models\RadioOrder;
use App\Models\RadioNarrationOrder;
use App\Models\RadioNarrationOrderTime;
use App\Http\Resources\RadioResource;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\RadioTimeResource;
use App\Http\Requests\RadioNarrationsTimesRequest;
use App\Http\Requests\RadioNarrationOrderRequest;
use \Carbon\Carbon;
use Auth;
use App\Helpers\ListHelper;

class RadioNarrationsController extends Controller
{
    public function radio_services()
    {
        $services = Service::where('type','radio')->get();
        return response()->json([
            'services' => ServiceResource::collection($services)
        ]);
    }

    public function get_service_radios($service_id)
    {
        $radios = Service::find($service_id)->radios;
        return response()->json([
            'radios' => RadioResource::collection($radios)
        ]);
    }

    public function radio_narrations($radio_id)
    {
        // $times = Time::with(['radios'=> function($q)use($radio_id){
        //     $q->where('radios.id' , $radio_id);
        // }])->get();

        $times = Time::where('type','radio')->with(['hours'=> function($q)use($radio_id){
            $q->where('radio_id' , $radio_id);
        }])->get();


        return response()->json([
            'times' => RadioTimeResource::collection($times),
        ]);
    }

    public function narrations_select_times(RadioNarrationsTimesRequest $request)
    {
        if($request->period <= 60){
            // price if narration period under 60 (each 5 seconds has different price)
            $radio_time =  RadioTime::where('radio_id',$request->radio_id)->where('time_id',$request->time_id)->first();
            $price = RadioTimePrice::where('radio_time_id',$radio_time->id)->where('period',$request->period)->first()->price;
        }else{
            // price if narration period above 60 (each 5 seconds after 60 has same value added to price)
            $price_above = RadioTimePrice::where('radio_time_id',$radio_time)->whereIn('period',[60 , 65])->get();
                                    
            $price_60 = $price_above->where('period',60)->first()->price;
            $price_additional = $price_above->where('period',65)->first()->price;
            $price_by_period = (($request->period - 60) / 5 ) * $price_additional;
            $price = $price_60 + $price_by_period;
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

    public function set_narration_order(RadioNarrationOrderRequest $request)
    {
        $user = Auth::user();
        $price = $this->narrations_select_times(new RadioNarrationsTimesRequest($request->toArray()))->getData()->price;
        $order = ListHelper::create_update_order($user->id, $price);

        $radio_order = ListHelper::create_radio_order($order->id, 1, $request->radio_id);
        
        $narration_order = new RadioNarrationOrder;
        $narration_order->start_date = $request->start_date;
        $narration_order->end_date = $request->end_date;
        $narration_order->narration_period = $request->period;
        $narration_order->narrations_per_day = $request->narrations_per_day;
        $narration_order->price = $price;
        $narration_order->notes = $request->notes;
        $narration_order->radio_order_id = $radio_order->id;
        $narration_order->save();

        
        foreach($request->hours_ids as $hour){
            $narration_order_time = new RadioNarrationOrderTime;
            $narration_order_time->radio_narration_order_id = $narration_order->id;
            $narration_order_time->radio_time_id = $hour;
            $narration_order_time->save();
        }
         

        return response()->json([
            'status' => 'success',
            'message' => trans('messages.added_successfully'),
        ]);
        
    }

}
