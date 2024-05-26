<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'service', 'preferred_date', 'message', 'created_at'];
    // Set the field names for created_at and updated_at
}
