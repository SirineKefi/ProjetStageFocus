<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Physical_IO extends Model
{
    private $id;
    private $index_slot;
    private $isdesired;
    private $isrequired;
    private $type;

    public function getId(){
        return $this->id;
    }
    public function getIndex_slot(){
        return $this->index_slot;
    }
    public function getIsdesired(){
        return $this->isdesired;
    }
    public function getIsrequired(){
        return $this->isrequired;
    }
    public function getType(){
        return $this->type;
    }
    public function setId($id){
        $this->id=$id;
    }
    public function setIndex_slot($index_slot){
        $this->index_slot=$index_slot;
    }
    public function setIsdesired($isdesired){
        $this->isdesired=$isdesired;
    }
    public function setIsrequired($isrequired){
        $this->isrequired=$isrequired;
    }
    public function setType($type){
        $this->type=$type;
    }
    public function LPARs(){
        return $this->hasMany('\app\LPAR');
    }
    public function templates(){
        return $this->hasMany('\app\Template_profile');
    }
}
