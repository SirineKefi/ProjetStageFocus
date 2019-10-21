<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateLPARRequest;
use App\Http\Requests\CreatePhysicalIORequest;
use App\Http\Requests\CreateEthernetRequest;
use App\Http\Requests\CreateFCRequest;
use App\Http\Requests\CreateSCSIRequest;

use App\LPAR;
use App\Client;
use App\Server;
use App\VSwitch;

use App\Physical_IO;
use App\V_SCSI;
use App\V_ethernet;
use App\V_FC;


use DB;
use App\Quotation;
class LparController extends Controller
{
    public function delete($id_c,$id_s,$id) {        
        $lpar=LPAR::find($id);
        
        $client=Client::find($id_c);
        $server=Server::find($id_s);
        $lpar->delete();
        $server->Server_LPARs_nbr=$server->Server_LPARs_nbr-1;
        $server->save();
        $array = DB::table('l_p_a_r_s')
                    ->where('Server_FK_id', '=',$id_s )->where('LPAR_name', '!=',null)
                    ->get();

 $templates = DB::table('template_profiles')
    ->where('Client_FK_id', '=',$client->id )->where('template_name', '!=',null )->get();
                  
        return view('/ViewClient_Server_lpars',compact('templates','server','array','client'));
        
    }
      
    public function go_edit($id_c,$id_s,$id){
        
        
        $lpar=LPAR::find($id);
        $client=Client::find($id_c);
        $server=Server::find($id_s);

        if($lpar->Template_FK_id==null){
        $array = DB::table('physical__i_o_s')
        ->where('template_FK_id', '=',null )->where('LPAR_FK_id','=',$id)->get();
       
        $array1 = DB::table('v__f_c_s')
        ->where('Template_FK_id', '=',null)->where('LPAR_FK_id','=',$id)->get(); 
        
        $array2 = DB::table('v_ethernets')
        ->where('Template_FK_id', '=',null )->where('LPAR_FK_id','=',$id)->get();
        
        $vswitchs = DB::table('V_switches')->get();
    
        $array3 = DB::table('v__s_c_s_i_s')
        ->where('Template_FK_id', '=',null )->where('LPAR_FK_id','=',$id)->get();
        }
        else{
            $array = DB::table('physical__i_o_s')
            ->where('template_FK_id', '=',$lpar->Template_FK_id )->where('LPAR_FK_id','=',null)->get();
           
            $array1 = DB::table('v__f_c_s')
            ->where('Template_FK_id', '=',$lpar->Template_FK_id )->where('LPAR_FK_id','=',null)->get(); 
            
            $array2 = DB::table('v_ethernets')
            ->where('Template_FK_id', '=',$lpar->Template_FK_id  )->where('LPAR_FK_id','=',null)->get();
            
            $vswitchs = DB::table('V_switches')->get();
        
            $array3 = DB::table('v__s_c_s_i_s')
            ->where('Template_FK_id', '=',$lpar->Template_FK_id  )->where('LPAR_FK_id','=',null)->get();
       
        }
        $array4 = DB::table('l_p_a_r_s')
        ->where('Server_FK_id', '=',$server->id )->where('LPAR_name', '!=',null )->get();
        $array5 = DB::table('l_p_a_r_s')
        ->where('Server_FK_id', '=',$server->id )->where('LPAR_name', '!=',null )->where('env','=','VIOS')->get();
     
           
        return view('Edit_Lpar',compact('server',"array4",'array5','vswitchs','client','lpar','array','array1','array2','array3'));
    }
    public function edit($id_c,$id_s,$id){
        
        
        $lpar=LPAR::find($id);
        $client=Client::find($id_c);
        $server=Server::find($id_s);
        if($lpar->Template_FK_id==null){
        $array = DB::table('physical__i_o_s')
        ->where('template_FK_id', '=',null )->where('LPAR_FK_id','=',$id)->get();
       
        $array1 = DB::table('v__f_c_s')
        ->where('Template_FK_id', '=',null)->where('LPAR_FK_id','=',$id)->get(); 
        
        $array2 = DB::table('v_ethernets')
        ->where('Template_FK_id', '=',null )->where('LPAR_FK_id','=',$id)->get();
        
        $vswitchs = DB::table('V_switches')->get();
    
        $array3 = DB::table('v__s_c_s_i_s')
        ->where('Template_FK_id', '=',null )->where('LPAR_FK_id','=',$id)->get();
        }
        else{
            $array = DB::table('physical__i_o_s')
            ->where('template_FK_id', '=',$lpar->Template_FK_id )->where('LPAR_FK_id','=',null)->get();
           
            $array1 = DB::table('v__f_c_s')
            ->where('Template_FK_id', '=',$lpar->Template_FK_id )->where('LPAR_FK_id','=',null)->get(); 
            
            $array2 = DB::table('v_ethernets')
            ->where('Template_FK_id', '=',$lpar->Template_FK_id  )->where('LPAR_FK_id','=',null)->get();
            
            $vswitchs = DB::table('V_switches')->get();
        
            $array3 = DB::table('v__s_c_s_i_s')
            ->where('Template_FK_id', '=',$lpar->Template_FK_id  )->where('LPAR_FK_id','=',null)->get();
            
        }
        return view('View_LPAR',compact('server','vswitchs','client','lpar','array','array1','array2','array3'));
    }
    public function Gotoadd($id_s){
        $lpar=new LPAR();
        $lpar->Server_FK_id=$id_s;
        $lpar->max_v_adapters=0;
        $server=Server::find($id_s);
        $client=Client::find($server->Client_FK_id);
        $server->Server_LPARs_nbr=$server->Server_LPARs_nbr+1;
        $lpar->save();

        
        
        $vswitchs = DB::table('V_switches')->get();
       

        $array = DB::table('physical__i_o_s')
        ->where('template_FK_id', '=',null )->where('LPAR_FK_id','=',$lpar->id)->get();
       
        $array1 = DB::table('v__f_c_s')
        ->where('Template_FK_id', '=',null)->where('LPAR_FK_id','=',$lpar->id)->get(); 
        
        $array2 = DB::table('v_ethernets')
        ->where('Template_FK_id', '=',null )->where('LPAR_FK_id','=',$lpar->id)->get();
        
    
        $array3 = DB::table('v__s_c_s_i_s')
        ->where('Template_FK_id', '=',null )->where('LPAR_FK_id','=',$lpar->id)->get();
        
        $array4 = DB::table('l_p_a_r_s')
        ->where('Server_FK_id', '=',$server->id )->where('LPAR_name', '!=',null )->get();
        $array5 = DB::table('l_p_a_r_s')
        ->where('Server_FK_id', '=',$server->id )->where('LPAR_name', '!=',null )->where('env','=','VIOS')->get();
     
        return(view('New_LPAR',compact('array5',"array4","vswitchs",'lpar','array','array1','array2','array3','client')));

    }
    public function CreateLPAR(CreateLPARRequest $request, $id){

        $lpar=LPAR::find($id);
        $server=Server::find($lpar->Server_FK_id);
        $client=Client::find($server->Client_FK_id);
        $lpar->LPAR_name =$request->input('template_name_hidden');
        $lpar->profil_name  =$request->input('profile_name_hidden');
        //die($request->input('env_hidden'));
        $lpar->env=$request->input('env_hidden');
        $lpar->sharing_mode=$request->input('uncap_hidden');
        $lpar->LPAR_id=$request->input('LPAR_id_hidden');
        $lpar->min_memory =$request->input('value_hidden');
        $lpar->disired_memory  =$request->input('value1_hidden');
        $lpar->max_memory =$request->input('value2_hidden');
       if($request->input('radio_hidden')=='Shared'){
           $lpar->shared=TRUE;
            if($request->input('proc_pool_hidden')=="Other pool"){
                $lpar->proc_pool =$request->input('input_pool_hidden');
            }
            else{
                $lpar->proc_pool =$request->input('proc_pool_hidden');
            }
           $lpar->max_proc_units =$request->input('max_proc_units_hidden');
           $lpar->min_proc_units =$request->input('min_proc_units_hidden');
           $lpar->disired_proc_units =$request->input('desired_proc_units_hidden');
           $lpar->disired_v_proc  =$request->input('desired_v_proc_hidden');
           $lpar->min_v_proc  =$request->input('min_v_proc_hidden');
           $lpar->max_v_proc  =$request->input('max_v_proc_hidden');
           $lpar->uncap_weight =$request->input('uncap_weigth_hidden');
           $lpar->desired_proc =0;
           $lpar->min_proc=0;
           $lpar->max_proc=0;
       } 
       else{
        $lpar->shared=FALSE;

        ////
        $lpar->proc_pool='';
        $lpar->max_proc_units=0;
        $lpar->min_proc_units=0;
        $lpar->disired_proc_units=0;
        $lpar->disired_v_proc=0;
        $lpar->min_v_proc=0;
        $lpar->max_v_proc=0;
        $lpar->uncap_weight=0;
        ////
        $lpar->desired_proc  =$request->input('desired_proc_hidden');
        $lpar->min_proc  =$request->input('min_proc_hidden');
        $lpar->max_proc  =$request->input('max_proc_hidden');
        $lpar->uncap_weight =$request->input('0');

        } 
        $lpar->max_v_adapters=$request->input('max_v_adapters_hidden3');
        if($request->input('boot_mode_hidden')=='sms'){
            $lpar->isSMS_BootMode=1;
            $lpar->isNormal_BootMode=0;
        }
        else{
            $lpar->isSMS_BootMode=0;
            $lpar->isNormal_BootMode=1;
        }
        if($request->input('sync_conf_hidden')=='on'){
            $lpar->sync_conf=1;
        }
        else{
            $lpar->sync_conf=0;
        }
        if($request->input('check_hidden')=='auto'){
            $lpar->isAuto_StartWithMangedSys=1;
            $lpar->isEnable_redundant_Error_Path_report=0;
            $lpar->isEnable_Connection_Monitoring=0;


        }
        elseif($request->input('check_hidden')=='redund'){
            $lpar->isEnable_redundant_Error_Path_report=1;
            $lpar->isAuto_StartWithMangedSys=0;
            $lpar->isEnable_Connection_Monitoring=0;
        }
        else{
            $lpar->isEnable_Connection_Monitoring=1;
            $lpar->isEnable_redundant_Error_Path_report=0;
            $lpar->isAuto_StartWithMangedSys=0;
        }
        $lpar->save();

        $array = DB::table('l_p_a_r_s')
        ->where('Server_FK_id', '=',$server->id )->where('LPAR_name', '!=',null )
        ->get();
        $templates = DB::table('template_profiles')
        ->where('Client_FK_id', '=',$client->id )->where('template_name', '!=',null )->get();
      
        return view('/ViewClient_Server_lpars',compact('templates','server','array','client'));
    }
    
