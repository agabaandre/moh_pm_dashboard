<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/*
*
* Developed by <henricsanyu@gmail.com>
*
* $autoload['helper'] =  array('kpiTrend');
* display a language
* echo kpiTrend($params); 
*
*/

if (!function_exists('kpiTrend')) {

    function kpiTrend($params)
    {
        $params = (Object) $params;

        $current_target      = $params->current_target;
        $gauge_value         = $params->current_value;
        $previousgauge_value = $params->prev_value;
        $current_period      = $params->current_period;
        $previous_period     = $params->prev_period;

         if ($previous_period!=0){
             $previous_period='for '. $previous_period;
         }
         else{
            $previous_period='';
         }

         $arrow = "fa fa-arrow-down";
         $color = "red";

       //increasing
         if(($current_target)>=40){


             if ($gauge_value > $previousgauge_value){
                $arrow = "fa fa-arrow-up";
                $color = "green";
             } 
             elseif ($gauge_value == $previousgauge_value){

                $arrow = "fa fa-arrow-right";
                $color = "orange";
            }
            else
            {
                $arrow = "fa fa-arrow-down";
                $color = "red";
            }

        }  
         
        //reducing
        if(($current_target)<40){

            if ($gauge_value < $previousgauge_value){

                $arrow = "fa fa-arrow-up";
                $color = "green";
             } 
             elseif ($gauge_value == $previousgauge_value){

                $arrow = "fa fa-arrow-right";
                $color = "orange";
             } 
             
             else
             {
                $arrow = "fa fa-arrow-down";
                $color = "red";
             }
         }  


         $gaugeValue          = round($gauge_value);
         $previousPeriodValue = round($previousgauge_value);

         return  '<i class="fa '.$arrow.' style="color:'.$color.';margin-bottom:10px;"></i> '.$gaugeValue.'% for  '.$current_period.'  compared to '.$previousPeriodValue .'% '.$previous_period=FALSE.'';
 
    }
 
}

