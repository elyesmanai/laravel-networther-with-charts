<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StorageController extends Controller
{
	private function savedata(){
		// get data from the form and encode it
				$post_data = array("name" => $_POST["name"], "reward" => $_POST["reward"], "hours" => $_POST["hours"], "type" => $_POST["type"], "kind" => $_POST["kind"]);
				$encoded = json_encode($post_data);
				foreach ($_POST as $i => $value) {
				    unset($_POST[$i]);
				}
				return $encoded;
	}
	private function loadanddel(){
		// load the data and delete the line from the array 
				$lines = file('jobs.json'); 
				$last = sizeof($lines) - 1 ; 
				unset($lines[$last]); 
				return $lines;
	}
	private function addcoma($encoded,$lines){

				// add a comma 
				$file = 'jobs.json';
				$string = implode(' ', $lines);
				$string = $string . ',' . $encoded  . "\r\n" . ']' ;
				file_put_contents($file, $string);
	}
	private function getdata(){
		$json_data = file_get_contents('jobs.json');
		$jobs = json_decode($json_data, true);
		return $jobs;
	}


	private function globalrate($jobs){

		$globalrate=0;
		$totalhours=0;	
		foreach ($jobs as $job) {		
			$globalrate +=  floatval($job['reward']);		
			$totalhours +=  floatval($job['hours']);
		}
		return round(($globalrate / $totalhours),2);
	}
	private function minglobalrate($jobs){

		$minrate=100000000;
		$rate=0;
		foreach ($jobs as $job) {		
			$rate =  floatval($job['reward']) / floatval($job['hours']);
			if($rate<$minrate){$minrate = $rate;}
		}
		return round($minrate,2);
	}
	private function maxglobalrate($jobs){

		$maxrate=0;
		$rate=0;
		foreach ($jobs as $job) {		
			$rate =  floatval($job['reward']) / floatval($job['hours']);
			if($rate>$maxrate){$maxrate = $rate;}
		}
		return round($maxrate,2);
	}


	private function devrate($jobs){

		$devrate=0;
		$totalhours=0;	
		foreach ($jobs as $job) {	
			if(strtoupper($job['type']) == 'DEVELOPMENT'){
			$devrate +=  floatval($job['reward']);		
			$totalhours +=  floatval($job['hours']);
			}	
		}
		return round(($devrate / $totalhours),2);
	}
	private function mindevrate($jobs){

		$minrate=100000000;
		$rate=0;
		foreach ($jobs as $job) {	
			if(strtoupper($job['type'])== 'DEVELOPMENT'){	
				$rate =  floatval($job['reward']) / floatval($job['hours']);
				if($rate<$minrate){$minrate = $rate;}
			}
		}
		return round($minrate,2);
	}
	private function maxdevrate($jobs){

		$maxrate=0;
		$rate=0;
		foreach ($jobs as $job) {	
			if(strtoupper($job['type'])== 'DEVELOPMENT'){	
				$rate =  floatval($job['reward']) / floatval($job['hours']);
				if($rate>$maxrate){$maxrate = $rate;}
			}
		}
		return round($maxrate,2);
	}


	private function teachrate($jobs){


		$devrate=0;
		$totalhours=0;	
		foreach ($jobs as $job) {	
			if(strtoupper($job['type'])== 'TEACHING'){
			$devrate +=  floatval($job['reward']);		
			$totalhours +=  floatval($job['hours']);
			}	
		}
		return round(($devrate / $totalhours),2);
	}
	private function minteachrate($jobs){

		$minrate=100000000;
		$rate=0;
		foreach ($jobs as $job) {	
			if(strtoupper($job['type'])== 'TEACHING'){	
				$rate =  floatval($job['reward']) / floatval($job['hours']);
				if($rate<$minrate){$minrate = $rate;}
			}
		}
		return round($minrate,2);
	}
	private function maxteachrate($jobs){

		$maxrate=0;
		$rate=0;
		foreach ($jobs as $job) {	
			if(strtoupper($job['type'])== 'TEACHING'){	
				$rate =  floatval($job['reward']) / floatval($job['hours']);
				if($rate>$maxrate){$maxrate = $rate;}
			}
		}
		return round($maxrate,2);
	}



	private function networthrate(){
	}

	public function __invoke()
		{
		   if(!empty($_POST)){
			$encoded =self::savedata();
			$lines = self::loadanddel();
			self::addcoma($encoded,$lines);
			}
			$jobs= self::getdata();
			$globalrate = self::globalrate($jobs);
			$maxglobalrate = self::maxglobalrate($jobs);
			$minglobalrate = self::minglobalrate($jobs);
			$devrate = self::devrate($jobs);
			$maxdevrate = self::maxdevrate($jobs);
			$mindevrate = self::mindevrate($jobs);
			$teachrate = self::teachrate($jobs);
			$maxteachrate = self::maxteachrate($jobs);
			$minteachrate = self::minteachrate($jobs);


		    return view('welcome')->with('jobs',$jobs)

		    					  ->with('globalrate',$globalrate)
		    					  ->with('minglobalrate',$minglobalrate)
		    					  ->with('maxglobalrate',$maxglobalrate)

		    					  ->with('devrate',$devrate)
		    					  ->with('mindevrate',$mindevrate)
		    					  ->with('maxdevrate',$maxdevrate)

		    					  ->with('teachrate',$teachrate)
		    					  ->with('minteachrate',$minteachrate)
		    					  ->with('maxteachrate',$maxteachrate);
		}
				 
}
