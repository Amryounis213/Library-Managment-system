<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Titles extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $fillable = ['name' , 'status'];
    public function Section()
    {
        return $this->hasmany(Section::class , 'title_id' , 'id');
    }


    public function SubSection()
    {
        return $this->hasManyThrough(SubSection::class , Section::class , 'title_id');
    }

    
    public function SubSubSection()
    {
        return $this->hasManyDeep(SubSubSection::class , [Section::class ,  SubSection::class] , ['title_id' , 'section_id' , 'sub_section_id']);
    }





}
