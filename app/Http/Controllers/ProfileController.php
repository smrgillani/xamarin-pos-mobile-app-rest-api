<?php

namespace App\Http\Controllers;

use App\profile;
use App\User;
use App\Utilities\Power;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProfileController extends Controller
{

    ///////////////////************ Profile list details Function start ************///////////////////
    /**
     * List All Profile Details
     * @param  Request
     * @return Json Response / Return Back with Error Message Array
     */
    public function listProfile(Request $request)
    {
        $allProfileDetails = profile::select('*')->with('user')->orderBy('created_at', 'desc')->paginate($request->limit ? $request->limit : 10);
        if ($allProfileDetails) {
            return response()->restaurantApi($allProfileDetails, Power::LIST_PROFILE, 'Profile list details ');
        } else {
            return response()->restaurantApi(null, Power::LIST_PROFILE, 'Profile list details ', array(['Profile list details does not exit']));
        }
    }

    ///////////////////************ Profile list details Function end ************///////////////

    ///////////////////************ create Profile Function start ************///////////////////
    /**
     * Create Profile
     * @param Request => name,description,address,city,postalCode,image as a base64decode
     * @return Json Response / Return Back with Error Message Array
     */
    public function createProfile(Request $request)
    {

        // return json_encode(['data' => $data]);
        $data = json_decode($request->getContent());

        //****upload image and convert into base64 code start****//
        /*  $image      = base64_decode($data->image);
        $image_name = str_random(10) . '.' . 'png';
        $path       = public_path() . "/images/" . $image_name;
        file_put_contents($path, $image);*/
        //****upload image and convert into base64 code end****//
        $newProfile              = new profile;
       
        $newProfile->user_id     = auth()->user()->id;
        $newProfile->name        = $data->name;
        $newProfile->description = $data->description;
        $newProfile->address     = $data->address;
        $newProfile->city        = $data->city;
        $newProfile->postal_code = $data->postalCode;
        $newProfile->phone_no = $data->phoneNo;
        /*$newProfile->image_name  = $image_name;
        $newProfile->image_path  = $path;*/
        $newProfile->save();
        return response()->restaurantApi($newProfile, Power::CREATE_PROFILE, 'Profile Created Successfully');
      

    }

    ///////////////////************ create Profile Function end **************///////////////////

    ///////////////////************ Specific Profile Detail Function start ************///////////
    /**
     * Specific Profile Details
     * @param specific Profile code => $code
     * @return Json Response / Return Back with Error Message Array
     */
    public function specificProfileDetail($id)
    {
        $getspecificProfileDetail = profile::where("id", $id)->with('user')->get();
        if ($getspecificProfileDetail) {
            return response()->restaurantApi($getspecificProfileDetail, Power::SPECIFIC_PROFILE, 'Specific Profile Detail');
        } else {
            return response()->restaurantApi(null, Power::SPECIFIC_PROFILE, 'specific Profile detail doesnot exit', array(['specific Profile detail doesnot exit']));
        }
    }

    ///////////////////************ Specific Profile Detail Function end **************//////////

    ///////////////////************ Update Specific Profile Function start ************///////////
    /**
     * Update specific Profile
     * @param Update Profile code,name,description,address,city,postalCode,image as a base64decode
     * @return Json Response / Return Back with Error Message Array
     */

    public function updateProfile(Request $request)
    {
        $data            = json_decode($request->getContent());
        $specificProfile = profile::where("user_id", auth()->user()->id)->get()->first();
        if ($specificProfile) {
            $specificProfile->name        = $data->name;
            $specificProfile->description = $data->description;
            $specificProfile->address     = $data->address;
            $specificProfile->city        = $data->city;
            $specificProfile->postal_code = $data->postalCode;
            $specificProfile->phone_no = $data->phoneNo;
            $specificProfile->update();
            return response()->restaurantApi($specificProfile, Power::UPDATE_PROFILE, 'profile updated successfully');
        } else {

            return response()->restaurantApi(null, Power::UPDATE_PROFILE, 'profile updated Unsuccessfully', array(['profile updated Unsuccessfully']));
        }
    }

    ///////////////////************ Update Specific Profile Function end ************///////////

    ///////////////////************ Delete Specific Profile Function start ************///////////
    /**
     * Delete specific Profile
     * @param Delete Profile  use specifc profile code
     * @return Json Response / Return Back with Error Message Array
     */
    public function deleteProfile($id)
    {
        $specificProfile = profile::where('id', '=', $id)->get()->first();
        if ($specificProfile) {
            $deleteProfile = $specificProfile->delete();
            if ($deleteProfile) {
                return response()->restaurantApi(null, Power::DELETE_PROFILE, 'profile deleted successfully');
            } else {
                return response()->restaurantApi(null, Power::DELETE_PROFILE, 'profile deleted Unsuccessfully', array('profile deleted Unsuccessfully'));
            }
        } else {
            return response()->restaurantApi(null, Power::DELETE_PROFILE, 'profile deleted Unsuccessfully', array(['profile deleted Unsuccessfully']));
        }
    }

    ///////////////////************ Delete Specific Profile Function start ************///////////

    ///////////////////************ User Specific Profile Function start ************///////////
    /**
     * User specific Profile data
     * @param user Specific Profile detail  use  user specifc profile code
     * @return Json Response / Return Back with Error Message Array
     */
    public function userSpecificProfileDetail()
    {

        $userSpecificProfile = profile::where('user_id', '=', auth()->user()->id)->with('user')->get();
        if ($userSpecificProfile) {
            return response()->restaurantApi($userSpecificProfile, Power::USER_SPECIFIC_PROFILE, 'User Specific Profile Detail');
        } else {
            return response()->restaurantApi(null, Power::USER_SPECIFIC_PROFILE, 'User Specific Profile detail doesnot exit', array(['specific Profile detail doesnot exit']));
        }

    }

    ///////////////////************ Delete Specific Profile Function start ************///////////

    ///////////////////************ User Specific Profile Update Function start ************///////////
    /**
     * Update specific Profile
     * @param Update Profile name,description,address,city,postalCode
     * @return Json Response / Return Back with Error Message Array
     */

    public function updateUserSpecificProfile(Request $request)
    {
        $data                      = json_decode($request->getContent());
        $updateUserspecificProfile = profile::where("user_id", auth()->user()->id)->get()->first();
        if ($updateUserspecificProfile) {
            $updateUserspecificProfile->name        = $data->name;
            $updateUserspecificProfile->description = $data->description;
            $updateUserspecificProfile->address     = $data->address;
            $updateUserspecificProfile->city        = $data->city;
            $updateUserspecificProfile->postal_code = $data->postalCode;
            $updateUserspecificProfile->update();
            return response()->restaurantApi($updateUserspecificProfile, Power::UPDATE_USER_SPECIFIC_PROFILE, 'User Specific Profile updated successfully');
        } else {

            return response()->restaurantApi(null, Power::UPDATE_USER_SPECIFIC_PROFILE, 'User Specific Profile updated Unsuccessfully', array(['User Specific Profile updated Unsuccessfully']));
        }
    }

    ///////////////////************ User  Specific Profile Update Function end ************///////////

}