    public function createphysicalIO(CreatePhysicalIORequest $request,$id,$id_t){
        $lpar=LPAR::find($id_t);
        $lpar->LPAR_name =$request->input('template_name_hidden1');
        $lpar->profil_name  =$request->input('profile_name_hidden1');
        $lpar->env=$request->input('env_hidden1');
        $lpar->sharing_mode=$request->input('uncap_hidden1');
        $lpar->LPAR_id=$request->input('LPAR_id_hidden1');
        $lpar->min_memory =$request->input('value_hidden1');
        $lpar->disired_memory  =$request->input('value1_hidden1');
        $lpar->max_memory =$request->input('value2_hidden1');

        if($request->input('radio_hidden1')=='Shared'){
            $lpar->shared=TRUE;
             if($request->input('proc_pool_hidden1')=="Other pool"){
                 $lpar->proc_pool =$request->input('input_pool_hidden1');
                 $lpar->desired_proc =0;
                 $lpar->min_proc=0;
                 $lpar->max_proc=0;
             }
             else{
                 $lpar->proc_pool =$request->input('proc_pool_hidden1');
             }
            $lpar->max_proc_units =$request->input('max_proc_units_hidden1');
            $lpar->min_proc_units =$request->input('min_proc_units_hidden1');
            $lpar->disired_proc_units =$request->input('desired_proc_units_hidden1');
            $lpar->disired_v_proc  =$request->input('desired_v_proc_hidden1');
            $lpar->min_v_proc  =$request->input('min_v_proc_hidden1');
            $lpar->max_v_proc  =$request->input('max_v_proc_hidden1');
            $lpar->uncap_weight =$request->input('uncap_weigth_hidden1');
 
        } 
        else{
         $lpar->shared=FALSE;
         $lpar->desired_proc  =$request->input('desired_proc_hidden1');
         $lpar->min_proc  =$request->input('min_proc_hidden1');
         $lpar->max_proc  =$request->input('max_proc_hidden1');
         $lpar->uncap_weight =$request->input('0');
         $lpar->proc_pool='';
         $lpar->max_proc_units=0;
         $lpar->min_proc_units=0;
         $lpar->disired_proc_units=0;
         $lpar->disired_v_proc=0;
         $lpar->min_v_proc=0;
         $lpar->max_v_proc=0;
         $lpar->uncap_weight=0;
         } 
         $lpar->max_v_adapters=$request->input('max_v_adapters_hidden31');
         if($request->input('boot_mode_hidden1')=='sms'){
             $lpar->isSMS_BootMode=1;
             $lpar->isNormal_BootMode=0;
         }
         else{
             $lpar->isSMS_BootMode=0;
             $lpar->isNormal_BootMode=1;
         }
         if($request->input('sync_conf_hidden1')=='on'){
             $lpar->sync_conf=1;
         }
         else{
             $lpar->sync_conf=0;
         }
         if($request->input('check_hidden1')=='auto'){
             $lpar->isAuto_StartWithMangedSys=1;
             $lpar->isEnable_redundant_Error_Path_report=0;
             $lpar->isEnable_Connection_Monitoring=0;
 
 
         }
         elseif($request->input('check_hidden1')=='redund'){
             $lpar->isEnable_redundant_Error_Path_report=1;
             $lpar->isAuto_StartWithMangedSys=0;
             $lpar->isEnable_Connection_Monitoring=0;
         }
         else{
             $lpar->isEnable_Connection_Monitoring=1;
             $lpar->isEnable_redundant_Error_Path_report=0;
             $lpar->isAuto_StartWithMangedSys=0;
         }
         $lpar->save();

        $client=Client::find($id);
        $array=[];
        $array1=[];
        $array2=[];
        $array3=[];
        $array1 = DB::table('v__f_c_s')
        ->where('Template_FK_id', '=',null )->where('LPAR_FK_id','=',$id_t)->get(); 

        $array2 = DB::table('v_ethernets')
        ->where('Template_FK_id', '=',null )->where('LPAR_FK_id','=',$id_t)->get();
        
        $array3 = DB::table('v__s_c_s_i_s')
        ->where('Template_FK_id', '=',null )->where('LPAR_FK_id','=',$id_t)->get();

        $phy=new Physical_IO();
        $phy->index_slot=$request->input('index_slot');
        $phy->type=$request->input('type_physical_IO');
        $phy->isrequired=TRUE;
        $phy->isdesired=FALSE;
        $phy->LPAR_FK_id=$id_t;
        
        if(!isset($_post['req_des'])){
            $radioVal = $request->input("req_des");
            //die($radioVal);
            if($radioVal=='required'){
                $phy->isrequired=TRUE;
                $phy->isdesired=FALSE;}
            else{
                $phy->isrequired=FALSE;
                $phy->isdesired=TRUE; 
                }
        }
        $phy->save();
        $server=Server::find($lpar->Server_FK_id);
        $array = DB::table('physical__i_o_s')
        ->where('template_FK_id', '=',null )->where('LPAR_FK_id','=',$id_t)->get();  
        $array4 = DB::table('l_p_a_r_s')
        ->where('Server_FK_id', '=',$server->id )->where('LPAR_name', '!=',null )->get();
        $array5 = DB::table('l_p_a_r_s')
        ->where('Server_FK_id', '=',$server->id )->where('LPAR_name', '!=',null )->where('env','=','VIOS')->get();
     
        $vswitchs = DB::table('V_switches')->get();
       
        return(view('/Edit_LPAR',compact('array',"array4","array5",'vswitchs','array1','array2','array3','client','lpar')));
        }

