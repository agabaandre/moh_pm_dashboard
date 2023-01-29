<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Graph_mdl extends CI_Model {

	
public function __Construct(){

		parent::__Construct();

$this->financial_year=$_SESSION['financial_year'];
//create a period  to use to graph gauge data

}
//GAUGE
//error


       public function gaugeData($kpi)
       {

              //$kpi=str_replace(" ",'',$kpi);
              $details = $this->gaugeDetails($kpi);
              $rconfig = $this->gaugeConfig($kpi);
              if ($rconfig) {
                     $config = $this->gaugeConfig($kpi);
              } else {
                     $config = "
       {
        from: 0,
        to: 50,
        color: '#DC3545' //danger
      }, {
        from: 50,
        to: 80,
        color: '#FFC107' // amber
      }, {
        from: 80,
        to: 100,
        color: '#28A745' // green
       }
       ";
              }

              //$query= $this->db->query("SELECT MAX(period), CONCAT(period,'/',period_year) as cp, CONCAT(previous_period,'/',previousperiod_year) as pp, t.* from report_kpi_summary t WHERE trim(kpi_id)='$kpi'");
              $query = $this->db->query("SELECT  CONCAT(period,'/',period_year) as cp,kpi_id,period,financial_year,target_value as current_target,current_value from report_kpi_trend t WHERE trim(kpi_id)='$kpi' and period = (SELECT max(period) from  report_kpi_trend WHERE kpi_id='$kpi') and financial_year = (SELECT MAX(financial_year) from report_kpi_trend WHERE kpi_id='$kpi')");

              $period = $query->row()->period;
              $fy = $query->row()->financial_year;
              $previous_period = $this->db->query("SELECT MAX(period) as previous_period FROM `report_kpi_trend` WHERE period!='$period'  and financial_year='$fy' and kpi_id= '$kpi' ")->row()->previous_period;
              $query1 = $this->db->query("SELECT  CONCAT(period,'/',period_year) as pp, `period` as  pervious_period, `financial_year` as previous_financial_year, `period_year` as previousperiod_year, `current_value` as previous_value, `target_value` as previous_target FROM report_kpi_trend WHERE period='$previous_period' AND kpi_id='$kpi' AND financial_year ='$fy'");

              $result = array_merge((array) $query->row(), (array) $query1->row());

              $return = array("data" => (object) $result, "config" => $config, "details" => $details);

              return $return;
       }

       public function gaugeDetails($kpi){

	$query = $this->db->query("SELECT  * from kpi WHERE kpi.kpi_id='$kpi'");
	return $query->result();
}

//neeed fixing

public function gaugeConfig($kpi){
    $this->db->where("kpi", "$kpi");
	$query = $this->db->get("gauge_config");
	return $query->row()->config_json;
}

//END GAUGE

//KPI 0 TREND GRAPH DATA
public function dim0quaters($kpi){
    $quaters=array();
   $query = $this->db->query("SELECT  CONCAT( period,'-',period_year) as period,current_value FROM `report_kpi_trend` WHERE kpi_id='$kpi' order by period_year ASC, CHAR_LENGTH(period) ASC, period ASC")->result();

 foreach ($query as $periods){
     array_push($quaters,$periods->period);

 }
 return $quaters;
}
public function dim0data($kpi) {
        $datas=array();

       $query = $this->db->query("SELECT  current_value FROM `report_kpi_trend` WHERE kpi_id='$kpi' order by period_year ASC, CHAR_LENGTH(period) ASC, period ASC")->result();

 foreach ($query as $data){
     array_push($datas,$data->current_value);
    }
 return $datas;
}
public function dim0targets($kpi) {
       $datas = array();
       $query = $this->db->query("SELECT  target_value FROM `report_kpi_trend` WHERE  kpi_id='$kpi' order by period_year ASC, CHAR_LENGTH(period) ASC, period ASC")->result();
     foreach ($query as $data){
     array_push($datas,$data->target_value);
      }
return $datas;
}
//not deployed
public function dim0Graph($kpi) {
       $datas = array();
       $target = array();
       $periods = array();
       $query = $this->db->query("SELECT  target_value,period,current_value FROM `report_kpi_trend` WHERE  kpi_id='$kpi' order by period_year ASC, CHAR_LENGTH(period) ASC, period ASC")->result();
       $row_data = [];
     
foreach($query as $row):
       array_push($periods,$row->period);
endforeach;
foreach($query as $row): 
       array_push($datas,$row->current_value);
endforeach;
foreach($query as $row): 
       array_push($target,$row->target_value);
endforeach;

return array("quaters"=>$periods,"data"=>$datas,"target"=>$target);
}

//KPI TREND DIM1 GRAPH DATA


public function dim1Graph($kpi) {
       $datas = array();
       $dimesnions = array();
       $periods = array();
       $query = $this->db->query("SELECT  target_value, CONCAT( period,'-',period_year) as period,cal_value,dimension1,dimension1_key FROM `report_trend_dimension1` WHERE  kpi_id='$kpi' order by period_year ASC, CHAR_LENGTH(period) ASC, period ASC")->result();
       $row_data = [];
     
foreach($query as $row):
      if(!in_array($row->dimension1,$dimesnions)){
                  array_push($dimesnions,$row->dimension1);
          }
        if(!in_array($row->period,$periods)){
                  array_push($periods,$row->period);
        }
endforeach;

foreach($dimesnions as $dim):
        $row_data["data"] = [];
        $row_data["name"]= $dim;
       foreach($query as $row):
         if($row->dimension1 == $dim):
            $calVal = number_format($row->cal_value,1);
            array_push($row_data["data"],$calVal);
         endif;
       endforeach;
      array_push($datas,$row_data);
endforeach;

return array("quaters"=>$periods,"data"=>$datas);
}

public function dim2Graph($kpi) {
       $datas = array();
       $dimesnions = array();
       $periods = array();
       $query = $this->db->query("SELECT  target_value,CONCAT( period,'-',period_year) as period,cal_value,dimension1,dimension2,dimension2_key FROM `report_trend_dimension2` WHERE kpi_id='$kpi' order by period_year ASC, CHAR_LENGTH(period) ASC, period ASC")->result();
       $row_data = [];
     
foreach($query as $row):
      if(!in_array($row->dimension1." - ".$row->dimension2,$dimesnions)){
                  array_push($dimesnions,$row->dimension1." - ".$row->dimension2);
          }
        if(!in_array($row->period,$periods)){
                  array_push($periods,$row->period);
        }
endforeach;

foreach($dimesnions as $dim):
        $row_data["data"] = [];
        $row_data["name"]= $dim;
       foreach($query as $row):
         if($row->dimension1." - ".$row->dimension2 == $dim):
            $calVal = number_format($row->cal_value,1);
            array_push($row_data["data"],$calVal);
         endif;
       endforeach;
      array_push($datas,$row_data);
endforeach;

return array("quaters"=>$periods,"data"=>$datas);
}


public function dim3Graph($kpi) {
       $datas = array();
       $dimesnions = array();
       $periods = array();
       $query = $this->db->query("SELECT  target_value,CONCAT( period,'-',period_year) as period,cal_value,dimension3,dimension3_key FROM `report_trend_dimension3` WHERE  kpi_id='$kpi' order by period_year ASC, CHAR_LENGTH(period) ASC, period ASC")->result();
       $row_data = [];
     
foreach($query as $row):
      if(!in_array($row->dimension3,$dimesnions)){
                  array_push($dimesnions,$row->dimension3);
          }
        if(!in_array($row->period,$periods)){
                  array_push($periods,$row->period);
        }
endforeach;

foreach($dimesnions as $dim):
        $row_data["data"] = [];
        $row_data["name"]= $dim;
       foreach($query as $row):
         if($row->dimension3 == $dim):
            $calVal = number_format($row->cal_value,1);
            array_push($row_data["data"],$calVal);
         endif;
       endforeach;
      array_push($datas,$row_data);
endforeach;

return array("quaters"=>$periods,"data"=>$datas);
}





}
