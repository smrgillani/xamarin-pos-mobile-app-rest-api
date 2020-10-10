<?php

namespace App\Utilities;

class Power
{
    ///////////////////********User constant json start*******////////////////////
    const CREATE_USERS   = 1;
    const SPECIFIC_USERS = 2;
    const LIST_USERS     = 3;
    const LIST_USER_TYPE = 4;
    const LOGIN_USERS    = 5;
    const USER_LOGOUT    = 6;
    ///////////////////********User constant json end*******//////////////////////

    ///////////////////********Profile constant json start*******/////////////////
    const CREATE_PROFILE               = 7;
    const UPDATE_PROFILE               = 8;
    const LIST_PROFILE                 = 9;
    const SPECIFIC_PROFILE             = 10;
    const UPDATE_USER_SPECIFIC_PROFILE = 11;
    const USER_SPECIFIC_PROFILE        = 12;
    const DELETE_PROFILE               = 13;

    ///////////////////********Profile constant json end*******///////////////////

    ///////////////////********Schedule constant json start*******////////////////
    const CREATE_SCHEDULE   = 14;
    const UPDATE_SCHEDULE   = 15;
    const LIST_SCHEDULES    = 16;
    const SPECIFIC_SCHEDULE = 17;
    const DELETE_SCHEDULE   = 18;
    ///////////////////********Schedule constant json end*******//////////////////

    ///////////////////********Table constant json start*******///////////////////
    const CREATE_TABLE   = 19;
    const UPDATE_TABLE   = 20;
    const LIST_TABLE     = 21;
    const SPECIFIC_TABLE = 22;
    const DELETE_TABLE   = 23;
    const LIST_PROFILE_AVAILABLE_TABLE   = 24;
    ///////////////////********Table constant json end*******////////////////////