    public function createSCSI(CreateSCSIRequest $request,$id,$id_t){
        $array=[];
        $array1=[];
        $array2=[];
        $array3=[];
        $lpar=LPAR::find($id_t);
        $client=Client::find($id);
        $lpar->LPAR_name =$request->input('template_name_hidden2');
        $lpar->profil_name  =$request->input('profile_name_hidden2');
        $lpar->env=$request->input('env_hidden2');
        $lpar->sharing_mode=$request->input('uncap_hidden2');
        $lpar->LPAR_id=$request->input('LPAR_id_hidden2');
        $lpar->min_memory =$request->input('value_hidden2');
        $lpar->disired_memory  =$request->input('value1_hidden2');
        $lpar->max_memory =$request->input('value2_hidden2');

        if($request->input('radio_hidden2')=='Shared'){
            $lpar->shared=TRUE;
             if($request->input('proc_pool_hidden2')=="Other pool"){
                 $lpar->proc_pool =$request->input('input_pool_hidden2');
             }
             else{
                 $lpar->proc_pool =$request->input('proc_pool_hidden2');
             }
             $lpar->desired_proc =0;
             $lpar->min_proc=0;
             $lpar->max_proc=0;
            $lpar->max_proc_units =$request->input('max_proc_units_hidden2');
            $lpar->min_proc_units =$request->input('min_proc_units_hidden2');
            $lpar->disired_proc_units =$request->input('desired_proc_units_hidden2');
            $lpar->disired_v_proc  =$request->input('desired_v_proc_hidden2');
            $lpar->min_v_proc  =$request->input('min_v_proc_hidden2');
            $lpar->max_v_proc  =$request->input('max_v_proc_hidden2');
            $lpar->uncap_weight =$request->input('uncap_weigth_hidden2');
 
        } 
        else{
         $lpar->shared=FALSE;
         $lpar->desired_proc  =$request->input('desired_proc_hidden2');
         $lpar->min_proc  =$request->input('min_proc_hidden2');
         $lpar->max_proc  =$request->input('max_proc_hidden2');
         $lpar->uncap_weight =$request->input('0');
         $lpar->proc_pool='';
         $lpar->max_proc_units=0;
         $lpar->min_proc_units=0;
         $lpar->disired_proc_units=0;
         $lpar->disired_v_proc=0;
         $lpar->min_v_proc=0;
         $lpar->max_v_proc=0;
         $lpar->uncap_weight=0;
         } $lpar->max_v_adapters=$request->input('max_v_adapters_hidden32');
         if($request->input('boot_mode_hidden2')=='sms'){
             $lpar->isSMS_BootMode=1;
             $lpar->isNormal_BootMode=0;
         }
         else{
             $lpar->isSMS_BootMode=0;
             $lpar->isNormal_BootMode=1;
         }
         if($request->input('sync_conf_hidden2')=='on'){
             $lpar->sync_conf=1;
         }
         else{
             $lpar->sync_conf=0;
         }
         if($request->input('check_hidden2')=='auto'){
             $lpar->isAuto_StartWithMangedSys=1;
             $lpar->isEnable_redundant_Error_Path_report=0;
             $lpar->isEnable_Connection_Monitoring=0;
 
 
         }
         elseif($request->input('check_hidden2')=='redund'){
             $lpar->isEnable_redundant_Error_Path_report=1;
             $lpar->isAuto_StartWithMangedSys=0;
             $lpar->isEnable_Connection_Monitoring=0;
         }
         else{
             $lpar->isEnable_Connection_Monitoring=1;
             $lpar->isEnable_redundant_Error_Path_report=0;
             $lpar->isAuto_StartWithMangedSys=0;
         }
         $lpar->save();
        // die($request->input('env_hidden2'));
      //  die($lpar->env);
        $array1 = DB::table('v__f_c_s')
        ->where('Template_FK_id', '=',null )->where('LPAR_FK_id','=',$id_t)->get(); 
        
        $array2 = DB::table('v_ethernets')
        ->where('Template_FK_id', '=',null )->where('LPAR_FK_id','=',$id_t)->get();  

        $array = DB::table('physical__i_o_s')
      ->where('template_FK_id', '=',null )->where('LPAR_FK_id','=',$id_t)->get();

        $scsi=new V_SCSI();
        $scsi->type="SCSI";
        $scsi->isrequired=TRUE;

        if($lpar->env=="Linux/AIX"){
            $scsi->isServerAdapter=FALSE;
            $scsi->isClientAdapter=TRUE;
            $scsi->Adpater_id=$request->input('adapter_id');
            $scsi->target_partition=$request->input('partition_select');
            $scsi->target_adap_id=$request->input('client_adapter_id_1');
            if(!isset($_post['req_SCSI_1'])){
                $radioVal = $request->input("req_SCSI_1");
                if($radioVal=='no'){
                    $scsi->isrequired=FALSE;
                    }
            }
        }
        else{
           // die('ok');
            $scsi->isServerAdapter=TRUE;
            $scsi->isClientAdapter=FALSE;
           
            $scsi->Adpater_id=$request->input('adapter');
            if($request->input('partition_select_1')!='other'){
                $scsi->target_partition=$request->input('partition_select_1');
            }
            else{
                $scsi->target_partition=$request->input('client_partition_1');
            }
            $scsi->target_adap_id=$request->input('client_adapter_id');
            if(!isset($_post['req_SCSI'])){
                $radioVal = $request->input("req_SCSI");
                if($radioVal=='no'){
                    $scsi->isrequired=FALSE;
                    }
            }
        }
        $scsi->LPAR_FK_id=$id_t;
        
        $scsi->save();
        if($lpar->max_v_adapters<$request->input('max_v_adapters_hidden')){
            $lpar->max_v_adapters=$request->input('max_v_adapters_hidden');
            $lpar->save();
        }
       
        $server=Server::find($lpar->Server_FK_id);
        $array3 = DB::table('v__s_c_s_i_s')
        ->where('Template_FK_id', '=',null )->where('LPAR_FK_id','=',$id_t)->get();
        $vswitchs = DB::table('V_switches')->get();
        $array4 = DB::table('l_p_a_r_s')
        ->where('Server_FK_id', '=',$server->id )->where('LPAR_name', '!=',null )->get();
        $array5 = DB::table('l_p_a_r_s')
        ->where('Server_FK_id', '=',$server->id )->where('LPAR_name', '!=',null )->where('env','=','VIOS')->get();
     
       
       return(view('/Edit_LPAR',compact('array1',"array4","array5","vswitchs",'array2','array3','array','client','lpar')));

    }

