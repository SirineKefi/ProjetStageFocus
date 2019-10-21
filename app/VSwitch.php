<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VSwitch extends Model
{
    //
    private $id;
    private $name;
    public function getId(){
       return $this->id;

    }
    public function getName(){
        return $this->name;
    }
    public function setId($id){
        $this->id=$id;
    }
    public function setName(){
         $this->name=$name;
    }
    public function Servers(){
        return $this->hasMany('\app\Server');
    }
}