    ///////////////////********Order constant json start*******///////////////////
    const CREATE_ORDER   = 25;
    const UPDATE_ORDER   = 26;
    const SPECIFIC_ORDER = 27;
    const LIST_ORDERS    = 28;
    ///////////////////********Order constant json end*******////////////////////
    public static function recordsToShow($callName)
    {

        $allRecordsArray = array(
            ///////////////////********User Json Start*******////////////////////
            self::CREATE_USERS                 => array('id', 'name', 'email', 'password', 'created_at', 'updated_at'),
            self::SPECIFIC_USERS               => array('id', 'name', 'email', 'created_at', 'updated_at', 'user_types.name'),
            self::LIST_USERS                   => array('id', 'name', 'email', 'access_token', 'created_at', 'updated_at', 'user_types.name'),
            self::LIST_USER_TYPE               => array('id', 'name', 'created_at', 'updated_at'),
            self::LOGIN_USERS                  => array('id', 'name', 'email', 'access_token'),
            self::USER_LOGOUT                  => array('id', 'name', 'email', 'access_token'),
            ///////////////////********User Json End*******////////////////////

            ///////////////////********Profile Json Start*******////////////////////
            self::CREATE_PROFILE               => array('id', 'name', 'description', 'address', 'city', 'postal_code','phone_no', 'image_name', 'image_path', 'created_at', 'updated_at'),
            self::UPDATE_PROFILE               => array('id', 'name', 'description', 'address', 'city', 'postal_code','phone_no', 'image_name', 'image_path', 'created_at', 'updated_at'),
            self::LIST_PROFILE                 => array('id', 'name', 'description', 'address', 'city', 'postal_code','phone_no', 'image_name', 'image_path', 'created_at', 'updated_at', 'user.name'),
            self::SPECIFIC_PROFILE             => array('id', 'name', 'description', 'address', 'city', 'postal_code','phone_no', 'image_name', 'image_path', 'user.name', 'created_at', 'updated_at'),

            self::UPDATE_USER_SPECIFIC_PROFILE => array('id', 'name', 'description', 'address', 'city', 'postal_code', 'phone_no','image_name', 'image_path', 'created_at', 'updated_at'),
            self::USER_SPECIFIC_PROFILE        => array('id', 'name', 'description', 'address', 'city', 'postal_code','phone_no', 'image_name', 'image_path', 'created_at', 'updated_at', 'user.name'),

            ///////////////////********Profile Json End*******////////////////////

            ///////////////////********Schedule Json Start*******////////////////////
            self::CREATE_SCHEDULE              => array('profile_id', 'id', 'name', 'start_time', 'end_time', 'status', 'created_at', 'updated_at'),
            self::UPDATE_SCHEDULE              => array('profile_id', 'id', 'name', 'start_time', 'end_time', 'status', 'created_at', 'updated_at'),
            self::LIST_SCHEDULES               => array('id', 'name', 'id','start_time', 'end_time', 'status', 'created_at', 'updated_at', 'profile.name'),
            self::SPECIFIC_SCHEDULE            => array('id', 'name','id', 'start_time', 'end_time', 'status', 'created_at', 'updated_at', 'profile.name'),
            ///////////////////********Schedule Json End*******////////////////////

            ///////////////////********Table Json Start*******////////////////////
            self::CREATE_TABLE                 => array('profile_id', 'id', 'name', 'type', 'seats', 'free_tables', 'reservation_time', 'status', 'created_at', 'updated_at'),
            self::UPDATE_TABLE                 => array('profile_id', 'id', 'name', 'type', 'seats', 'free_tables', 'reservation_time', 'status', 'created_at', 'updated_at'),
            self::LIST_TABLE                   => array('id', 'name', 'type', 'seats', 'free_tables', 'reservation_time', 'status', 'profile.name'),
            self::SPECIFIC_TABLE               => array('id', 'name', 'type', 'seats', 'free_tables', 'reservation_time', 'status', 'profile.name'),
            self::LIST_PROFILE_AVAILABLE_TABLE               => array('id', 'name','status', 'profile.name'),
            ///////////////////********Table Json End*******////////////////////
            ///////////////////********Order Json Start*******////////////////////
            self::CREATE_ORDER                 => array('id','code','profile_id', 'user_id', 'no_of_person','note','date', 'time', 'location', 'status', 'created_at', 'updated_at'),
            self::UPDATE_ORDER                 => array('id','code','profile_id', 'user_id', 'no_of_person','note','date', 'time', 'location', 'status', 'created_at', 'updated_at'),
            self::SPECIFIC_ORDER               => array('id','code','profile_id', 'user_id','no_of_person','note','date', 'time', 'location', 'status', 'created_at', 'updated_at', 'user.name', 'profile.name'),
            self::LIST_ORDERS                  => array('id','code','profile_id', 'user_id','no_of_person','note','date', 'time', 'location', 'status', 'created_at', 'updated_at', 'user.name', 'profile.name'),

            ///////////////////********Order Json End*******////////////////////
        );

        return $allRecordsArray[$callName];

    }
    public static function flatten($array, $prefix = '')
    {
        // dd($array);
        $result = array();
        foreach ($array as $key => $value) {

            if (is_array($value)) {
                if (is_numeric($key)) {$key = $prefix;} else {
                    $key = $prefix . $key . '.';
                }
                $result = $result + self::flatten($value, $key);
            } else {
                $result[$prefix . $key] = $value;
            }

        }

        return $result;
    }
    public static function fixData($whichCall, $data)
    {

        $elementsToSearch = self::recordsToShow($whichCall);
        $data             = self::flatten($data);
        $fixedArray       = array();
        if ($data) {
            foreach ($elementsToSearch as $value) {

                if (isset($data[$value])) {
                    //Need to Investigate the case

                    $fixedArray[str_replace(".","_",$value)] = $data[$value];
                } //Need to Investigate the case
                else {
                    $fixedArray[str_replace(".","_",$value)] = null;
                }
            }

        }

        return $fixedArray;
    }

}
