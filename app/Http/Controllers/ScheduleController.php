<?php

namespace App\Http\Controllers;

use App\schedule;
use App\Utilities\Power;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{

    ///////////////////************ Schedule list details Function start ************///////////////
    /**
     * List All Schedule Details
     * @param  Request
     * @return Json Response / Return Back with Error Message Array
     */
    public function listSchedule(Request $request,$profileId)
    {
        $allScheduleDetails = schedule::where('profile_id',$profileId)->with('profile')->orderBy('created_at', 'desc')->paginate($request->limit ? $request->limit : 10);
        if ($allScheduleDetails) {
            return response()->restaurantApi($allScheduleDetails, Power::LIST_SCHEDULES, 'Schedule list details ');
        } else {
            return response()->restaurantApi(null, Power::LIST_SCHEDULES, 'Schedule list details ', array(['Schedule list details does not exit']));
        }
    }

    ///////////////////************ Schedule list details Function end ************///////////////

    ///////////////////************ create Schedule Function Start ************///////////////////
    /**
     * Create Schedule
     * @param Request => profileId,name,startTime,endTime,status
     * @return Json Response / Return Back with Error Message Array
     */
    public function createSchedule(Request $request)
    {

        // return json_encode(['data' => $data]);
        $data = json_decode($request->getContent());

        $schedule             = new schedule;
        $schedule->profile_id = $data->profileId;
        $schedule->name       = $data->name;
        $schedule->start_time = $data->startTime;
        $schedule->end_time   = $data->endTime;
        $schedule->status     = $data->status;
        $schedule->save();
        
        return response()->restaurantApi($schedule, Power::CREATE_SCHEDULE, 'schedule Created Successfully');

    }

    ///////////////////************ create Schedule Function End **************///////////////////

    ///////////////////************ Specific Schedule Detail Function start ************///////////
    /**
     * Specific Schedule Details
     * @param specific Schedule id => $id
     * @return Json Response / Return Back with Error Message Array
     */
    public function specificScheduleDetail($profileId)
    {
        $getspecificScheduleDetail = schedule::where("id", $profileId)->with('profile')->get();
        if ($getspecificScheduleDetail) {
            return response()->restaurantApi($getspecificScheduleDetail, Power::SPECIFIC_SCHEDULE, 'Specific Schedule Detail');
        } else {
            return response()->restaurantApi(null, Power::SPECIFIC_SCHEDULE, 'specific Schedule detail doesnot exit', array(['specific Schedule detail doesnot exit']));
        }
    }

    ///////////////////************ Specific Schedule Detail Function end **************//////////

    ///////////////////************ Update Specific Schedule Function start ************//////////
    /**
     * Update specific Schedule
     * @param Update Schedule code,profileId,startTime,endTime,status
     * @return Json Response / Return Back with Error Message Array
     */

    public function updateSchedule(Request $request)
    {
        $data             = json_decode($request->getContent());
        $specificSchedule = schedule::where("id", $data->id)->get()->first();
        if ($specificSchedule) {
            $specificSchedule->name       = $data->name;
            $specificSchedule->start_time = $data->startTime;
            $specificSchedule->end_time   = $data->endTime;
            $specificSchedule->status     = $data->status;
            $specificSchedule->update();
            return response()->restaurantApi($specificSchedule, Power::UPDATE_SCHEDULE, 'schedule updated successfully');
        } else {

            return response()->restaurantApi(null, Power::UPDATE_SCHEDULE, 'schedule updated Unsuccessfully', array(['schedule updated Unsuccessfully']));
        }
    }

    ///////////////////************ Update Specific Schedule Function end ************///////////

    ///////////////////************ Delete Specific Schedule Function start ************///////////
    /**
     * Delete specific Schedule
     * @param Delete Schedule  use specifc schedule code
     * @return Json Response / Return Back with Error Message Array
     */
    public function deleteSchedule($id)
    {
        $specificSchedule = schedule::where('id', '=', $id)->get()->first();
        if ($specificSchedule) {
            $deleteSchedule = $specificSchedule->delete();
            if ($deleteSchedule) {
                return response()->restaurantApi(null, Power::DELETE_SCHEDULE, 'schedule deleted successfully');
            } else {
                return response()->restaurantApi(null, Power::DELETE_SCHEDULE, 'schedule deleted Unsuccessfully', array('schedule deleted Unsuccessfully'));
            }
        } else {
            return response()->restaurantApi(null, Power::DELETE_SCHEDULE, 'schedule deleted Unsuccessfully', array(['schedule deleted Unsuccessfully']));
        }
    }

    ///////////////////************ Delete Specific Schedule Function start ************///////////

}
