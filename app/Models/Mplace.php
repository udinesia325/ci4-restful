<?php

namespace App\Models;

use CodeIgniter\Model;

class Mplace extends Model
{
    protected $table            = 'place';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ["name","latitude","longitude","x","y","image_path","description"];

}
