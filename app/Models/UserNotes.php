<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotes extends Model
{
    protected $table = 'user_notes';
    public $timestamps = false;
    use HasFactory;
}
