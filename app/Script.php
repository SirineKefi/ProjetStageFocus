<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Script extends Model
{
    //
    private $id;
    private $content;
    public function getId(){
        return $this->id;
    }
    public function getContent(){
        return $this->content;
    }
    public function setId($id){
        $this->id=$id;
    }
    public function setContent($content){
        $this->content=$content;
    }
    public function LPARs(){
        return $this->belongsTo('\app\LPAR');
    }
}
