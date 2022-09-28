<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable =['name', 'email', 'phone', 'gender', 'latest_degree', 'latest_institute', 'dob',
                          'cover_letter', 'present_address', 'cv' ,'user_id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
