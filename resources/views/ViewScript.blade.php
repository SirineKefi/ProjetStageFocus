<?php 
use App\Template_profile;
?>
@extends('layout.head')
@extends('layout.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Server Details
{!!Form::open(['action' => ['LPARController@Gotoadd',$server->id], 'method' => 'GET', 'class' => 'pull-right'])!!}       

<button type="submit" class="btn btn-primary" style="margin-left:50x"><i class="fas fa-plus"></i> New LPAR</button>

{!! Form::close() !!}</h1>
<div class="row">
<div class="col-md-8 col-md-offset-2">

            <div class="card-body">
                 @if($errors->count()>0)
    <br>

       
            <div class="alert alert-danger">
                <button data-dismiss="alert" class="close" type="button">*</button>
                <strong> Sorry you have to fill all the inputs !</strong>
                <ul>
                    @foreach($errors->all() as $message)
                    <li>
                        {{$message}}
                    </li>
                    @endforeach
</ul>
                </div>
@endif
</div>
</div></div>
<div class="row">

 <div class="col-lg-6">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Server Description </h6>
        </div>
        <div class="card-body">
     
          <table>
          <tr>
          <td >
          <label>Name    :</label>
              </td>
              <td>
              {{$server->Server_name}}
              </td>
              </tr>
          <tr>
          <td >
          <label>Type   :</label>
              </td>
              <td>
              {{$server->Server_type}}
              </td>
              </tr>
              <tr>
          <td>
          <label>Lpar Prefix    :</label>
              </td>
              <td>
             {{$server->LPAR_prefix}}
              </td>
              </tr>
          <tr>
          <td>
              <label >Description     : </label>
              </td>
              <td> {{$server->Server_description}}
              </td>
              </tr>
              </table>
            
              
               <button  type="button" style="margin-left:85%"  data-toggle="modal" data-target="#exampleModal22" class="btn btn-info"><i class="fa fa-edit " ></i>   Edit</button>
                   
<!-- Modal -->
<div class="modal fade" id="exampleModal22" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><h1 class="h3 mb-4 text-gray-800">Edit Server </h1>
</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
<!-- Page Heading -->

<div class="row">
  <div class="col-lg-12">

      <div class="card-body">
      

      {!!Form::open(['action' => ['ServerController@saveUpdate',$server->id], 'method' => 'POST'])!!}       

        <table>
       
            <tr>
                <td>
                
                    {{ Form::label("Name", null, ['class' => 'control-label']) }}
                </td>  
                <td> 
                {{Form::text("Server_name",
            old("Server_name") ? old("Server_name") : (!empty($server) ? $server->Server_name : null), [
            "class" => "form-control","style"=>"width:385px",   "placeholder" => "$server->Server_name", 
            ])}}
                   
                </td>  
            </tr>  
            <tr>
                <td>
                    <br>
                    {{ Form::label("Description", null, ['class' => 'control-label']) }}
                </td> 
                <td> 
                    <br> 
                    <textarea class='form-control' name='Server_description' >{{$server->Server_description}}
</textarea>
                </td>
            </tr>
            <tr>         
                <td>  
                <br> 
                {{ Form::label("
                Type", null, ['class' => 'control-label']) }}
                </td> 
                <td>
            <br>
        <select name="Server_type"  class="form-control">
                <option name="Server_type" value="POWER 5">POWER 5</option>
                <option name="Server_type" value="POWER 6">POWER 6</option>
                <option name="Server_type" value="POWER 7">POWER 7</option>
                <option name="Server_type" value="POWER 8">POWER 8</option>
                <option name="Server_type" value="POWER 9">POWER 9</option>
        </select>
        </td>
            </tr>
            <tr>
                <td>
                <br> 
                {{ Form::label("LPAR's prefix", null, ['class' => 'control-label']) }}
               </td> 
               <td> 
               <br> 
               {{Form::text("LPAR_prefix", 
                    old("LPAR_prefix") ? old("LPAR_prefix") : (!empty($server) ? $server->LPAR_prefix: null), [
                    "class" => "form-control","style"=>"width:385px", "placeholder" => "Enter LPAR's prefix..", 
                     ])}}
                </td>   
            </tr>  
           
            <tr><tr>
        <td>
           <br>
            {{ Form::label(" LPAR's number ", null, ['class' => 'control-label']) }}
        </td>
        <td>
            <br>
            <input type='number' value="" class="form-control" name="Server_LPARs_nbr" style='width:385px'>

                    </td>  
                    </tr>
                    <tr>
                        <td>
                        <br>
            {{ Form::label("Template used ", null, ['class' => 'control-label']) }}
                    </td>
                    <td>
                    <br>
        <select name="template" class="form-control">
        <option value="no template">No Template</option>
                @foreach($templates as $template)
                    <option value="{{ $template->id }}">{{ $template->template_name }}</option>
                @endforeach  
         </select>
             <br>    
        </td>
    </tr>
    
            <br>
    </table>
    

    <br>
    
 
      </div>
      
      
    </div></div>
    </div> <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success"><i class="fas fa-check"></i>Save</button>
      </div></div>
    </div></div>


            {!!Form::close()!!} </div></div></div>
    <div class="col-lg-6">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Client Description </h6>
        </div>
        <div class="card-body"  style='height:159px'>
       
          <table>
          <tr>
          <td >
          <label>Name    :</label>
              </td>
              <td>
              {{$client->Client_name}}
              </td>
              </tr>
          <tr>
          <td >
          <label>Mail    :</label>
              </td>
              <td>
              {{$client->Client_mail}}
              </td>
              </tr>
              <tr>
          <td>
          <label>Address    :</label>
              </td>
              <td>
             {{$client->Client_adresse}}
              </td>
              </tr>
          <tr>
          <td>
              <label >Description     : </label>
              </td>
              <td>{{$client->Client_description}}
              </td>
              </tr>
              
            </table>
            
            <br>
           {!!Form::close()!!}
 </div></div></div>
</div></div>


<div class="row">
  <div class="col-lg-12" >
    <div class="card shadow mb-4"style="width:98%;margin-left:1%">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">LPARS List </h6>
      </div>
      <div class="card-body">
<div class="table-responsive">
  <table class="table">
    <tr>
        <td>
            LPAR's name
        </td>
        <td>
            profile's name
        </td>
        <td>
            Template's name
        </td>
        <td>
             Memory
        </td>
        <td>
            processor units
        </td>
        <td>
            Virtual processor
        </td>
        <td>
            Boot Mode
        </td>
        <td>
            Action
        </td>
    </tr>
    @foreach($array as $lpar)
    <tr>
        <td>
        <?php
        
            if($lpar->LPAR_name!=null){
                echo "$lpar->LPAR_name";
            }
            else{
                echo "---";
            }
            ?>
            
        </td>
        <td>
        <?php
            if($lpar->profil_name!=null){
                echo "$lpar->profil_name";
            }
            else{
                echo "---";
            }
            ?>
        </td>
        <td>
        <?php
            if($lpar->Template_FK_id!=null){
                $id_t=$lpar->Template_FK_id;
                $template=Template_profile::find($id_t);
                echo "$template->template_name";
            }
            else{
                echo "---";
            }
            ?>
        </td>
        <td>
            <?php 
            $min=$lpar->min_memory;
            $max=$lpar->max_memory;
            $disired=$lpar->disired_memory;
            if($min==null){
                $min="--";
            }
            if($max==null){
                $max="--";
            }
            if($disired==null){
                $disired="--";
            }
            echo "[".$min.";".$disired.";".$max."]";
            
            ?>      
        </td>
        <td>
        <?php 
            $min=$lpar->min_proc_units;
            $max=$lpar->max_proc_units;
            $disired=$lpar->disired_proc_units;
            if($min==null){
                $min="--";
            }
            if($max==null){
                $max="--";
            }
            if($disired==null){
                $disired="--";
            }
            echo "[".$min.";".$disired.";".$max."]";
            
            ?>  
        </td>
        <td>
        <?php 
            $min=$lpar->min_v_proc;
            $max=$lpar->max_v_proc;
            $disired=$lpar->disired_v_proc;
            if($min==null){
                $min="--";
            }
            if($max==null){
                $max="--";
            }
            if($disired==null){
                $disired="--";
            }
            echo "[".$min.";".$disired.";".$max."]";
            
            ?>  
        </td>
        <td>
        <?php
            if($lpar->isNormal_BootMode==1){
              
                echo "Normal";
            }
            else{
                echo "SMS";
            }
            ?>
        </td>
        <td> <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Actions
            </button >
        <div class="dropdown-menu"  aria-labelledby="btnGroupDrop1">
           
            <a class="dropdown-item"  style="color:#3377ff;width:50%" href="{{action('LPARController@edit', ['id_c' => $client->id,'id_s' => $server->id,'id' => $lpar->id])}}">
            <i class="far fa-edit"   
            ></i>Edit  </a>

            
            <a class="dropdown-item" style="color:#b30000;width:50px" href="{{action('LPARController@delete', ['id_c' => $client->id,'id_s' => $server->id,'id' => $lpar->id])}}">
            <i class="fa fa-trash"   
            ></i> Delete </a>
            <a class="dropdown-item"  style="color:#gray;width:50%" href="{{action('ServerController@ViewServer', ['id' => $server->id])}}">
            <i class="fas fa-fw fa-table"></i></i>View  </a>

            </div>
                </div>
        
    
        </td>
    </tr>
    @endforeach
    </table>
</div>
</div>
      </div></div></div>

<div class="row">
  <div class="col-lg-12" >
    <div class="card shadow mb-4"style="width:98%;margin-left:1%">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Scripts</h6>
      </div>
      <div class="card-body">
      <h1 class="h3 mb-4 text-gray-800">
{!!Form::open(['action' => ['ServerController@Script',$server->id], 'method' => 'GET', 'class' => 'pull-right'])!!}       

<button type="submit" class="btn btn-primary" style="margin-left:50x"><i class="fas fa-download fa-sm text-white-50"></i> Generate Script</button>

{!! Form::close() !!}</h1>

<table>
    
    @foreach($tab as $cmd)
    <tr>
        <td>

        {{$cmd}}
        </td>
        </tr>
        @endforeach
        
        <tr>
            <td>
                ##############################################
        </td>
        </tr>
        @if($tab_lpar!=[])
        @foreach($tab_lpar as $cmd_lpar)
        
    <tr>
        <td>

        {{$cmd_lpar}}
        </td>
        </tr>
        @endforeach  
        @endif
        <tr>
            <td>
                ##############################################
        </td>
        </tr>
        @if($tab_fc!=[])
        @foreach($tab_fc as $cmd_fc)
        
        <tr>
            <td>
    
            {{$cmd_fc}}
            </td>
            </tr>
            @endforeach 
            @endif
            <tr>
                <td>
                    ##############################################
            </td>
            </tr>
            @if($tab_eth!=[])
        @foreach($tab_eth as $cmd_eth)
        
        <tr>
            <td>
    
            {{$cmd_eth}}
            </td>
            </tr>
            @endforeach 
            @endif
            <tr>
                <td>
                    ##############################################
            </td>
            </tr>
            @if($tab_scsi!=[])
        @foreach($tab_scsi as $cmd_scsi)
        <tr>
            <td>
            {{$cmd_scsi}}
            </td>
            </tr>
            @endforeach 
            @endif
        </table>
</div>
      </div></div></div>
        
@endsection
