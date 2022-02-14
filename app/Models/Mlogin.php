<?php

namespace App\Models;

use CodeIgniter\Model;

class Mlogin extends Model
{
    protected $table            = 'login';
    protected $primaryKey       = 'id_user';
    protected $allowedFields    = ["username","password","token","role","role"];
}
