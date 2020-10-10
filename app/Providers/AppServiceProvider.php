<?php

namespace App\Providers;

use App\Utilities\ArrayToXml;
use Illuminate\Support\ServiceProvider;
use App\Utilities\Power;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


    \Schema::defaultStringLength(191);


        \Response::macro('restaurantApi', function ($data, $callId=null, $message = '', $customErros = array(),$gloabParameters=array()) {

            $tempData  = array();
            $extraData = array();

            if ($callId == null) {
                $tempData = $data;
            } else {
                if (!is_integer($data) && !is_null($data)) {
                    $data = $data->toArray();
                    if (isset($data["current_page"])) {

                        foreach ($data as $key => $value) {
                            if ($key !== "data") {

                                $extraData[$key] = $value;
                            }
                        }

                        $data = $data["data"];

                    }

                    if (count($data) == count($data, COUNT_RECURSIVE)) {

                        $tempData = Power::fixData($callId, $data);
                    } else {

                        foreach ($data as $singleData) {

                            $tempData[] = Power::fixData($callId, $singleData);

                        }

                    }

                }

            }

            $fixedArray = array_merge(array('message' => $message, 'errors' => $customErros, 'data' => $tempData), $extraData,$gloabParameters);

            if (\Request::input('format') == 'xml') {
                return ArrayToXml::convert($fixedArray);
            }
            return response()->json($fixedArray);

        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
}