    public function createEthernet(CreateEthernetRequest $request,$id,$id_t){
        $array=[];
        $array1=[];
        $array2=[];
        $array3=[];
        $lpar=LPAR::find($id_t);
        if($lpar->max_v_adapters<$request->input('max_v_adapters_hidden1')){
            $lpar->max_v_adapters=$request->input('max_v_adapters_hidden1');
            $lpar->save();
        }
        $lpar->LPAR_name =$request->input('template_name_hidden3');
        $lpar->profil_name  =$request->input('profile_name_hidden3');
        $lpar->env=$request->input('env_hidden3');
        $lpar->sharing_mode=$request->input('uncap_hidden3');
        $lpar->LPAR_id=$request->input('LPAR_id_hidden3');
        $lpar->min_memory =$request->input('value_hidden3');
        $lpar->disired_memory  =$request->input('value1_hidden3');
        $lpar->max_memory =$request->input('value2_hidden3');

        if($request->input('radio_hidden3')=='Shared'){
            $lpar->shared=TRUE;
             $lpar->desired_proc =0;
           $lpar->min_proc=0;
           $lpar->max_proc=0;
             if($request->input('proc_pool_hidden3')=="Other pool"){
                 $lpar->proc_pool =$request->input('input_pool_hidden3');
             }
             else{
                 $lpar->proc_pool =$request->input('proc_pool_hidden3');
             }
            $lpar->max_proc_units =$request->input('max_proc_units_hidden3');
            $lpar->min_proc_units =$request->input('min_proc_units_hidden3');
            $lpar->disired_proc_units =$request->input('desired_proc_units_hidden3');
            $lpar->disired_v_proc  =$request->input('desired_v_proc_hidden3');
            $lpar->min_v_proc  =$request->input('min_v_proc_hidden3');
            $lpar->max_v_proc  =$request->input('max_v_proc_hidden3');
            $lpar->uncap_weight =$request->input('uncap_weigth_hidden3');
 
        } 
        else{
         $lpar->shared=FALSE;
         $lpar->desired_proc  =$request->input('desired_proc_hidden3');
         $lpar->min_proc  =$request->input('min_proc_hidden3');
         $lpar->max_proc  =$request->input('max_proc_hidden3');
         $lpar->uncap_weight =$request->input('0');
         $lpar->proc_pool='';
         $lpar->max_proc_units=0;
         $lpar->min_proc_units=0;
         $lpar->disired_proc_units=0;
         $lpar->disired_v_proc=0;
         $lpar->min_v_proc=0;
         $lpar->max_v_proc=0;
         $lpar->uncap_weight=0;
 
         } $lpar->max_v_adapters=$request->input('max_v_adapters_hidden33');
         if($request->input('boot_mode_hidden3')=='sms'){
             $lpar->isSMS_BootMode=1;
             $lpar->isNormal_BootMode=0;
         }
         else{
             $lpar->isSMS_BootMode=0;
             $lpar->isNormal_BootMode=1;
         }
         if($request->input('sync_conf_hidden3')=='on'){
             $lpar->sync_conf=1;
         }
         else{
             $lpar->sync_conf=0;
         }
         if($request->input('check_hidden3')=='auto'){
             $lpar->isAuto_StartWithMangedSys=1;
             $lpar->isEnable_redundant_Error_Path_report=0;
             $lpar->isEnable_Connection_Monitoring=0;
 
 
         }
         elseif($request->input('check_hidden3')=='redund'){
             $lpar->isEnable_redundant_Error_Path_report=1;
             $lpar->isAuto_StartWithMangedSys=0;
             $lpar->isEnable_Connection_Monitoring=0;
         }
         else{
             $lpar->isEnable_Connection_Monitoring=1;
             $lpar->isEnable_redundant_Error_Path_report=0;
             $lpar->isAuto_StartWithMangedSys=0;
         }
         $lpar->save();
        $client=Client::find($id);
           
        $array1 = DB::table('v__f_c_s')
        ->where('Template_FK_id', '=',null )->where('LPAR_FK_id','=',$id_t)->get(); 
        
        $array3 = DB::table('v__s_c_s_i_s')
        ->where('Template_FK_id', '=',null)->where('LPAR_FK_id','=',$id_t)->get();
       
        $array = DB::table('physical__i_o_s')
      ->where('template_FK_id', '=',null )->where('LPAR_FK_id','=',$id_t)->get();

        $ethernet=new V_ethernet();
        $ethernet->PV_id=$request->input('pv_id');
        $ethernet->VLANs=$request->input('vlans');
        $ethernet->type="Ethernet";
        $ethernet->isrequired=TRUE;
        $ethernet->LPAR_FK_id=$id_t;
        $ethernet->Adpater_id=$request->input('adapter_id');
        
        if(!isset($_post['ethernet_req'])){
            $radioVal = $request->input("ethernet_req");
            if($radioVal=='no'){
                $ethernet->isrequired=FALSE;
                }
        }
        if($request->input('vswitch')=="Other"){
            $vs=new VSwitch();
            $vs->name=$request->input('hidden_vs');
            $vs->LPAR_FK_id=$lpar->id;
            $vs->save();
            $ethernet->vswitch=$vs->id;
            }
        else{
    
            $ethernet->vswitch=1;
            }
            $radioVal_Ieee = $request->input("ieee_req");
            if($radioVal_Ieee=='no'){
                $ethernet->isrequired=FALSE;
                }
                else{
                    $ethernet->isrequired=TRUE;
                }
        $ethernet->save();
        $server=Server::find($lpar->Server_FK_id);

        $array2 = DB::table('v_ethernets')
        ->where('Template_FK_id', '=',null)->where('LPAR_FK_id','=',$id_t)->get();  
        $vswitchs = DB::table('V_switches')->get();
        $array4 = DB::table('l_p_a_r_s')
        ->where('Server_FK_id', '=',$server->id )->where('LPAR_name', '!=',null )->get();
        $array5 = DB::table('l_p_a_r_s')
        ->where('Server_FK_id', '=',$server->id )->where('LPAR_name', '!=',null )->where('env','=','VIOS')->get();
     
       return(view('/Edit_LPAR',compact('array1','array4','array5',"vswitchs",'array2','array3','array','client','lpar')));

    }
    
