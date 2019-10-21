<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LPAR extends Model
{
    //
    private $id;
    private $disired_memory;
    private $disired_proc_units ;
    private $disired_v_proc ;
    private $LPAR_name ;
    private $LPAR_type ;
    private $max_memory ;
    private $max_proc_units ;
    private $max_v_adapters;
    private $max_v_proc;
    private $partition_Id;
    private $partition_name;
    private $proc_pool;
    private $profil_name;
    private $shared;

    private $isAuto_StartWithMangedSys;
    private $isEnable_Connection_Monitoring;
    private $isEnable_redundant_Error_Path_report;
    private $isNormal_BootMode;
    private $isSMS_BootMode;

    public function getIsAuto_StartWithMangedSys(){
        return $this->isAuto_StartWithMangedSys;
    }
    public function getIsEnable_Connection_Monitoring(){
        return $this->isEnable_Connection_Monitoring;
    }
    public function getIsEnable_redundant_Error_Path_report(){
        return $this->isEnable_redundant_Error_Path_report;
    }
    public function getIsNormal_BootMode(){
        return $this->is;
    }
    public function getIsSMS_BootMode(){
        return $this->isSMS_BootMode;
    }
    public function setIsAuto_StartWithMangedSys($isAuto_StartWithMangedSys){
        $this->isAuto_StartWithMangedSys=$isAuto_StartWithMangedSys;
    }
    public function setIsEnable_Connection_Monitoring($isEnable_Connection_Monitoring){
        $this->isEnable_Connection_Monitoring=$isEnable_Connection_Monitoring;
    }
    public function setIsEnable_redundant_Error_Path_report($isEnable_redundant_Error_Path_report){
        $this->isEnable_redundant_Error_Path_report=$isEnable_redundant_Error_Path_report;
    }
    public function setIsNormal_BootMode($isNormal_BootMode){
        $this->isNormal_BootMode=$isNormal_BootMode;
    }
    public function setIsSMS_BootMode($issSMS_BootMode){
        $this->isSMS_BootMode=$isSMS_BootMode;
    }
    public function setId($id){
        $this->id=$id;
    }
    public function setDisired_memory($disired_memory){
        $this->disired_memory=$disired_memory;
    }
    public function setDisired_proc_units($disired_proc_units){
        $this->disired_proc_units=$disired_proc_units;
    }
    public function setDisired_v_proc($disired_v_proc){
        $this->disired_v_proc=$disired_v_proc;
    }
    public function setLPAR_name($LPAR_name){
        $this->LPAR_name=$LPAR_name;
    }
    public function setLPAR_type($LPAR_type){
        $this->LPAR_type=$LPAR_type;
    }
    public function setMax_memory($max_memory){
        $this->max_memory=$max_memory;
    }
    public function setMax_proc_units ($max_proc_units ){
        $this->max_proc_units =$max_proc_units ;
    }
    public function setMax_v_adapters ($max_v_adapters){
        $this->max_v_adapters =$max_v_adapters ;
    }
    public function setMax_v_proc ($max_v_proc){
        $this->max_v_proc =$max_v_proc ;
    }
    public function setPartition_Id ($partition_Id){
        $this->partition_Id =$partition_Id ;
    }
    public function setPartition_name ($partition_name){
        $this->partition_name =$partition_name ;
    }
    public function setProc_pool($proc_pool){
        $this->proc_pool =$proc_pool ;
    }
    public function setProfil_name($profil_name){
        $this->profil_name =$profil_name ;
    }
    public function setShared($shared){
        $this->shared =$shared ;
    }
    public function getId(){
        return $this->id;
    }
    public function getDisired_memory(){
        return $this->disired_memory;
    }
    public function getDisired_proc_units(){
        return $this->disired_proc_units;
    }
    public function getDisired_v_proc(){
        return $this->disired_v_proc;
    }
    public function getLPAR_name(){
        return $this->LPAR_name;
    }
    public function getLPAR_type(){
        return $this->LPAR_type;
    }
    public function getMax_memory(){
        return $this->max_memory;
    }
    public function getMax_proc_units(){
        return $this->max_proc_units;
    }

    public function getMax_v_adapters(){
        return $this->max_v_adapters;
    }
    public function getMax_v_proc(){
        return $this->max_v_proc;
    }
    public function getPartition_Id(){
        return $this->partition_Id;
    }
    public function getPartition_name(){
        return $this->partition_name;
    }
    public function getProc_pool(){
        return $this->proc_pool;
    }
    public function getProfil_name(){
        return $this->profil_name;
    }
    public function getShared(){
        return $this->shared;
    }
    public function Servers(){
        return $this->hasMany('\app\Server');
    }
    public function Scripts(){
        return $this->hasOne('\app\Script');
    }
    public function getMin_memory(){
        return $this->min_memory;
    }
    public function getMin_proc_units(){
        return $this->min_proc_units;
    }
    public function getMin_v_proc(){
        return $this->min_v_proc;
    }
    ////
    public function setMin_memory($min_memory){
        $this->min_memory =$min_memory ;
    }
    public function setMin_proc_units($min_proc_units){
        $this->min_proc_units =$min_proc_units ;
    }
    public function setMin_v_proc($min_v_proc){
        $this->min_v_proc =$min_v_proc ;
    }
    public function Template(){
        return $this->hasMany('\app\Template_profile');
    }
    public function V_FCs(){
        return $this->belongsTo('\app\V_FC');
    }
    public function V_ethernets(){
        return $this->belongsTo('\app\V_ethernet');
    }
    public function V_SCSIs(){
        return $this->belongsTo('\app\V_SCSI');
    }
    public function Physical_IOs(){
        return $this->belongsTo('\app\Physical_IO');
    }
}
