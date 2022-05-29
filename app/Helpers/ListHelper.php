<?php
namespace App\Helpers;
use App\Models\Order;
use App\Models\RadioOrder;
use App\Models\TvOrder;

class ListHelper
{
    public static function create_update_order($user_id,$price)
    {   
        $user_order = Order::where('user_id',$user_id)->where('paid',0)->get();
        if(count($user_order) > 0){
            $order = $user_order->first();
            $order->total = $order->total + $price;
            $order->save();
        }else{
            $order = new Order;
            $order->user_id = $user_id;
            $order->total = $price;
            $order->paid = 0;
            $order->save();
        }

        return $order;
    }

    public static function create_radio_order($order_id,$service_id,$radio_id)
    {   
        $order = Order::find($order_id);
        
        $radio_order = RadioOrder::where('order_id',$order_id)->where('service_id',$service_id)->where('radio_id',$radio_id)->first();

        if(empty($radio_order)){
            $radio_order = new RadioOrder;
            $radio_order->order_id = $order_id;
            $radio_order->service_id = $service_id;
            $radio_order->radio_id = $radio_id;
            $radio_order->save();
        }
                
        return  $radio_order;
    }

    public static function create_tv_order($order_id,$service_id,$channel_id)
    {   
        $order = Order::find($order_id);
        
        $tv_order = TvOrder::where('order_id',$order_id)->where('service_id',$service_id)->where('tv_channel_id',$channel_id)->first();

        if(empty($tv_order)){
            $tv_order = new TvOrder;
            $tv_order->order_id = $order_id;
            $tv_order->service_id = $service_id;
            $tv_order->tv_channel_id = $channel_id;
            $tv_order->save();
        }
                
        return  $tv_order;
    }
    

}