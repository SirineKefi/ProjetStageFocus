<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Server;
use App\Http\Requests\client_Request;
use App\Http\Requests\EditClientRequest;
use DB;
use App\Quotation;
class ClientContoller extends Controller
{
    //
    public function NewClientTemplate() {
        return view('create');
    } //
    public function createClient(Request $request)
    {
        $client = new Client();
        $client->Client_adresse = $request->input('Client_adresse');
        $client->Client_description = $request->input('Client_description');
        $client->Client_mail = $request->input('Client_mail');
        $client->Client_name = $request->input('Client_name');
        $client->Client_servers_nbr=$request->input('Client_servers_nbr');
        $client->save();
        $array=[];
        for ($i =0; $i <$client->Client_servers_nbr; $i++)
            {
                $server=new Server();
                $server->Client_FK_id=$client->id;
                $server->Server_name=$client->Client_name.'_Server'.$i;
                $server->LPAR_prefix='';
                $server->Server_type=$request->input('Server_type');

                $server->save();
                array_push($array,$server);
            }   
            $vswitch1=new VSwitch();
            $vswitch1->name="Ethernet0(Default)";
            $vswitch1->save();          
        return view('/view_client',compact('client','array'));
    }
    public function ReadClients(Request $request){
        $array=[];
        $clients = Client::all();

        foreach($clients as $i){
            array_push($array,$i);

        }
        return $array;
    }
    public function ListClient(Request $request){
        $array=[];
        $array = DB::table('clients')->paginate(4);
        return view("AllClient",compact('array'));
    }
    public function EditClient($id){
        
        $client= Client::find($id);
        $array=[];
        return view('/Edit_Client',compact('client'));
    }
    public function DeleteClient($id){
        
        $client=Client::find($id);
      
        $client->delete();
        $array = DB::table('clients')->paginate(4);

      return view('/AllClient',compact('array'));
    }
    public function SaveUpdateClient(EditClientRequest $request,$id){
        
        $client= Client::find($id);
        $client->Client_name=$request->input('Client_name');
        $client->Client_adresse=$request->input('Client_adresse');
        $client->Client_description=$request->input('Client_description');
        $client->Client_mail=$request->input('Client_mail');
        $client->save();
        $array = DB::table('servers')
       ->where('Client_FK_id', '=',$client->id )->get();
       $templates = DB::table('template_profiles')
       ->where('Client_FK_id', '=',$client->id )->where('template_name', '!=',null)->get();

        return view('/view_client',compact('array','client','templates'));
    }
    public function ViewClient($id){
        $client=Client::find($id);
        $array = DB::table('servers')
            ->where('Client_FK_id', '=',$client->id )->get();
        $templates = DB::table('template_profiles')->where('Client_FK_id', '=',$client->id )->where('template_name','!=',null)->get();

        return(view('view_client',compact('client','array','templates')));
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
    public function GoToEditClient($id){
        $client=Client::find($id);
         $array = DB::table('servers')
        ->where('Client_FK_id', '=',$client->id )->get();
        $templates = DB::table('template_profiles')
        ->where('Client_FK_id', '=',$client->id )->where('template_name', '!=',null)->get();
 //die($templates);
         return view('/view_client',compact('array','client','templates'));
    }
}
