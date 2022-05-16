<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubSection extends Model
{
    use HasFactory;
    protected $fillable=['name' ,'status' , 'sub_section_id'];
    public function SubSection()
    {
        return $this->belongsTo(SubSection::class , 'section_id' , 'id');
    }

    // public function SubSubSubSection()
    // {
    //     return $this->hasMany(SubSubSubSection::class , 'sub_sub_section_id' , 'id');
    // }

    public function toArray()
    {
        return [
            'id'=> $this->id ,
            'name'=>$this->name ,    
        ];
    }
}
