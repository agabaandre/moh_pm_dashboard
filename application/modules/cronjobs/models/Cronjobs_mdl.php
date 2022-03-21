<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cronjobs_mdl extends CI_Model {

	
public function __Construct(){

		parent::__Construct();
		$this->db->query('SET SESSION sql_mode = ""');
//financial_year is from settings financial Year/ allows 1 2 for current and previous year respectively
$this->financial_year=$this->financialYear();

//add another period if it exits in KPIS and handle it.

}
public function sessfinancialYear($financial_year=FALSE){
	 $query=$this->db->get('setting');
	 $result=$query->row();
if(empty($financial_year)){
	  // unset($_SESSION['financial_year']);
return $_SESSION['financial_year']=str_replace(" ","",$result->financial_year);
	 }
else{
	//  unset($_SESSION['financial_year']);
return $_SESSION['financial_year']=str_replace(" ","",$this->input->post('financial_year'));
}
}
public function financialYear($financial_year=FALSE){
	$query=$this->db->get('setting');
	$result=$query->row();
return $result->financial_year;
}





public function period($kpi){

	$query=$this->db->query("SELECT MAX(CONCAT(period_year,'-',period)) as period from new_data WHERE trim(kpi_id)='$kpi'");
    
$data=$query->result();
$mperiod = substr($data[0]->period, '5');
$fmperiod=str_replace("Q","",$mperiod);
return $fmperiod;
  
}
public function periodlimits($kpi){

if ($this->getkpiType($kpi)=="Quarterly"){
return $this->period=str_replace(" ","", "Q".$this->period($kpi));
}
elseif ($this->getkpiType($kpi)=="Annual"){
return $this->period=str_replace(" ","",$this->period($kpi));
}
elseif ($this->getkpiType($kpi)=="Monthly"){
return  $this->period=str_replace(" ","",$this->period($kpi));
}

}
public function preperiodlimits($kpi){

if ($this->getkpiType($kpi)=="Quarterly"){
$this->period=str_replace(" ","", "Q".$this->period($kpi));
return $this->preperiod=@str_replace(" ","", "Q".($this->period($kpi)-1));
}
elseif ($this->getkpiType($kpi)=="Annual"){
$this->period=str_replace(" ","",$this->period($kpi));
return $this->preperiod=str_replace(" ","", $this->period($kpi)-1);
}
elseif ($this->getkpiType($kpi)=="Monthly"){
$this->period=str_replace(" ","",$this->period($kpi));
$dateObj   = DateTime::createFromFormat('!m', $this->period);
$monthName = $dateObj->format('F');
$newdate = date("F", strtotime ( '-1 month' , strtotime ( $monthName) )) ;
 $value=date('m', strtotime($newdate));
 return str_replace("0","",$value);

}

}

//data for the gauge recent period
public function gaugeData($kpi,$financial_year){

	 $period=str_replace(" ","",$this->periodlimits($kpi));

	 $computation="ROUND((SUM(numerator) / SUM(denominator)*100),0)";

	$query = $this->db->query("SELECT $computation  as current_value, replace(CONCAT(kpi_id,period,financial_year),' ','') as entry_id, kpi_id,period_year, financial_year,data_target as current_target, period from new_data WHERE kpi_id='$kpi' and financial_year='$financial_year' and trim(period)='$period' and replace(CONCAT(kpi_id,period,financial_year),' ','') not in (SELECT entry_id from report_kpi_summary)");
	$gauge_value=$query->row();
    
   if (!empty($gauge_value->current_value))
   $this->db->replace('report_kpi_summary',$gauge_value); 
  //$this->log_message($query);
return $this->db->affected_rows(). "Records - Current  & previous Gauge Details" . $kpi;;
  
}

//data for the gauge previous period
public function previousgaugeData($kpi,$fy){

    $period=str_replace(" ","",$this->periodlimits($kpi));
	$preperiod = str_replace(" ","",$this->preperiodlimits($kpi));
	$computation="ROUND((SUM(numerator) / SUM(denominator)*100),0)";
  //sum
	$query = $this->db->query("SELECT $computation as previous_value, replace(CONCAT(kpi_id,'$period',financial_year),' ','') as entry_id,period_year as previousperiod_year, financial_year as previous_financial_year, data_target as previous_target, period as previous_period from new_data WHERE trim(kpi_id)='$kpi' and trim(financial_year)='$fy' and trim(period)='$preperiod'");
	$prev_gaugeData=$query->row();
           
	$this->updateGauge($prev_gaugeData,$prev_gaugeData->entry_id);
//    $this->db->where('entry_id', $entry_id);
// $this->db->update('report_kpi_summary', $prev_gaugeData);

return $this->db->affected_rows(). "Records - Previous Gauge Details Update for" . $kpi;
  
}
public function updateGauge($prev_gaugeData,$entry_id){
	$this->db->where('entry_id', $entry_id);
	$this->db->update('report_kpi_summary', $prev_gaugeData);
return $this->db->affected_rows();

}

//all periods
public function getallperiods($kpi,$fy){
    $queryp=$this->db->query("SELECT DISTINCT period from new_data where trim(financial_year)='".$fy."' and kpi_id='".$kpi."' order by period ASC");
	
	return $resps=$queryp->result();

}
//dimension 0
public function dimension0Data($kpi,$fy){
	//get available financial years from the datasets
    $computation="ROUND((SUM(numerator) / SUM(denominator)*100),0)";
	$allps=$this->getallperiods($kpi,$fy);
	$barperiodTotals = array();
	foreach ($allps as $resp):
		$value=str_replace(" ","",$resp->period);
		$query1 = $this->db->query("SELECT $computation as current_value,period_year,kpi_id ,replace(CONCAT(kpi_id,period,financial_year),' ','') as entry_id, MAX(data_target) as target_value, financial_year, period from new_data WHERE kpi_id='$kpi' and trim(financial_year) = '$fy' and trim(period) = '$value' and replace(CONCAT(kpi_id,period,financial_year),' ','') not in (SELECT entry_id from report_kpi_trend)");
		$result1=$query1->row();
	    if(!empty($result1))
		array_push($barperiodTotals,$result1);  
	endforeach;

	if(!empty($barperiodTotals))
	//  $this->truncateTable('report_kpi_trend');
	 $this->db->insert_batch("report_kpi_trend",$barperiodTotals);
	//fix for empty columns
	$this->db->query("DELETE from report_kpi_trend where kpi_id IS NULL");
	return $this->db->affected_rows(). 'Records - Dimension0 Data entered for'. $kpi;
}
public function truncateTable($table){
	$this->db->query("TRUNCATE TABLE $table");
 return 1;
}
//dimension 11
public function dimension1Data($kpi,$fy){
	//$kpi='KPI-11';
	$dim1  = $this->dimension1($kpi,$fy);
	$allps = $this->getallperiods($kpi,$fy);
	$allDimesiondata = array(); // data for all period, all dimensions
	$insertable = array(); 
	$sereis_data= array();
	$row_data=array();
	$graphData = array();
	$computation="ROUND((SUM(numerator) / SUM(denominator)*100),0)";
	$count=0;
	foreach ($allps as $resp):
		$period_data = array(); //for each period
		$period = str_replace(" ","",$resp->period);
		foreach($dim1 as $dm):
			$count++;
			$dms1   = str_replace(" ","",$dm->dimension1);
		    $query1 = $this->db->query(
				"SELECT $computation as cal_value, 
			    data_target as target_value,
				 dimension1_key, kpi_id, period_year, replace(CONCAT(kpi_id,period,financial_year,dimension1),' ','') as entry_id, dimension1, financial_year, 
				 period from new_data 
				 WHERE trim(kpi_id) = trim('$kpi') 
				 and trim(financial_year) = trim('$fy')
				 and trim(period) = trim('$period')
				 and replace(CONCAT(kpi_id,period,financial_year,dimension1),' ','') not in (SELECT entry_id from report_trend_dimension1)
				 and replace(dimension1,' ','') = '$dms1'
				 ") ->row(); 
				 array_push($period_data,$query1);
				 if(!empty($query1->dimension1))
				 array_push($insertable ,$query1);
			
		endforeach;
		
    endforeach;
	 if(!empty($insertable))
	//print_r($insertable);
	// print_r($period_data);
	//$this->truncateTable('report_trend_dimension1');
	 $this->db->insert_batch('report_trend_dimension1',$insertable);
	 $this->db->query("DELETE from report_trend_dimension1 where kpi_id IS NULL");
	return  $this->db->affected_rows(). 'Records - Dimension 1 data inserted for'. $kpi;
}

//dimension2
public function dimension2Data($kpi,$fy){

	$dim1  = $this->dimension1($kpi,$fy);
	$dim2  = $this->dimension2($kpi,$fy);
	$allps = $this->getallperiods($kpi,$fy);
	$allDimesiondata = array(); // data for all period, all dimensions
	$insertable = array();
	$computation="ROUND((SUM(numerator) / SUM(denominator)*100),0)";
	$dimensionTwoData = array();
		foreach ($allps as $resp):
			$period_data = array(); //for each period
			$period = str_replace(" ","",$resp->period);
			foreach($dim2 as $dm):
				$dms2   = str_replace(" ","",$dm->dimension2);
				$query1 = $this->db->query(
					"SELECT $computation as cal_value,period_year, replace(CONCAT(kpi_id,period,financial_year,dimension2),' ','') as entry_id, kpi_id,
					MAX(data_target) as target_value,
					dimension2_key, dimension2,dimension1_key, dimension1, financial_year, 
					period from new_data 
					WHERE kpi_id = '$kpi' 
					and trim(financial_year) = '$fy'
					and trim(period) = '$period' and replace(CONCAT(kpi_id,period,financial_year,dimension2),' ','') not in (SELECT replace(CONCAT(kpi_id,period,financial_year,dimension2),' ','') from report_trend_dimension2)
					and replace(dimension2,' ','') ='$dms2'")->row(); 
					if(!empty($query1)):
					 array_push($period_data,$query1);
					 array_push($insertable ,$query1);
					endif;
			endforeach;
			$allDimesiondata[$period] = $period_data; 
		endforeach;
	if(!empty($insertable))
	$table='report_trend_dimension2';
	// $this->truncateTable($table);
	 $this->db->insert_batch('report_trend_dimension2',$insertable);
	$this->db->query("DELETE from report_trend_dimension2 where kpi_id IS NULL");
	return $this->db->affected_rows(). 'Records - Dimension 2 data inserted for'. $kpi;
}
//dimension3
public function dimension3Data($kpi,$fy){
	$dim1  = $this->dimension1($kpi,$fy);
	$dim2  = $this->dimension2($kpi,$fy);
	$dim3  = $this->dimension3($kpi,$fy);
	$allps = $this->getallperiods($kpi,$fy);
	$computation="ROUND((SUM(numerator) / SUM(denominator)*100),0)";
	$periodsdata = array(); // data for all period, all dimensions
	$insertable = array();
	$dimensionTwoData = array(); //2nd highest
	$dimensionOneData = array(); //highest level
		foreach ($allps as $resp):
			$period_data = array(); //for each period
			$period = str_replace(" ","",$resp->period);
			foreach($dim3 as $dm):
				$dms3   = str_replace(" ","",$dm->dimension3);
				$query1 = $this->db->query(
					"SELECT $computation as cal_value, kpi_id,period_year,
					MAX(data_target) as target_value,
					dimension3_key, dimension3,dimension2_key, replace(CONCAT(kpi_id,period,financial_year,dimension3),' ','') as entry_id, dimension2,dimension1_key, dimension1, financial_year, 
					period from new_data 
					WHERE kpi_id = '$kpi'
					and trim(financial_year) = '$fy'
					and trim(period) = '$period' and replace(CONCAT(kpi_id,period,financial_year,dimension3),' ','') not in (SELECT entry_id from report_trend_dimension3)
					and replace(dimension3,' ','') ='$dms3'")->row();
					if(!empty($query1)): 
					 array_push($period_data,$query1);
					 array_push($insertable ,$query1);
					endif;
			endforeach;
		endforeach;
	 if(!empty($insertable))
	//  $this->truncateTable('report_trend_dimension3');
	 $this->db->insert_batch('report_trend_dimension3',$insertable);
	 $this->db->query("DELETE from report_trend_dimension3 where kpi_id IS NULL");
	return $this->db->affected_rows(). 'Records - Dimension 3 data inserted for'. $kpi;
}
 //get dimension1
public function  dimension1($kpi,$fy){
	$query=$this->db->query("SELECT distinct kpi_id,dimension1,dimension1_key from new_data where kpi_id='$kpi' and trim(financial_year) = '$fy'");
return $query->result(); 
}
 //get dimension2
public function  dimension2($kpi,$fy){
	$query=$this->db->query("SELECT distinct kpi_id,dimension2,dimension2_key from new_data where kpi_id='$kpi' and trim(financial_year) = '$fy'");
    return $query->result(); 
}
 //get dimension3
public function  dimension3($kpi,$fy){
	$query=$this->db->query("SELECT distinct kpi_id,dimension3,dimension3_key from new_data where kpi_id='$kpi' and trim(financial_year) = '$fy'");
return $query->result(); 
}
public function kpi_name($kpi){  
    $query=$this->db->query("SELECT distinct indicator_statement from kpi where kpi_id='$kpi'");
$res=$query->row();
return $res->indicator_statement;
}
public function  dimalldisplay($kpi){
	$query=$this->db->query("SELECT distinct dimension1_key,dimension2_key,dimension3_key,kpi_id from new_data where kpi_id='$kpi' and trim(financial_year) = '$this->financial_year'");
return $query->result(); 
}
//get KPI IDS with data for table popluation. cron jobs
public function getkpiids(){
return $this->db->query("SELECT DISTINCT kpi_id from new_data")->result();
}

public function getkpiType($kpi){
 $query = $this->db->query("SELECT DISTINCT frequency from kpi where kpi_id='$kpi'")->row();
return $query->frequency;
}

public function isCummulative($kpi){
 $query = $this->db->query("SELECT  is_cumulative from kpi where kpi_id='$kpi'")->row();
return $query->is_cumulative;


}






}
