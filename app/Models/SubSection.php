<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSection extends Model
{
    use HasFactory;
    protected $table = 'sub_sections';
    protected $fillable=['name' ,'status' , 'section_id'];
   // protected $with = ['SubSubSection'];

    public function Section()
    {
        return $this->belongsTo(Section::class , 'section_id' , 'id');
    }

    public function SubSubSection()
    {
        return $this->hasMany(SubSubSection::class , 'sub_section_id' , 'id');
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
