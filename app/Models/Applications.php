<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Applicant;

class Applications extends Model
{
    use HasFactory;

    protected $fillable =['comapny_id', 'title', 'tags', 'company', 'website', 'applicant_id'];

    public function applicant(){
        return $this->belongsTo(Applicant::class, 'applicant_id');
    }
}
