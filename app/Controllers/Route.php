<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\{Mplace, Mschedule, Mselection};
use Exception;

class Route extends ResourceController
{
	public $schedule;
	public $place;
	public $selection;
	public function __construct()
	{
		$this->schedule = new Mschedule();
		$this->place = new Mplace();
		$this->selection = new Mselection();
	}
	public function search($from_place, $to_place, $departure_time = null)
	{
		$token = $this->request->getGet("token");
		if ($token != session()->get("token")) {
			return $this->failResponse("unauthorized user", 401);
		}
		if (is_null($departure_time)) {
			$departure_time = date("H:i:s");
		}
		$fromPlace = $this->place->find($from_place);
		$toPlace = $this->place->find($to_place);
		if (is_null($fromPlace) || is_null($toPlace)) {
			return $this->failResponse("invalid place", 422);
		}
		try{
		$schedule = $this->schedule->db
			->table("schedule")
			->select("*")
			->join("place", "place.id = schedule.from_place_id")
		        ->where("from_place_id",$from_place)
			->where("to_place_id",$to_place)
			->get()
			->getResultArray()[0];
		}catch(Exception $e){
		    return $this->respond(["message"=>"invalid from place or to place"],400);
		}
		$schedule["travel_time"] = $this->calculateDate($schedule["departure_time"],$schedule["arrival_time"]);

		$data = [
		    "id"=>$schedule["id_schedule"],
		    "type"=>$schedule["type"],
		    "line"=>$schedule["line"],
		    "departure_time"=>$schedule["departure_time"],
		    "arrival_time"=>$schedule["arrival_time"],
		    "travel_time"=>$schedule["travel_time"],
		    "from_place"=>$fromPlace,
		    "to_place"=>$toPlace
		];
	return $this->respond($data,200);	
	}
	public function selection()
	 {
	     $token = $this->request->getGet("token") ;
	     if ($token != session()->get("token")) {
	        return $this->failResponse("unauthorized user",401); 
	     }
	     $this->selection->save( $this->request->getVar() );
	     return $this->respond(["message"=>"created success"],200);
	 }
	protected function calculateDate($departure , $arrive)
	{
	    $departure = strtotime($departure);
	    $arrive = strtotime($arrive);
	    $diff = $arrive - $departure;
	    $jam = floor($diff / 3600);
	    $menit = floor(($diff - $jam *60*60)/60);

	    return $jam == 0 ? "$menit minute(s)":"$jam hour(s) $menit minute(s)";
	}
	
}
