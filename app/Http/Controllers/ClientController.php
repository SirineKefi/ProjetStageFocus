<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Server;
use Alert;
use App\LPAR;
use App\VSwitch;
use App\Template_profile;
use DB;
use App\Quotation;
use App\Http\Requests\CreateClientRequest;


class ClientController extends Controller
{
    public function createClient(CreateClientRequest $request)
    {
        $client = new Client();
        $client->Client_adresse = $request->input('Client_adresse');
        $client->Client_description = $request->input('Client_description');
        $client->Client_mail = $request->input('Client_mail');
        $client->Client_name = $request->input('Client_name');
        $client->Client_servers_nbr=$request->input('Client_servers_nbr');
        $client->save();
        $array1=[];
        for ($i =0; $i <$client->Client_servers_nbr; $i++)
            {
                $server=new Server();
                $server->Client_FK_id=$client->id;
                $server->Server_name=$client->Client_name.'_Server'.$i;
                $server->LPAR_prefix=NULL;
                $server->Server_description=NULL;
                $server->Server_type=$request->input('Server_type');
                $server->Server_LPARs_nbr=0;
                $server->Server_type=$request->input('Server_type');


                $server->save();
                array_push($array1,$server);
            }  
            $array = DB::table('clients')->paginate(4);    
            $vswitch1=new VSwitch();
            $vswitch1->name="Ethernet0(Default)";
            $vswitch1->save();      
        return view('/AllClient',compact('client','array1','array'));
    }
    public function ReadClients(Request $request){
        $array=[];
        $clients = Client::all();

        foreach($clients as $i){
            array_push($array,$i);

        }
        return $array;
    }
    public function ReadServers($id){
        $array=[];
        $client=Client::find($id);
        $array1 = DB::table('servers')
        ->where('Client_FK_id', '=',$client->id )->get();
        foreach($array1 as $i){
            array_push($array,$i);

        }
        return $array;
    }
    public function ReadTemplates($id){
        $array=[];
        $client=Client::find($id);
       
        $array1 = DB::table('template_profiles')
        ->where('template_name', '!=',null )->where('Client_FK_id','=',$client->id)->get();
       
        foreach($array1 as $i){
            array_push($array,$i);

        }
        return $array;
    }
    public function welcome(){

        $clients = Client::all();
        $servers=Server::all();
        $lpars=LPAR::all();
        $templates=Template_profile::all();

        $nb_client=0;
        $nb_server=0;
        $nb_lpar=0;
        $nb_template=0;

        foreach($clients as $i){
            $nb_client++;
        }
        foreach($servers as $i){
            $nb_server++;
        }
        foreach($templates as $i){
            $nb_template++;
        }
        foreach($lpars as $i){
            $nb_lpar++;
        }
     //   die($nb_client.$nb_lpar.$nb_server.$nb_template);
        return(view('dashboard',compact('nb_client','nb_server','nb_lpar','nb_template')));
    }
}
