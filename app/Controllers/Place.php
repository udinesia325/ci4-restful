<?php

namespace App\Controllers;

use App\Models\Mplace;
use CodeIgniter\RESTful\ResourceController;

class Place extends ResourceController
{
	protected $place;
	public function __construct()
	{
		$this->place = new Mplace();
	}

	public function index($id = null)
	{
		$token = $this->request->getGet("token");
		if ($token != session()->get("token")) {
			return $this->failResponse("unauthorized user", 401);
		}
		if (is_null($id)) {
			$data = $this->place->findAll();
		} else {
			$data = $this->place->find($id);
		}

		return $this->respond($data, 200);
	}
	public function create()
	{
		$token = $this->request->getGet("token");
		if ($token != session()->get("token")) {
			return $this->failResponse("unauthorized user", 401);
		}

		$dataForm = $this->request->getPost();
		$image_path = $this->request->getFile("image");
		if (
			!$this->validate([
				"name" => "required",
				"longitude" => "required",
				"latitude" => "required",
				"x" => "required",
				"y" => "required",
				"description" => "required",
			])
		) {
			return $this->failResponse("data cannot be processed", 422);
		}

		$image_path->getSize() > 0
			? ($dataForm["image_path"] = $image_path->getName())
			: "default.jpg";
		$this->place->insert($dataForm);
		$image_path->move("img");
		return $this->respond(["message" => "create success"], 200);
	}
	public function edit($id = null)
	{
		$token = $this->request->getGet("token");
		if ($token != session()->get("token")) {
			return $this->failResponse("unauthorized user", 200);
		}
		$oldData = $this->place->find($id);

		$dataForm = $this->request->getPost();
		$dataForm["id"] = $id;
		$image_path = $this->request->getFile("image");
		if ($image_path != null) {
			if ($image_path->getSize() > 0) {
				$dataForm["image_path"] = $image_path->getName();
			}
		}

		$this->place->save($dataForm);
		if ($image_path != null) {
			if ($image_path->getSize() > 0) {
				if ($image_path->getName() != $oldData["image_path"]) {
					$image_path->move("img");

					unlink("img/" . $oldData["image_path"]);
				}
			}
		}

		return $this->respond(["message" => "update success"], 200);
	}
	public function delete($id = null)
	 {
	     $token = $this->request->getGet("token");
	     if ($token != session()->get("token")) {
	         return $this->failResponse("unauthorized user",200);
	     }
	     $this->place->delete($id);
	     return $this->respond(["message"=> "Delete success"],200);
	 }
}
