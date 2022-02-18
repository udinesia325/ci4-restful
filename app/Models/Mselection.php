<?php

namespace App\Models;

use CodeIgniter\Model;

class Mselection extends Model
{
    protected $table            = 'selection';
    protected $primaryKey       = 'id_selection';
    protected $allowedFields    = ["from_place_id","to_place_id","id_schedule"];
}
