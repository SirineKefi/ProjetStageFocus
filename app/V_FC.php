<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class V_FC extends Model
{
    //
    private $id;
    private $isrequired;
    private $server_partition;
    private $wwpn;
    private $wwpn_lpm;
    
    public function getId(){
        return $this->id;
    }
    public function getIsrequired(){
        return $this->isrequired;
    }
    public function getServer_adapter_id(){
        return $this->server_adapter_id;
    }
    public function getServer_partition(){
        return $this->server_partition;
    }
    public function getWwpn(){
        return $this->wwpn;
    }
    public function getWwpn_lpm(){
        return $this->wwpn_lpm;
    }
    public function setId($id){
        $this->id=$id;
    }
    public function setIsrequired($isrequired){
        $this->isrequired=$isrequired;
    }
    public function setServer_adapter_id($server_adapter_id){
        $this->server_adapter_id=$server_adapter_id;
    }
    public function setServer_partition($server_partition){
        $this->server_partition=$server_partition;
    }
    public function setWwpn($wwpn){
        $this->wwpn=$wwpn;
    }
    public function setWwpn_lpm($wwpn_lpm){
        $this->wwpn_lpm=$wwpn_lpm;
    }
    public function LPARs(){
        return $this->hasMany('\app\LPAR');
    }
    public function templates(){
        return $this->hasMany('\app\Template_profile');
    }
}
