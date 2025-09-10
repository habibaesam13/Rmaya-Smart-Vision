<?php

namespace App\Http\Traits;


use App\Models\Events;
use App\Models\Logs;
use App\Models\Visitor;
use Carbon\Carbon;

trait SendSmsTrait
{

    function send($event_id, $type)
    {
        $event = Events::with('visitor')->find($event_id);
        if ($type == 'insurance') {
            $body = "اهلا بك " . $event->visitor->name_ar . "\n" . " لقد تم استلام مبلغ " . "\n" . $event->insurance_amount . " درهم " . "\n" . " للمناسبة الخاصة بكم بتاريخ حجز " . $event->booking_date . " كمبلغ تاميني ";
        } elseif ($type == "refunded") {
            $body = "اهلا بك " . $event->visitor->name_ar . "\n" . " تم تسليمكم مبلغ " . "\n" . $event->refunded_amount . " درهم " . "\n" . " قيمة المبلغ التاميني المسترد ";
        }

       $body=urlencode($body);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://smsapi.esmart-vision.com/api/mim/SendSMS?userid=SMV2300001&pwd=DD8D$803_C91&mobile=' . $event->visitor->phone . '&sender=FFRD&msg=' . $body . '&msgtype=20',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
//dd($response);
        curl_close($curl);
//        dd($body ,  $event->visitor->phone);
    }


    function addEvent($event_id)
    {
        $event = Events::with('visitor' , 'eventPlace:id,name_ar')->find($event_id);
        $body = "اهلا بك " . $event->visitor->name_ar . "\n" . " لقد تم اضافة حجز جديد بنجاح بتاريخ " .    $event->booking_date   . "\n" . " بمجلس " .  $event->eventPlace->name_ar;

//        $body=urlencode($body);
//        $curl = curl_init();
//
//        curl_setopt_array($curl, array(
//            CURLOPT_URL => 'http://smsapi.esmart-vision.com/api/mim/SendSMS?userid=SMV2300001&pwd=DD8D$803_C91&mobile=' . $event->visitor->phone . '&sender=FFRD&msg=' . $body . '&msgtype=20',
//            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => '',
//            CURLOPT_MAXREDIRS => 10,
//            CURLOPT_TIMEOUT => 0,
//            CURLOPT_FOLLOWLOCATION => true,
//            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//            CURLOPT_CUSTOMREQUEST => 'GET',
//        ));
//
//        $response = curl_exec($curl);
//
//        curl_close($curl);
//        dd($body);
    }

}
