<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listings extends Model
{
    // public static function all(){
    //     return [
    //         [
    //             'id'=>1,
    //             'title'=>'Listings',
    //             'description'=>'Listings description'

    //         ],
    //         [
    //             'id'=>2,
    //             'title'=>'Listings 2',
    //             'description'=>'Listings description 2'

    //         ],
    //         [
    //             'id'=>3,
    //             'title'=>'Listings32',
    //             'description'=>'Listings description32'

    //         ],
    //         ];
    // }
    // public static function find($id){
    //     $listings = self::all();
    //     foreach($listings as $listing)
    //     if($listing['id']==$id){
    //         echo $listing['title'];
    //         return $listing;
            
    //     }else{
    //         return [];
    //     }
    // }
    use HasFactory;

    protected $fillable =['title', 'company', 'location', 'website', 'email', 'description', 'tags','user_id'];

    public function scopeFilter($query, array $filters){
        if($filters['tag'] ?? false){
            $query->where('tags', 'like', '%'.request('tag').'%');
            //thats just sql query 
        }
        if($filters['search'] ?? false){
            $query->where('title', 'like', '%'.request('search').'%')
            ->orWhere('description', 'like', '%'.request('search').'%')
            ->orWhere('tags', 'like', '%'.request('search').'');
            //thats just sql query 
        }
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    

}
