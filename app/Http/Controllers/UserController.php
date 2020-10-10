<?php

namespace App\Http\Controllers;

use App\User;
use App\UserType;
use App\Utilities\Power;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Hash;
class UserController extends Controller
{


     ///////////////////************ Users Type details Function start ************///////////////////
    /**
     * List All User Details
     * @param  Request
     * @return Json Response / Return Back with Error Message Array
     */
    public function UserTypeDetails(Request $request)
    {
        $allUserTypeDetails = UserType::select('*')->orderBy('created_at', 'desc')->paginate($request->limit ? $request->limit : 10);
        if ($allUserTypeDetails) {
            return response()->restaurantApi($allUserTypeDetails, Power::LIST_USER_TYPE, 'Users Type details ');
        } else {
            return response()->restaurantApi(null, Power::LIST_USER_TYPE, 'Users Type details ', array(['Users Type details does not exit']));
        }
    }

    ///////////////////************ Users Type details Function end ************///////////////

    ///////////////////************ Users list details Function start ************///////////////////
    /**
     * List All User Details
     * @param  Request
     * @return Json Response / Return Back with Error Message Array
     */
    public function listUsers(Request $request)
    {
        $allUserDetails = User::select('*')->with('UserTypes')->orderBy('created_at', 'desc')->paginate($request->limit ? $request->limit : 10);
        if ($allUserDetails) {
            return response()->restaurantApi($allUserDetails, Power::LIST_USERS, 'Users list details ');
        } else {
            return response()->restaurantApi(null, Power::LIST_USERS, 'Users list details ', array(['Users list details does not exit']));
        }
    }

    ///////////////////************ Users list details Function end ************///////////////

    ///////////////////************ create User Function start ************///////////////////
    /**
     * User Registration
     * @param Request => name,email,password
     * @return Json Response / Return Back with Error Message Array
     */
    public function createUserRegistration(Request $request)
    {
        // return json_encode(['data' => $data]);
        $data      = json_decode($request->getContent());
        $validator = Validator::make((array) $data, [
            'email'    => 'required|email|unique:users',
            'name'     => 'required|string|max:50',
            'password' => 'required',
        ]);
        if ($validator->fails()) {

            return response()->restaurantApi(null, Power::CREATE_USERS, 'user created unsuccessfully', array($validator->errors()->all()));

        } else {
            $newUser               = new User;
            $newUser->user_type_id = $data->userType;
            $newUser->name         = $data->name;
            $newUser->email        = $data->email;
            $newUser->password     = bcrypt($data->password);
            $newUser->save();
            return response()->restaurantApi($newUser, Power::CREATE_USERS, 'user created successfully');
        }

    }

    ///////////////////************ create User Function end **************///////////////////

    ///////////////////************ User Specific Detail Function start ************///////////
    /**
     * Specific User Details
     * @param specific user code => $code
     * @return Json Response / Return Back with Error Message Array
     */
    public function specificUserDetail($id)
    {

        $getspecificUserDetail = User::where("id", $id)->with('UserTypes')->get();
        if ($getspecificUserDetail) {
            return response()->restaurantApi($getspecificUserDetail, Power::SPECIFIC_USERS, 'Specific User Detail');
        } else {
            return response()->restaurantApi(null, Power::SPECIFIC_USERS, 'specific user detail doesnot exit', array(['specific user detail doesnot exit']));
        }
    }

    ///////////////////************ User Specific Detail Function end **************//////////

    ///////////////////************ User LogIn Function start ************///////////////////
    /**
     * Login Credentional Check
     * @param Request => email, passowrd
     * @return Json Response / Return Back with Error Message Array
     */
    public function userLogin(Request $request)
    {
        //
        $data = json_decode($request->getContent());
        $user = User::where('username_', '=', $data->email)->where('status', '=', 'active')->first();
        if (Hash::check($data->password, $user->password) && $user) {
            $userInfo = Auth::login($user);
            $userInfo           = auth()->user()->getUserInformation(true);
            $user->access_token = $userInfo;
            $user->update();
            return response()->restaurantApi($user, Power::LOGIN_USERS, 'user logedIn successfully');
        } else {
            return response()->restaurantApi(null, Power::LOGIN_USERS, 'user logedIn unsuccessfully', array(['Invalid Email Or Password']));
        }

        //Old Code
        //$data = json_decode($request->getContent());
        //$user = User::where('username_', '=', $data->email)->where('status', '=', 'active')->first();
        //return response()->restaurantApi($user, Power::LOGIN_USERS, 'User LogedIn Successfully');
        // $credentionals = ['email' => $data->email, 'password' => $data->password];
        // if (auth()->attempt($credentionals) && $user) {
        //     $userInfo           = auth()->user()->getUserInformation(true);
        //     $user->access_token = $userInfo;
        //     $user->update();
        //     return response()->restaurantApi($user, Power::LOGIN_USERS, 'user logedIn successfully');
        // } else {
        //     return response()->restaurantApi(null, Power::LOGIN_USERS, 'user logedIn unsuccessfully', array(['Invalid Email Or Password']));
        // }

    }

    ///////////////////************ User LogIn Function end ***************///////////////////

    ///////////////////************ User Logout Function start ************///////////////////
    /**
     * Logout User Call
     * @param Request Authorization param of header
     * @return Json Response / Return Back with Error Message Array
     */
    public function userLogout(Request $request)
    {

        $header = $request->header('Authorization', '');
        if ($header == '') {
            return response()->restaurantApi(null, Power::USER_LOGOUT, 'User missing access token', array(['Missing User Access Token']));
        }
        if (Str::startsWith($header, 'Bearer ')) {
            $header = Str::substr($header, 7);
            $user   = User::where('access_token', '=', $header)->get()->first();
            if ($user) {
                $user->access_token = "";
                $user->update();
                return response()->restaurantApi($user, Power::USER_LOGOUT, 'user Logout successfully');
            } else {
                return response()->restaurantApi(null, Power::USER_LOGOUT, 'user cannot Logout successfully', array(['user cannot Logout successfully']));
            }
        }
    }

    ///////////////////************ User Logout Function end ************///////////////////

     ///////////////////************ beacon Function start ************///////////////////

    /**
     * beacon User Call
     * @param Request Authorization param of header
     * @return Json Response / Return Back with Error Message Array
     */
    public function checkbeacon(Request $request)
    {

       $header = $request->header('Authorization', '');
        if ($header == '') {
            return response()->restaurantApi(null, Power::LOGIN_USERS, 'User missing access token', array(['Missing User Access Token']));
        }
        if (Str::startsWith($header, 'Bearer ')) {
            $header = Str::substr($header, 7);
            $user   = User::where('access_token', '=', $header)->get()->first();
            if ($user) {
                
                return response()->restaurantApi(null, Power::LOGIN_USERS, 'true');
            } else {
                return response()->restaurantApi(null, Power::LOGIN_USERS, 'false', array(['user logedIn unsuccessfully']));
            }
        }   
       
    }

    ///////////////////************ beacon header Function end ************///////////////////

}
