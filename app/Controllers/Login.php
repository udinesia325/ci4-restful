<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\{Mlogin};
class Login extends ResourceController
{
	protected $login;
	protected $session;
	public function __construct()
	{
		$this->login = new Mlogin();
	}
	public function index()
	{
		$data = $this->login->findAll();
		return $this->respond($data, 200);
	}
	public function login()
	{
		$username = $this->request->getVar("username");
		$password = $this->request->getVar("password");
		if (is_null($username) || is_null($password)) {
			return $this->failResponse("invalid login", 401);
		}
		$result = $this->login->db
			->table("login")
			->where("username", $username)
			->where("password", $password)
			->get()
			->getResultArray();
		if (count($result) == 0) {
			return $this->failResponse("invalid login", 401);
		}
		$data = [
			"token" => $result[0]["token"],
			"role" => $result[0]["role"],
		];
		session()->set("token", $data["token"]);

		session()->set("role", $data["role"]);
		return $this->respond($data, 200);
	}
	public function logout()
	{
		$token = $this->request->getGet("token");
		if ($token != session()->get("token")) {
			return $this->failResponse("unauthorized user", 401);
		}
		session()->destroy();
		return $this->respond(["message" => "logout success"], 200);
	}
	public function failResponse(string $msg, int $code)
	{
		return $this->respond(["message" => $msg], $code);
	}
}
