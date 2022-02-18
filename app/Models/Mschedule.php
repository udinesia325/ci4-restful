<?php

namespace App\Models;

use CodeIgniter\Model;

class Mschedule extends Model
{
    protected $table            = 'schedule';
    protected $primaryKey       = 'id_schedule';
    protected $allowedFields    = ["type","line","from_place_id","to_place_id","departure_time","arrival_time","distance","speed"];

}
