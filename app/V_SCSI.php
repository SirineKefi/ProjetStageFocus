<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class V_SCSI extends Model
{
    //
    private $id;
    private $isClientAdapter;
    private $isServerAdapter;
    private $isClientPartition;
    private $isServerPartition;
    private $isrequired;
    private $type_SCSI;
  

    public function getId(){
        return $this->id;
    }
    public function getIsClientAdapter(){
        return $this->isClientAdapter;
    }
    public function getIsServerAdapter(){
        return $this->isServerAdapter;
    }
    public function getIsClientPartition(){
        return $this->isClientPartition;
    }
    public function getIsServerPartition(){
        return $this->isServerPartition;
    }
    public function getIsrequired(){
        return $this->isrequired;
    }
    public function getType_SCSI(){
        return $this->type_SCSI;
    }
   
    public function setId($id){
        $this->id=$id;
    }
    public function setIsClientAdapter($isClientAdapter){
        $this->isClientAdapter=$isClientAdapter;
    }
    public function setIsClientPartition($isClientPartition){
        $this->isClientPartition=$isClientPartition;
    }
    public function setIsServerAdapter($isServerAdapter){
        $this->isServerAdapter=$isServerAdapter;
    }
    public function setIsServerPartition($isServerPartition){
        $this->isServerPartition=$isServerPartition;
    }
    public function setIsrequired($isrequired){
        $this->isrequired=$isrequired;
    }
    public function setType_SCSI($type_SCSI){
        $this->type_SCSI=$type_SCSI;
    }
    public function LPARs(){
        return $this->hasMany('\app\LPAR');
    }
    public function templates(){
        return $this->hasMany('\app\Template_profile');
    }
}
