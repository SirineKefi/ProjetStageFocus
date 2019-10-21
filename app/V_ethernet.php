<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class V_ethernet extends Model
{
    //
    private $id;
    private $isrequired;
    private $PV_id;
   
    private $VLANs;

    public function getId(){
        return $this->id;
    }
    public function getIsrequired(){
        return $this->isrequired;
    }
   
    
    public function getVLANs(){
        return $this->VLANs;
    }
    public function getPV_id(){
        return $this->PV_id;
    }
    public function setId($id){
        $this->id=$id;
    }
    public function setIsrequired($isrequired){
        $this->isrequired=$isrequired;
    }
    public function setPV_id($PV_id){
        $this->PV_id=$PV_id;
    }
    public function setVLANs($VLANs){
        $this->VLANs=$VLANs;
    } 
    public function LPARs(){
        return $this->hasMany('\app\LPAR');
    }
    public function templates(){
        return $this->hasMany('\app\Template_profile');
    }
}
