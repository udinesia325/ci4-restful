<?php

namespace App\Controllers;

use App\Models\Mschedule;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class Schedule extends ResourceController
{
	public $schedule;
	public function __construct()
	{
		$this->schedule = new Mschedule();
	}
	public function create()
	{
		$token = $this->request->getGet("token");
		if ($token != session()->get("token")) {
			return $this->failResponse("unauthorized user", 401);
		}
		try {
			$this->schedule->save($this->request->getPost());
			return $this->respond(["message" => "create success"], 200);
		} catch (Exception $e) {
			return $this->failResponse("data cannot be processed", 422);
		}
	}
	public function delete($id_schedule = null)
	{
		$token = $this->request->getGet("token");
		if ($token != session()->get("token")) {
			return $this->failResponse("unauthorized user", 401);
		}
		$this->schedule->delete($id_schedule);
		return $this->respond(["message" => "delete success"], 200);
	}
}
