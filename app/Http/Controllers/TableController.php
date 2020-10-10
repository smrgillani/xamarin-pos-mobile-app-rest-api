<?php

namespace App\Http\Controllers;

use App\Table;
use Carbon\Carbon;
use App\Utilities\Power;
use Illuminate\Http\Request;

class TableController extends Controller
{


    ///////////////////************ profile Available Table details Function start ************///////////////////
    /**
     * List All profile Available Table  Details
     * @param  Request
     * @return Json Response / Return Back with Error Message Array
     */
    public function profileAvailableTable($profileId)
    {
        $profileAvailableTable = Table::where('profile_id',$profileId)->with('profile')->where('status',1)->where('created_at', '>=', Carbon::today())->get();
        
        if ($profileAvailableTable) {
            return response()->restaurantApi($profileAvailableTable, Power::LIST_PROFILE_AVAILABLE_TABLE, ' profile available table list details ');
        } else {
            return response()->restaurantApi(null, Power::LIST_PROFILE_AVAILABLE_TABLE, ' profile Available Table list details ', array([' profile Available Table list details does not exit']));
        }
    }

    ///////////////////************ profile Available Table details Function end ************///////////////  
    
    ///////////////////************ Table list details Function start ************///////////////
    /**
     * List All Table Details
     * @param  Request
     * @return Json Response / Return Back with Error Message Array
     */
    public function listTable(Request $request,$profileId)
    {
        $allTableDetails = Table::where('profile_id',$profileId)->with('profile')->orderBy('created_at', 'desc')->paginate($request->limit ? $request->limit : 10);

        if ($allTableDetails) {
            return response()->restaurantApi($allTableDetails, Power::LIST_TABLE, 'Table list details ');
        } else {
            return response()->restaurantApi(null, Power::LIST_TABLE, 'Table list details ', array(['Table list details does not exit']));
        }
    }

    ///////////////////************ Table list details Function end ************///////////////

    ///////////////////************ create Table Function Start ************///////////////////
    /**
     * Create Table
     * @param Request => profileId,name,type,seats,freeTables,reservationTime,status
     * @return Json Response / Return Back with Error Message Array
     */
    public function createTable(Request $request)
    {

        // return json_encode(['data' => $data]);
        $data = json_decode($request->getContent());

        $table                   = new Table;
        $table->profile_id       = $data->profileId;
        $table->name             = $data->name;
        $table->type             = $data->type;
        $table->seats            = $data->seats;
        $table->free_tables      = $data->freeTables;
        $table->reservation_time = $data->reservationTime;
        $table->status           = $data->status;
        $table->save();
        return response()->restaurantApi($table, Power::CREATE_TABLE, 'table Created Successfully');

    }

    ///////////////////************ create Table Function End **************////////////////////

    ///////////////////************ Specific Table Detail Function start ************///////////
    /**
     * Specific Table Details
     * @param specific Table code => $code
     * @return Json Response / Return Back with Error Message Array
     */
    public function specificTableDetail($id)
    {
        $getspecificTableDetail = Table::where("id", $id)->with('profile')->get();
        if ($getspecificTableDetail) {
            return response()->restaurantApi($getspecificTableDetail, Power::SPECIFIC_TABLE, 'Specific Table Detail');
        } else {
            return response()->restaurantApi(null, Power::SPECIFIC_TABLE, 'specific Table detail doesnot exit', array(['specific Table detail doesnot exit']));
        }
    }

    ///////////////////************ Specific Table Detail Function end **************///////////

    ///////////////////************ Update Specific Table Function start ************///////////
    /**
     * Update specific Table
     * @param Update Table profileId,name,type,seats,freeTables,reservationTime,status
     * @return Json Response / Return Back with Error Message Array
     */

    public function updateTable(Request $request)
    {
        $data          = json_decode($request->getContent());
        $specificTable = Table::where("id", $data->id)->get()->first();
        if ($specificTable) {
            $specificTable->name             = $data->name;
            $specificTable->type             = $data->type;
            $specificTable->seats            = $data->seats;
            $specificTable->free_tables      = $data->freeTables;
            $specificTable->reservation_time = $data->reservationTime;
            $specificTable->status           = $data->status;
            $specificTable->update();
            return response()->restaurantApi($specificTable, Power::UPDATE_TABLE, 'table updated successfully');
        } else {

            return response()->restaurantApi(null, Power::UPDATE_TABLE, 'table updated Unsuccessfully', array(['table updated Unsuccessfully']));
        }
    }

    ///////////////////************ Update Specific Table Function end ************/////////////

    ///////////////////************ Delete Specific Table Function start ************///////////
    /**
     * Delete specific Table
     * @param Delete Table  use specifc table code
     * @return Json Response / Return Back with Error Message Array
     */
    public function deleteTable($code)
    {
        $specificTable = Table::where('code', '=', $code)->get()->first();
        if ($specificTable) {
            $deleteTable = $specificTable->delete();
            if ($deleteTable) {
                return response()->restaurantApi(null, Power::DELETE_TABLE, 'table deleted successfully');
            } else {
                return response()->restaurantApi(null, Power::DELETE_TABLE, 'table deleted Unsuccessfully', array('table deleted Unsuccessfully'));
            }
        } else {
            return response()->restaurantApi(null, Power::DELETE_TABLE, 'table deleted Unsuccessfully', array(['table deleted Unsuccessfully']));
        }
    }

    ///////////////////************ Delete Specific Table Function start ************////////////
}