    public function createFC(CreateFCRequest $request,$id,$id_t){
        $array=[];
        $array1=[];
        $array2=[];
        $array3=[];
        $client=Client::find($id);
        $lpar=LPAR::find($id_t);
        if($lpar->max_v_adapters<$request->input('max_v_adapters_hidden2')){
            $lpar->max_v_adapters=$request->input('max_v_adapters_hidden2');
            $lpar->save();
        }
        $lpar->LPAR_name =$request->input('template_name_hidden4');
        $lpar->profil_name  =$request->input('profile_name_hidden4');
        $lpar->env=$request->input('env_hidden4');
        $lpar->sharing_mode=$request->input('uncap_hidden4');
        $lpar->LPAR_id=$request->input('LPAR_id_hidden4');
        $lpar->min_memory =$request->input('value_hidden4');
        $lpar->disired_memory  =$request->input('value1_hidden4');
        $lpar->max_memory =$request->input('value2_hidden4');
      
        if($request->input('radio_hidden4')=='Shared'){
            $lpar->shared=TRUE;
           
             if($request->input('proc_pool_hidden4')=="Other pool"){
                 $lpar->proc_pool =$request->input('input_pool_hidden4');
             }
             else{
                 $lpar->proc_pool =$request->input('proc_pool_hidden4');
             }
            $lpar->max_proc_units =$request->input('max_proc_units_hidden4');
            $lpar->min_proc_units =$request->input('min_proc_units_hidden4');
            $lpar->disired_proc_units =$request->input('desired_proc_units_hidden4');
            $lpar->disired_v_proc  =$request->input('desired_v_proc_hidden4');
            $lpar->min_v_proc  =$request->input('min_v_proc_hidden4');
            $lpar->max_v_proc  =$request->input('max_v_proc_hidden4');
            $lpar->uncap_weight =$request->input('uncap_weigth_hidden4');
           
        } 
        else{
         $lpar->shared=FALSE;
         $lpar->desired_proc  =$request->input('desired_proc_hidden4');
         $lpar->min_proc  =$request->input('min_proc_hidden4');
         $lpar->max_proc  =$request->input('max_proc_hidden4');
         $lpar->uncap_weight =$request->input('0');
         $lpar->proc_pool='';
         $lpar->max_proc_units=0;
         $lpar->min_proc_units=0;
         $lpar->disired_proc_units=0;
         $lpar->disired_v_proc=0;
         $lpar->min_v_proc=0;
         $lpar->max_v_proc=0;
         $lpar->uncap_weight=0;
         }
          $lpar->max_v_adapters=$request->input('max_v_adapters_hidden34');
         if($request->input('boot_mode_hidden4')=='sms'){
             $lpar->isSMS_BootMode=1;
             $lpar->isNormal_BootMode=0;
         }
         else{
             $lpar->isSMS_BootMode=0;
             $lpar->isNormal_BootMode=1;
         }
         if($request->input('sync_conf_hidden4')=='on'){
             $lpar->sync_conf=1;
         }
         else{
             $lpar->sync_conf=0;
         }
         if($request->input('check_hidden4')=='auto'){
             $lpar->isAuto_StartWithMangedSys=1;
             $lpar->isEnable_redundant_Error_Path_report=0;
             $lpar->isEnable_Connection_Monitoring=0;
 
         }
         elseif($request->input('check_hidden4')=='redund'){
             $lpar->isEnable_redundant_Error_Path_report=1;
             $lpar->isAuto_StartWithMangedSys=0;
             $lpar->isEnable_Connection_Monitoring=0;
         }
         else{
             $lpar->isEnable_Connection_Monitoring=1;
             $lpar->isEnable_redundant_Error_Path_report=0;
             $lpar->isAuto_StartWithMangedSys=0;
         }
         $lpar->save();
        $array2 = DB::table('v_ethernets')
        ->where('Template_FK_id', '=', null)->where('LPAR_FK_id','=',$id_t)->get();  

        $array3 = DB::table('v__s_c_s_i_s')
        ->where('Template_FK_id', '=',null )->where('LPAR_FK_id','=',$id_t)->get();
    
        $array = DB::table('physical__i_o_s')
      ->where('template_FK_id', '=',null)->where('LPAR_FK_id','=',$id_t)->get();

        $fc=new V_FC();
        $fc->server_partition=$request->input('server_partition');
        $fc->wwpn=$request->input('wwpn');
        $fc->wwpn_lpm=$request->input('lpm');
        $fc->type="FC";
        $fc->isrequired=TRUE;
        $fc->LPAR_FK_id=$id_t;
        if(!isset($_post['fc_req'])){
            $radioVal = $_POST["fc_req"];
            if($radioVal=='no'){
                $fc->isrequired=FALSE;
                }
                else{
                    $fc->isrequired=TRUE;
                }
        }if(!isset($_post['fc_req'])){
            $radioVal = $request->input("fc_req");
            if($radioVal=='no'){
                $fc->isrequired=FALSE;
                }
        }
        $fc->Adpater_id=$request->input('adapter_id');

        $fc->save();
        $server=Server::find($lpar->Server_FK_id);

        $vswitchs = DB::table('V_switches')->get();
        $array4 = DB::table('l_p_a_r_s')
        ->where('Server_FK_id', '=',$server->id )->where('LPAR_name', '!=',null )->get();
        $array5 = DB::table('l_p_a_r_s')
        ->where('Server_FK_id', '=',$server->id )->where('LPAR_name', '!=',null )->where('env','=','VIOS')->get();
     
        $array1 = DB::table('v__f_c_s')
        ->where('Template_FK_id', '=',null )->where('LPAR_FK_id','=',$id_t)->get();
        return(view('/Edit_LPAR',compact('vswitchs',"array4",'array5','array1','array2','array3','array','client','lpar')));

    }
    public function deleteSCSI($id){
        $scsi=V_SCSI::find($id);
        $lpar=LPAR::find($scsi->LPAR_FK_id);
        $server=Server::find($lpar->Server_FK_id);
        $client=Client::find($server->Client_FK_id);
        $scsi->delete();
        $server=Server::find($lpar->Server_FK_id);
       

        $vswitchs = DB::table('V_switches')->get();
        $array2 = DB::table('v_ethernets')
        ->where('Template_FK_id', '=', null)->where('LPAR_FK_id','=',$lpar->id)->get();  

        $array3 = DB::table('v__s_c_s_i_s')
        ->where('Template_FK_id', '=',null )->where('LPAR_FK_id','=',$lpar->id)->get();
    
        $array = DB::table('physical__i_o_s')
      ->where('template_FK_id', '=',null)->where('LPAR_FK_id','=',$lpar->id)->get();

        $array4 = DB::table('l_p_a_r_s')
        ->where('Server_FK_id', '=',$server->id )->where('LPAR_name', '!=',null )->get();
        $array5 = DB::table('l_p_a_r_s')
        ->where('Server_FK_id', '=',$server->id )->where('LPAR_name', '!=',null )->where('env','=','VIOS')->get();
     
        $array1 = DB::table('v__f_c_s')
        ->where('Template_FK_id', '=',null )->where('LPAR_FK_id','=',$lpar->id)->get();
        
        return(view('/Edit_LPAR',compact('vswitchs',"array4",'array5','array1','array2','array3','array','client','lpar')));

    }
    public function deleteEth($id){
        $eth=V_ethernet::find($id);
        $lpar=LPAR::find($eth->LPAR_FK_id);
        $server=Server::find($lpar->Server_FK_id);
        $client=Client::find($server->Client_FK_id);
        $eth->delete();
        $server=Server::find($lpar->Server_FK_id);

        $vswitchs = DB::table('V_switches')->get();
        $array2 = DB::table('v_ethernets')
        ->where('Template_FK_id', '=', null)->where('LPAR_FK_id','=',$lpar->id)->get();  

        $array3 = DB::table('v__s_c_s_i_s')
        ->where('Template_FK_id', '=',null )->where('LPAR_FK_id','=',$lpar->id)->get();
    
        $array = DB::table('physical__i_o_s')
      ->where('template_FK_id', '=',null)->where('LPAR_FK_id','=',$lpar->id)->get();

        $array4 = DB::table('l_p_a_r_s')
        ->where('Server_FK_id', '=',$server->id )->where('LPAR_name', '!=',null )->get();
        $array5 = DB::table('l_p_a_r_s')
        ->where('Server_FK_id', '=',$server->id )->where('LPAR_name', '!=',null )->where('env','=','VIOS')->get();
     
        $array1 = DB::table('v__f_c_s')
        ->where('Template_FK_id', '=',null )->where('LPAR_FK_id','=',$lpar->id)->get();
        
        return(view('/Edit_LPAR',compact('vswitchs',"array4",'array5','array1','array2','array3','array','client','lpar')));

    }
    public function deleteFC($id){
        $fc=V_FC::find($id);
        $lpar=LPAR::find($fc->LPAR_FK_id);
        $server=Server::find($lpar->Server_FK_id);
        $client=Client::find($server->Client_FK_id);
        $fc->delete();
        $server=Server::find($lpar->Server_FK_id);

        $vswitchs = DB::table('V_switches')->get();
        $array2 = DB::table('v_ethernets')
        ->where('Template_FK_id', '=', null)->where('LPAR_FK_id','=',$lpar->id)->get();  

        $array3 = DB::table('v__s_c_s_i_s')
        ->where('Template_FK_id', '=',null )->where('LPAR_FK_id','=',$lpar->id)->get();
    
        $array = DB::table('physical__i_o_s')
      ->where('template_FK_id', '=',null)->where('LPAR_FK_id','=',$lpar->id)->get();

        $array4 = DB::table('l_p_a_r_s')
        ->where('Server_FK_id', '=',$server->id )->where('LPAR_name', '!=',null )->get();
        $array5 = DB::table('l_p_a_r_s')
        ->where('Server_FK_id', '=',$server->id )->where('LPAR_name', '!=',null )->where('env','=','VIOS')->get();
     
        $array1 = DB::table('v__f_c_s')
        ->where('Template_FK_id', '=',null )->where('LPAR_FK_id','=',$lpar->id)->get();
        
        return(view('/Edit_LPAR',compact('vswitchs',"array4",'array5','array1','array2','array3','array','client','lpar')));

    }
   public function  deletephy($id){
    $phy=Physical_IO::find($id);
    $lpar=LPAR::find($phy->LPAR_FK_id);
    $server=Server::find($lpar->Server_FK_id);
    $client=Client::find($server->Client_FK_id);
    $phy->delete();
    $server=Server::find($lpar->Server_FK_id);

    $vswitchs = DB::table('V_switches')->get();
    $array2 = DB::table('v_ethernets')
    ->where('Template_FK_id', '=', null)->where('LPAR_FK_id','=',$lpar->id)->get();  

    $array3 = DB::table('v__s_c_s_i_s')
    ->where('Template_FK_id', '=',null )->where('LPAR_FK_id','=',$lpar->id)->get();

    $array = DB::table('physical__i_o_s')
  ->where('template_FK_id', '=',null)->where('LPAR_FK_id','=',$lpar->id)->get();

    $array4 = DB::table('l_p_a_r_s')
    ->where('Server_FK_id', '=',$server->id )->where('LPAR_name', '!=',null )->get();
    $array5 = DB::table('l_p_a_r_s')
    ->where('Server_FK_id', '=',$server->id )->where('LPAR_name', '!=',null )->where('env','=','VIOS')->get();
 
    $array1 = DB::table('v__f_c_s')
    ->where('Template_FK_id', '=',null )->where('LPAR_FK_id','=',$lpar->id)->get();
    
    return(view('/Edit_LPAR',compact('vswitchs',"array4",'array5','array1','array2','array3','array','client','lpar')));

   }
  public function editphy(Request $request,$id){
    $phy=Physical_IO::find($id);
    $lpar=LPAR::find($phy->LPAR_FK_id);
    $server=Server::find($lpar->Server_FK_id);
    $client=Client::find($server->Client_FK_id);
    $phy->index_slot=$request->input('index_slot_edit');
    $phy->type=$request->input('type_physical_IO_edit');
   
    if(!isset($_post['req_des_edit'])){
        
        $radioVal = $request->input("req_des_edit");
        //die($radioVal);
        if($radioVal=='required'){
            $phy->isrequired=TRUE;
            $phy->isdesired=FALSE;}
        else{
            $phy->isrequired=FALSE;
            $phy->isdesired=TRUE; 
            }
    }
    $phy->save();


    $vswitchs = DB::table('V_switches')->get();
    $array2 = DB::table('v_ethernets')
    ->where('Template_FK_id', '=', null)->where('LPAR_FK_id','=',$lpar->id)->get();  

    $array3 = DB::table('v__s_c_s_i_s')
    ->where('Template_FK_id', '=',null )->where('LPAR_FK_id','=',$lpar->id)->get();

    $array = DB::table('physical__i_o_s')
  ->where('template_FK_id', '=',null)->where('LPAR_FK_id','=',$lpar->id)->get();

    $array4 = DB::table('l_p_a_r_s')
    ->where('Server_FK_id', '=',$server->id )->where('LPAR_name', '!=',null )->get();
    $array5 = DB::table('l_p_a_r_s')
    ->where('Server_FK_id', '=',$server->id )->where('LPAR_name', '!=',null )->where('env','=','VIOS')->get();
 
    $array1 = DB::table('v__f_c_s')
    ->where('Template_FK_id', '=',null )->where('LPAR_FK_id','=',$lpar->id)->get();
    
    return(view('/Edit_LPAR',compact('vswitchs',"array4",'array5','array1','array2','array3','array','client','lpar')));

  }
 public function editEth(Request $request,$id){
    $eth=V_ethernet::find($id);
    $lpar=LPAR::find($phy->LPAR_FK_id);
    $server=Server::find($lpar->Server_FK_id);
    $client=Client::find($server->Client_FK_id);



    $vswitchs = DB::table('V_switches')->get();
    $array2 = DB::table('v_ethernets')
    ->where('Template_FK_id', '=', null)->where('LPAR_FK_id','=',$lpar->id)->get();  

    $array3 = DB::table('v__s_c_s_i_s')
    ->where('Template_FK_id', '=',null )->where('LPAR_FK_id','=',$lpar->id)->get();

    $array = DB::table('physical__i_o_s')
  ->where('template_FK_id', '=',null)->where('LPAR_FK_id','=',$lpar->id)->get();

    $array4 = DB::table('l_p_a_r_s')
    ->where('Server_FK_id', '=',$server->id )->where('LPAR_name', '!=',null )->get();
    $array5 = DB::table('l_p_a_r_s')
    ->where('Server_FK_id', '=',$server->id )->where('LPAR_name', '!=',null )->where('env','=','VIOS')->get();
 
    $array1 = DB::table('v__f_c_s')
    ->where('Template_FK_id', '=',null )->where('LPAR_FK_id','=',$lpar->id)->get();
    
    return(view('/Edit_LPAR',compact('vswitchs',"array4",'array5','array1','array2','array3','array','client','lpar')));

 }
 
}
