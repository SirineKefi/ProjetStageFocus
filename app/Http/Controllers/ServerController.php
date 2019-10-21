<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Server;
use App\Client;
use App\VSwitch;
use App\Http\Requests\CreateServerRequest;
use App\Http\Requests\EditServerRequest;
use App\Template_profile;
use App\LPAR;
use DB;
use App\Quotation;


class ServerController extends Controller
{
    public function EditServer($id){
        
        $server= Server::find($id);
        $array=[];
        $templates= DB::table('template_profiles')
        ->where('template_name', '!=',null )->where('Client_FK_id','=',$client->id)->get();
       
     
        return view('/Edit_Server',compact('server','templates'));
    }
    public function saveUpdate(EditServerRequest $request,$id){

        $array=[];
        
       
        $server= Server::find($id);
      
        $id_client=$server->Client_FK_id;
        $client=Client::find($id_client);
        $server->Server_description=$request->input('Server_description');
        $server->LPAR_prefix=$request->input('LPAR_prefix');
        $server->Server_type=$request->input('Server_type');

        if($request->input('template')=="no template"){
            //die($request->input('Server_LPARs_nbr'));
           // die($server->Server_LPARs_nbr);
            if( $request->input('Server_LPARs_nbr')>$server->Server_LPARs_nbr){
                for ($i =0; $i < (($request->input('Server_LPARs_nbr'))-($server->Server_LPARs_nbr)); $i++) 
            {
                $lpar=new LPAR();
                $lpar->LPAR_name=$server->LPAR_prefix.$i;
                $lpar->Server_FK_id=$id;
                array_push($array,$lpar);
                $lpar->save();
            }

        }}
        else{
            if( $request->input('Server_LPARs_nbr')>$server->Server_LPARs_nbr){
                for ($i =0; $i < (($request->input('Server_LPARs_nbr'))-($server->Server_LPARs_nbr)); $i++) 
            {
                $lpar=new LPAR();
                $id_t=$request->input('template');
                $template=Template_profile::find($id_t);
                $lpar->LPAR_name=$server->LPAR_prefix.$i;
                $lpar->disired_memory=$template->disired_memory;
                $lpar->disired_proc_units=$template->disired_proc_units;
                $lpar->disired_v_proc= $template->disired_v_proc;
                $lpar->max_memory=$template->max_memory;
                $lpar->max_proc_units=$template->max_proc_units;
                $lpar->max_v_adapters= $template->max_v_adapters;
                $lpar->max_v_proc=$template->max_v_proc;
                $lpar->proc_pool= $template->proc_pool;
                $lpar->profil_name=$template->profil_name;
                $lpar->shared=$template->shared;
                $lpar->Server_FK_id=$server->id;
                $lpar->min_memory=$template->min_memory;
                $lpar->min_proc_units=$template->min_proc_units;
                $lpar->min_v_proc=$template->min_v_proc;
                $lpar->Template_FK_id=$id_t;
                $lpar->uncap_weight =$template->uncap_weight;
                $lpar->env=$template->env;
                $lpar->sharing_mode=$template->sharing_mode;
                $lpar->isAuto_StartWithMangedSys=$template->isAuto_StartWithMangedSys;
                $lpar->isEnable_Connection_Monitoring= $template->isEnable_Connection_Monitoring;
                $lpar->isEnable_redundant_Error_Path_report=$template->isEnable_redundant_Error_Path_report;
                $lpar->isNormal_BootMode=$template->isNormal_BootMode;
                $lpar->isSMS_BootMode=$template->isSMS_BootMode;


                //affectation de physical IO

                $lpar->save();
            }}
            
        }
        $server->Server_LPARs_nbr=$request->input('Server_LPARs_nbr');

        $server->save();


        
        
        $templates= DB::table('template_profiles')
        ->where('template_name', '!=',null )->where('Client_FK_id','=',$client->id)->get();
       
        $array = DB::table('servers')
        ->where('Client_FK_id', '=',$client->id )->get();
        
     
    
    $array = DB::table('l_p_a_r_s')
        ->where('Server_FK_id', '=', $server->id)->where('LPAR_name', '!=',null )->get();
    

    //return $array;
        return view('/ViewClient_Server_lpars',compact("templates",'server','array','client'));

    }
    public function NewServer($id){
        $client= Client::find($id);
       // die($client);
       $array=[];
       $templates= DB::table('template_profiles')
        ->where('template_name', '!=',null )->where('Client_FK_id','=',$client->id)->get();
       
        return view('/NewServer',compact('client','templates'));
    }
    public function createServer(CreateServerRequest $request){
       
        $server= new Server();

        $client=Client::find($request->input('id'));
        $client->Client_servers_nbr=$client->Client_servers_nbr+1;
        $client->save();
        $array=[];
        $server->Client_FK_id=$request->input('id');
        $server->Server_name=$request->input('Server_name');
        $server->Server_description=$request->input('Server_description');
        $server->LPAR_prefix=$request->input('LPAR_prefix');
        $server->Server_type=$request->input('Server_type');
        $server->Server_LPARs_nbr=$request->input('Server_LPARs_nbr');
        $server->save();

        if($request->input('template')=="no template"){

            for ($i =0; $i < $request->input('Server_LPARs_nbr'); $i++)
            {

                $lpar=new LPAR();
                $lpar->LPAR_name=$server->LPAR_prefix.$i;
                $lpar->Server_FK_id=$server->id;
                array_push($array,$lpar);
                $lpar->save();
            }

        }
        else{
            for ($i =0; $i < ($request->input('Server_LPARs_nbr')); $i++)
            {
                $lpar=new LPAR();
                $id_t=$request->input('template');
                $template=Template_profile::find($id_t);
                $lpar->LPAR_name=$server->LPAR_prefix.$i;
                $lpar->disired_memory=$template->disired_memory;
                $lpar->disired_proc_units=$template->disired_proc_units;
                $lpar->disired_v_proc= $template->disired_v_proc;
                $lpar->max_memory=$template->max_memory;
                $lpar->max_proc_units=$template->max_proc_units;
                $lpar->max_v_adapters= $template->max_v_adapters;
                $lpar->max_v_proc=$template->max_v_proc;
                $lpar->proc_pool= $template->proc_pool;
                $lpar->profil_name=$template->profil_name;
                $lpar->shared=$template->shared;
                $lpar->Server_FK_id=$server->id;
                $lpar->min_memory=$template->min_memory;
                $lpar->min_proc_units=$template->min_proc_units;
                $lpar->min_v_proc=$template->min_v_proc;
                $lpar->Template_FK_id=$id_t;
                $lpar->uncap_weight =$template->uncap_weight;
                $lpar->env=$template->env;
                $lpar->sharing_mode=$template->sharing_mode;
                $lpar->isAuto_StartWithMangedSys=$template->isAuto_StartWithMangedSys;
                $lpar->isEnable_Connection_Monitoring= $template->isEnable_Connection_Monitoring;
                $lpar->isEnable_redundant_Error_Path_report=$template->isEnable_redundant_Error_Path_report;
                $lpar->isNormal_BootMode=$template->isNormal_BootMode;
                $lpar->isSMS_BootMode=$template->isSMS_BootMode;
                $lpar->save();
                //array_push($array1,$lpar);
            }

        }

        $templates = DB::table('template_profiles')
        ->where('Client_FK_id', '=',$client->id )->get();
        $array = DB::table('servers')
        ->where('Client_FK_id', '=',$client->id )->get();
        
        return view('/view_client',compact('server','array','client','templates'));

    }
    public function deleteServer($id){
        
        $server=Server::find($id);
        //die($server);
        $client=Client::find($server->Client_FK_id);
      
        $server->delete();
        $array = DB::table('servers')
        ->where('Client_FK_id', '=', $server->Client_FK_id)
        ->get();
       // die($array);
        $client->Client_servers_nbr=$client->Client_servers_nbr-1;
        $client->save();
        $templates= DB::table('template_profiles')
        ->where('template_name', '!=',null )->where('Client_FK_id','=',$client->id)->get();
       
 

      return view('/view_client',compact("client",'array','templates'));


    }
    public function ViewServer($id){
        $server=Server::find($id);
        $id_client=$server->Client_FK_id;
       // die($server);
        $client=Client::find($id_client);
       // die($client);
        $array= DB::table('l_p_a_r_s')
        ->where('Server_FK_id', '=',$id )->where('LPAR_name', '!=',null )->get();
        $templates= DB::table('template_profiles')
        ->where('template_name', '!=',null )->where('Client_FK_id','=',$client->id)->get();

        return view('/ViewClient_Server_lpars',compact('templates','server','array','client'));

    }
    public function Script($id){
        $server=Server::find($id);
        $id_client=$server->Client_FK_id;
        $client=Client::find($id_client);
        $array= DB::table('l_p_a_r_s')
        ->where('Server_FK_id', '=',$id )->where('LPAR_name', '!=',null )->get();
        $templates= DB::table('template_profiles')
        ->where('template_name', '!=',null )->where('Client_FK_id','=',$client->id)->get();
///////////////////////////////////////Script
$tab=[];
$tab_lpar=[];
$tab_fc=[];
$tab_eth=[];
$tab_scsi=[];



$slots='';

//die($array);
        foreach($array as $lpar){
            if($lpar->isNormal_BootMode){
                $BootMode='norm';
            }
            else{
                $BootMode='sms';

            }
            
            if($lpar->sharing_mode){
                $sharing_mode="cap";
            }
            else{
                $sharing_mode="uncap";

            }
            if($lpar->shared==TRUE){
                $shared="shared";

            }
            else{
                $shared="ded";

            }
            if($lpar->env=="VIOS"){
                $env='vioserver';
            }
            elseif($lpar->env=="Linux/AIX"){
                $env='aixlinux';

            }
            else{
                $env='ibmi';
            }
            $vswitchs= DB::table('v_switches')->where('LPAR_FK_id', '=',$lpar->id )->get();
            foreach($vswitchs as $vs){
                if($vs->name!='Ethernet0(Default)')
                {
                    $cmd="chhwres -r virtualio --rsubtype vswitch -m ".$server->Server_name." -o a --vswitch ".$vs->name;
                    array_push($tab,$cmd);

                }
            }
            if($lpar->sharing_mode==TRUE){
             $ph_ios= DB::table('physical__i_o_s')
            ->where('LPAR_FK_id', '=',$lpar->id )->get();
            

            if($ph_ios!="[]"){

                $slots=$ph_ios[0]->index_slot.'//'.$ph_ios[0]->isrequired;
            for($i=1;$i<sizeof($ph_ios);$i++){
                $slots=$slots.','.$ph_ios[$i]->index_slot.'//'.$ph_ios[$i]->isrequired;
            }}
            $cmd_lpar="mksyscfg -r lpar -m ".$server->name." -i 'lpar_id=".$lpar->LPAR_id.", name=".$lpar->LPAR_name.", profile_name=".$lpar->profil_name.", sync_curr_profile=".$lpar->sync_conf.", lpar_env=".$env.", 
            mem_mode=ded, min_mem=".$lpar->min_memory.", desired_mem=".$lpar->disired_memory.", max_mem=".$lpar->max_memory.", 
            proc_mode=".$shared.", min_procs=".$lpar->min_v_proc.", desired_procs=".$lpar->disired_v_proc.", max_procs=".$lpar->max_v_proc.", 
            min_proc_units=".$lpar->min_proc_units.", desired_proc_units=".$lpar->disired_proc_units.",max_proc_units=".$lpar->max_proc_units.", sharing_mode=".$sharing_mode.", uncap_weight=".$lpar->uncap_weight.", 
            conn_monitoring=".$lpar->isEnable_Connection_Monitoring.", boot_mode=".$BootMode.", 
            max_virtual_slots=".$lpar->max_v_adapters.", \'io_slots=".$slots."\'' ";
            array_push($tab_lpar,$cmd_lpar);
        }
        else{
            $ph_ios= DB::table('physical__i_o_s')
            ->where('LPAR_FK_id', '=',$lpar->id )->get();

            if($ph_ios!="[]"){

                $slots=$ph_ios[0]->index_slot.'//'.$ph_ios[0]->isrequired;
            for($i=1;$i<sizeof($ph_ios);$i++){
                $slots=$slots.','.$ph_ios[$i]->index_slot.'//'.$ph_ios[$i]->isrequired;
            }}
            $cmd_lpar="mksyscfg -r lpar -m ".$server->name." -i 'lpar_id=".$lpar->id.", name=".$lpar->LPAR_name.", profile_name=".$lpar->profil_name.", sync_curr_profile=".$lpar->sync_conf.", lpar_env=".$lpar->env.", 
            mem_mode=ded, min_mem=".$lpar->min_memory.", desired_mem=".$lpar->disired_memory.", max_mem=".$lpar->max_memory.", 
            proc_mode=".$lpar->shared.", min_procs=".$lpar->min_v_proc.", desired_procs=".$lpar->disired_v_proc.", max_procs=".$lpar->max_v_proc.", 
            min_proc_units=".$lpar->min_proc_units.", desired_proc_units=".$lpar->disired_proc_units.",max_proc_units=".$lpar->max_proc_units.", sharing_mode=uncap, 
            conn_monitoring=".$lpar->isEnable_Connection_Monitoring.", boot_mode=".$BootMode.", 
            max_virtual_slots=".$lpar->max_v_adapters.", \'io_slots=".$slots."\'' ";
            array_push($tab_lpar,$cmd_lpar);
        }
        
     
       
        $fc_adapters= DB::table('v__f_c_s')->where('LPAR_FK_id', '=',$lpar->id )->get();
            foreach($fc_adapters as $fc){
            $cmd_fc='chsyscfg -r prof -m '.$server->Server_name.' -i "name='.$lpar->profil_name.', lpar_name='.$lpar->LPAR_name.',
            \"virtual_fc_adapters+='.$fc->Adpater_id.'/'.$fc->server_partition.'//'.$fc->wwpn.'/'.$fc->wwpn_lpm.'//'.$fc->isrequired.'" "';
            array_push($tab_fc,$cmd_fc);



        $eth_adapters= DB::table('v_ethernets')->where('LPAR_FK_id', '=',$lpar->id )->get();
            foreach($eth_adapters as $eth){
                $cmd_eth='chsyscfg -r prof -m '.$server->Server_name.' -i "name='.$lpar->profil_name.', lpar_name='.$lpar->LPAR_name.',
                \"virtual_eth_adapters='.$eth->Adpater_id.'/'.$eth->isIeee.'/'.$eth->PV_id.'//'.'/additional_vlan_ids/
                is_trunk /'.$eth->isrequired.'/\" "';
                array_push($tab_eth,$cmd_eth);

            }
            
        $scsi_adapters= DB::table('v__s_c_s_i_s')->where('LPAR_FK_id', '=',$lpar->id )->get();
        foreach($scsi_adapters as $scsi){
            if($scsi->isClientAdapter==FALSE){
                $type_adap="server";
            }
            else{
                $type_adap="client";
            }
            $cmd_scsi='chsyscfg -r prof -m '.$server->Server_name.' -i "name='.$lpar->profil_name.', lpar_name='.$lpar->LPAR_name.',
            \"virtual_scsi_adapters=""
            '.$scsi->Adpater_id.'/'.$type_adap.'//'.$scsi->target_adap_id.'/'.$scsi->target_partition.'/'.$scsi->isrequired.'\" "';
            array_push($tab_scsi,$cmd_scsi);

        }
      
 
        }}

///////////////////////////////////////////
        return view('/ViewScript',compact('tab_fc','tab_eth','tab_scsi',"tab","tab_lpar",'templates','server','array','client'));
    }

}
