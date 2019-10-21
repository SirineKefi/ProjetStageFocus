<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    private $id;
    private $Client_adresse;
    private $Client_description;
    private $Client_mail;
    private $Client_name;
  
    public function getId(){
        return $this->id;
    }
    public function getClient_adresse(){
        return $this->Client_adresse;
    }
    public function getClient_description(){
        return $this->Client_description;
    }
    public function getClient_mail(){
        return $this->Client_mail;
    }
    public function getClient_name(){
        return $this->Client_name;
    }
    
    ///////
    public function setId($id){
        $this->id=$id;
    }
    public function setClient_adresse($Client_adresse){
        $this->Client_adresse=$Client_adresse;
    }
    public function setClient_description($Client_description){
        $this->Client_description=$Client_description;
    }
    public function setClient_mail($Client_mail){
        $this->Client_mail=$Client_mail;
    }
    public function setClient_name($Client_name){
        $this->Client_name=$Client_name;
    }
    
    public function Servers(){
        return $this->belongsTo('\app\Server');
    }
    public function Template_profile(){
        return $this->belongsTo('\app\Template_profile');
    }
}
