<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable=['name' ,'status' , 'title_id'];
   // protected $with = ['SubSection'];
    
    public function Title()
    {
        return $this->belongsTo(Titles::class , 'title_id' , 'id');
    }

    public function SubSection()
    {
        return $this->hasMany(SubSection::class , 'section_id' , 'id');
    }

    public function toArray()
    {
        return [
            'id'=> $this->id ,
            'name'=>$this->name ,
           // 'options_count'=>$this->SubSection->count(),
           // 'options'=> $this->SubSection ?? [] ,
            
        ];
    }
   

}
