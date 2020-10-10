<?php

namespace App\Http\Controllers;

use App\order;
use App\profile;
use App\Table;
use App\Utilities\Power;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    ///////////////////************ Order list details Function start ************///////////////////
    /**
     * List All Order Details
     * @param  Request
     * @return Json Response / Return Back with Error Message Array
     */
    public function listOrder(Request $request)
    {
        $user    = auth()->user()->id;
        $profile = profile::where('user_id', $user)->get()->first();

        if ($profile) {
            $allOrderDetails = order::where('profile_id', $profile->id)->with('profile')->with('user')->orderBy('date', 'desc')->paginate($request->limit ? $request->limit : 10);
            return response()->restaurantApi($allOrderDetails, Power::LIST_ORDERS, 'specific user order list details ');
        }

    }

    ///////////////////************ Order list details Function end ************///////////////

    ///////////////////************ create Order Function Start ************///////////////////
    /**
     * Create Order
     * @param Request =>profileId ,userId
     * @return Json Response / Return Back with Error Message Array
     */
    public function createOrder(Request $request)
    {

        $uniqid      = uniqid();
        $rand_start  = rand(1, 5);
        $rand_8_char = substr($uniqid, $rand_start, 8);

        // return json_encode(['data' => $data]);
        $data = json_decode($request->getContent());
        /* $tableExist = Table::where('id', $data->tableId)->where('status', 0)->where('created_at', '>=', Carbon::today())->get()->first();

        if ($tableExist != null) {
        return response()->restaurantApi(null, Power::CREATE_ORDER, 'Table already booked ', array(['Table already booked']));
        } else {*/
        $order               = new order;
        $order->code         = $rand_8_char;
        $order->profile_id   = $data->profileId;
        $order->user_id      = auth()->user()->id;
        $order->no_of_person = $data->person;
        $order->date         = $data->date;
        $order->time         = $data->time;
        $order->note         = $data->note;
        $order->location     = $data->location;
        $order->status       = $data->status;
        $order->save();

        $updatetablestatus         = Table::where("id", $data->tableId)->get()->first();
        $updatetablestatus->status = "1";
        $updatetablestatus->save();
        return response()->restaurantApi($order, Power::CREATE_ORDER, 'Order Created Successfully');
        /* }*/

    }

    ///////////////////************ create Order Function End **************///////////////////

    ///////////////////************ Update Specific Order Function start ************///////////
    /**
     * Update specific Order
     * @param Update Order code,name,description,address,city,postalCode,image as a base64decode
     * @return Json Response / Return Back with Error Message Array
     */

    public function updateOrder(Request $request)
    {
        $data       = json_decode($request->getContent());
       /* $tableExist = Table::where('id', $data->tableId)->where('status', 0)->get()->first();

        if ($tableExist != null) {
            return response()->restaurantApi(null, Power::UPDATE_ORDER, 'Table already booked ', array(['Table already booked']));
        } else {*/
            $specificUpdateOrder = order::where('id', $data->orderId)->get()->first();
            if ($specificUpdateOrder) {
                $specificUpdateOrder->status       = $data->status;
                $specificUpdateOrder->save();
                return response()->restaurantApi($specificUpdateOrder, Power::UPDATE_ORDER, 'Order Updated successfully');
            } else {

                return response()->restaurantApi(null, Power::UPDATE_ORDER, 'Order Updated Unsuccessfully', array(['Order updated Unsuccessfully']));
            }
       /* }*/
    }

    ///////////////////************ Update Specific Order Function end ************///////////



    ///////////////////************ Specific Order Detail Function start ************///////////
    /**
     * Specific Order Details
     * @param specific Order code => $code
     * @return Json Response / Return Back with Error Message Array
     */
    public function specificOrderDetail($id)
    {
        $getspecificOrderDetail = order::where("id", $id)->with('profile')->with('user')->with('user')->get();
        if ($getspecificOrderDetail) {
            return response()->restaurantApi($getspecificOrderDetail, Power::SPECIFIC_ORDER, 'Specific Order Detail');
        } else {
            return response()->restaurantApi(null, Power::SPECIFIC_ORDER, 'specific Order detail doesnot exit', array(['specific Order detail doesnot exit']));
        }
    }

    ///////////////////************ Specific Order Detail Function end **************//////////


    ///////////////////************ Specific Order Detail Function start ************///////////
    /**
     * Specific Order Details
     * @param specific Order code => $code
     * @return Json Response / Return Back with Error Message Array
     */
    public function specificlogedInUserPerviousOrderDetail()
    {
        $getspecificOrderDetail = order::where("user_id", auth()->user()->id)->with('profile')->with('user')->where('date', '<', Carbon::today())->orderBy('date', 'desc')->get();
        if ($getspecificOrderDetail) {
            return response()->restaurantApi($getspecificOrderDetail, Power::SPECIFIC_ORDER, 'Specific Order Detail');
        } else {
            return response()->restaurantApi(null, Power::SPECIFIC_ORDER, 'specific Order detail doesnot exit', array(['specific Order detail doesnot exit']));
        }
    }

    ///////////////////************ Specific Order Detail Function end **************//////////

    ///////////////////************ Specific Upcoming Order Detail Function start ************///////////
    /**
     * Specific Upcoming Order Detail
     * @param ---
     * @return Json Response / Return Back with Error Message Array
     */
    public function specificUpcomingUserOrder()
    {
        $getspecificUpcomingUserOrder = order::where("user_id", auth()->user()->id)->with('profile')->with('user')->where('date', '>=', Carbon::today())->orderBy('date', 'desc')->get();
        if ($getspecificUpcomingUserOrder) {
            return response()->restaurantApi($getspecificUpcomingUserOrder, Power::SPECIFIC_ORDER, 'Specific Upcoming Order Detail');
        } else {
            return response()->restaurantApi(null, Power::SPECIFIC_ORDER, 'Specific Upcoming Order detail doesnot exit', array(['Specific Upcoming Order detail doesnot exit']));
        }
    }

    ///////////////////************ Specific Upcoming Order Detail Function end **************//////////

}
