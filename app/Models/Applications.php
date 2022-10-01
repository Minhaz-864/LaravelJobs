<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Applicant;
use App\Models\User;

class Applications extends Model
{
    use HasFactory;

    protected $fillable =['comapny_id', 'title', 'tags', 'company', 'website', 'applicant_id', 'listing_id', 'user_id', 'cover_letter'];

    public function applicant(){
        return $this->belongsTo(Applicant::class, 'applicant_id');
    }
    public function job_applications(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
