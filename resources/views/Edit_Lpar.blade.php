@extends('layout.head')
@extends('layout.template')
@section('content')
<?php
use App\Client;
use App\Server;
use App\VSwitch; 

?>
<style>
  
  .slider:hover {
	opacity: 1;
  }
  
  .slider::-webkit-slider-thumb {
	-webkit-appearance: none;
	appearance: none;
	width: 40px;
	height: 40px;
	background: white;
	cursor: pointer;
	border-radius: 50%;
  }
  
  .slider::-moz-range-thumb {
	width: 40px;
	height: 40px;
	background: white;
	cursor: pointer;
	border-radius: 50%;
  }

.accordion {
  background-color: #eee;
  color: #444;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
}

.activ, .accordion:hover {
  background-color: #ccc; 
}


.panel {
  padding: 0 18px;
  display: none;
  background-color: white;
  overflow: hidden;
}

</style>

    <div class="container-fluid">

<!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Edit LPAR</h1>
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
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">LPAR details </h6>
                    </div>
                    <div class="card-body">
                    
                          
                        <button class="accordion"><i class="fas fa-angle-double-right"></i> Profile</button>
                            <div class="panel">
                                <table style='margin-left:50px'>
                                    
                                    <tr>
                                    <td  >
                                      <br>
                                        <label >Synchrone Configuration:</label>
                                        </td>
                                        <td >
                                          <br>
                                            <select  class ="form-control" name="sync_conf" id="id_sync_conf">
                                            @if($lpar->sync_conf==1)
                                            <option value="on"> On</option>
                                            <option value="off"> Off</option>
                                            @else
                                            <option value="off"> Off</option>
                                            <option value="on"> On</option>
                                            @endif
                                            </select>
                                        </td>
                                        <td style='text-align:right;width:20%'>
                                        <br>
                                            <label >LPAR Id:</label>
                                        </td>
                                        <td >
                                        <br>
                                      <input type="number" value="{{$lpar->LPAR_id}}" class ="form-control" min="1"  name="LPAR_id" id="id_LPAR_id">
                                        </td>

                                    <td style='text-align:right;width:20%' >
                                    <br>
                                            <label >LPAR name:</label>
  
                                        </td>
                                        <td >
                                          <br>
                                            <input type="text" value="{{$lpar->LPAR_name}}" class ="form-control"  name="template_name" id="id_template_name">
                                        </td>
                                                </tr>
                                                <tr>
                                        <td >
                                          <br>
                                            <label >  Profile Name:</label>
                                        </td>
                                        <td >                                          <br>

                                            <input type=text class ="form-control" value="{{$lpar->profil_name}}" name="profile_name" id="id_profile_name">
                                        </td>
                                        <td style='text-align:right'  >
                                        <br>

                             <label >LPAR Env:</label>
  
                                        </td>

                                        <td >    <br>
                                        <select  class ="form-control" onclick='env_click()'name="env" id="id_env">

                                        @if($lpar->env=="Linux/AIX")
                                            <option value="Linux/AIX">Linux/AIX</option>
                                            <option value="VIOS">VIOS</option>
                                            <option value="IBM i">IBM i</option>
                                            @elseif($lpar->env=="VIOS")
                                            <option value="VIOS">VIOS</option>
                                            <option value="Linux/AIX">Linux/AIX</option>
                                            <option value="IBM i">IBM i</option>
                                            @else
                                            <option value="IBM i">IBM i</option>
                                            <option value="VIOS">VIOS</option>
                                            <option value="Linux/AIX">Linux/AIX</option>
                                            @endif
                                            </select>

                                        </td>
                                    </tr>
                                </table>
                                    <br>
                            </div>

                        <button class="accordion"><i class="fas fa-angle-double-right"></i> Processor</button>
                            <div class="panel" >
                            @if($lpar->shared=="1")
                                <input type="radio" id="radio_shared" name="clickkk" checked onclick='displaying_shared()' value="Shared">
                                <B>Shared : </B>
                                Assign partial processor units from the shared processor pool.
                                <br>
                                <input type="radio" name="clickkk" id="radio_dedicated" class="radio_shared"   onclick='displaying_dedicated()' value="Dedicate"><B> Dedicate :  </B>
                                Assign entire processors that can only be used by the partition
                            @else
                            <input type="radio" id="radio_shared" name="clickkk"  onclick='displaying_shared()' value="Shared">
                                <B>Shared : </B>
                                Assign partial processor units from the shared processor pool.
                                <br>
                                <input type="radio" name="clickkk" checked id="radio_dedicated" class="radio_shared"   onclick='displaying_dedicated()' value="Dedicate"><B> Dedicate :  </B>
                                Assign entire processors that can only be used by the partition
                                @endif
                            </div>
                        <button class='accordion'  ><i class='fas fa-angle-double-right'></i> Processor Settings</button>
                            <div class='panel' >  
                                <p id="proc_shared"  style='margin-left:50px;display: block;' ><B>Specify the desired,minimum,and maximum</B></p>
                                <p id="proc_settings_shared" style='margin-left:50px;display: block;'><B>processing settings in the filed bellow.</B></p>
                                <table id="table_shared" style='margin-left:50px;display: block;' >
                                    <tr>
                                        <td>
                                        Minimum processing units *
                                        </td>
                                        <td>
                                        <input type='number' min="0" value="{{$lpar->min_proc_units}}" placeholder="0.1" step="0.1" class ='form-control' name='min_proc_units' id="id_min_proc_units">
                                        </td>
                                        <td style='text-align:right'>
                                             Minimum virtual processors *
                                        </td>
                                        <td>
                                            <input type='number' min="0" value="{{$lpar->min_v_proc}}" step="0.1" placeholder="0.1" class ='form-control' name='min_v_proc' id="id_min_v_proc">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >
                                        <br>
                                            Desired processing units *
                                        </td>
                                        <td>
                                        <br>
                                            <input type='number' min="0" value="{{$lpar->disired_proc_units}}"  step="0.1" placeholder="0.1" name='desired_proc_units' class ='form-control' id="id_desired_proc_units">
                                        </td>
                                        <td style='text-align:right' >
                                        <br>
                                                 Desired virtual processors *
                                            </td>
                                            <td>
                                            <br>
                                                <input type='number' min="0" step="0.1" value="{{$lpar->disired_v_proc}}" placeholder="0.1" name='desired_v_proc' class ='form-control' id="id_desired_v_proc">
                                            </td>
                                        
                                     </tr>
                                        <tr>
                                            <td>
                                            <br>
                                                Maximum processing units *
                                            </td>
                                            <td>
                                            <br>

                                                <input type='number' min="0" step="0.1" value="{{$lpar->max_proc_units}}" placeholder="0.1" name='max_proc_units' class ='form-control' id="id_max_proc_units">
                                            </td>
                                            <td style="text-align:center">
                                            <br>
                                                  Maximum virtual processors *
                                            </td>
                                            <td>
                                            <br>
                                                <input type='number' min="0" step="0.1" value="{{$lpar->max_v_proc}}" placeholder="0.1" name='max_v_proc' class ='form-control' id="id_max_v_proc">
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td>
                                            <br>
                                                Shared processor pool *
                                            </td>
                                            <td>
                                            <br>

                                                <select id="id_proc_pool" name='shared_proc_pool' onclick='verifier()' class ='form-control' >
                                               default
                                               @if($lpar->proc_pool=='Default pool')    
                                                <option value="Default pool">
                                                        Default pool
                                                    </option>
                                                    <option value="Other pool">
                                                        Other pool
                                                    </option>
                                                @else
                                                    <option value="Other pool">
                                                        Other pool
                                                    </option>
                                                    <option value="Default pool">
                                                        Default pool
                                                    </option>
                                                </select>
                                            </td>
                                            <td>
                                            </td>
                                            <td>
                                            <br>
                                            <input type="text" value="{{$lpar->proc_pool}}" class ='form-control' id="id_input_pool" name="input_pool_name">
                                            @endif
                                            <input type="text" style="display:none" class ='form-control' id="id_input_pool" name="input_pool_name">
                                            </td>


                                            <tr>
                                        <td>
                                            <br>
                                            Capped/Uncapped
 
                                            </td>
                                          
                                            @if($lpar->sharing_mode==0)
                                            <td>
                                            <br>
                                            <select onclick="activ_uncap()" class ='form-control' name="uncap" id="id_incap">
                                                <option  value="Capped">
                                                Capped
                                                </option>
                                               <option value="Uncapped">
                                               Uncapped
                                                </option>
                                            </select>
                                          </td>
                                          <td style="text-align:right">
                                            <br>
                                            <p id="p_uncap" style="display:none">
                                            
                                         Uncapped weight*
                                            </td>
                                            <td>
                                            <br>
                                            <input type="number" style="display:none" min="0" class ='form-control' id="id_uncap_weight" name="uncap_weight">
                                            </td>
                                            @else
                                            <td>
                                            <br>
                                            <select onclick="activ_uncap()" class ='form-control' name="uncap" id="id_incap">
                                            <option value="Uncapped">
                                               Uncapped
                                                </option>
                                                <option  value="Capped">
                                                Capped
                                                </option>
                                              
                                            </select>
                                          </td>
                                          <td style="text-align:right">
                                            <br>
                                            <p id="p_uncap" style="display:block">
                                            
                                         Uncapped weight*
                                            </td>
                                            <td>
                                            <br>
                                            <input type="number" style="display:block" value="{{$lpar->uncap_weight}}" min="0" class ='form-control' id="id_uncap_weight" name="uncap_weight">
                                            </td>
                                            @endif
                                        </tr>

                    <input id="uncap_secret" hidden value="{{$lpar->sharing_mode}}"  >
                                           
                                        </tr>
                                    </table>
                                    <input type="text" hidden id="shared_1" value="{{$lpar->shared}}">

                                       <p id="p_dedicated" style="display: none"> <B>    Specify the desired, minimum, and maximum processing settings in the fields below.</B></p>
                                          <table id="table_dedicated" style='margin-left:50px;display: none;' >
                                                      <tr>
                                                          <td>
                                                          Minimum processors*
                                                          </td>
                                                          <td>
                                                          
                                                          <input type='number' min="0" value='{{$lpar->min_proc}}' placeholder="1" class ='form-control' name='min_proc' id="id_min_proc">
                                                          </td>
                                                      </tr>
                                                      <tr>
                                                          <td>
                                                          <br>
                                                          Desired processors*
                                                          </td>
                                                          <td>
                                                          <br>
                                                          <input type='number' min="0" value='{{$lpar->desired_proc}}' placeholder="1" class ='form-control' name='desired_proc' id="id_desired_proc">
                                                          </td>
                                                      </tr>
                                                      <tr>
                                                          <td>
                                                          <br>
                                                          Maximum processors:
                                                          </td>
                                                          <td>
                                                          <br>
                                                          <input type='number' min="0" placeholder="1" value='{{$lpar->max_proc}}' class ='form-control' name='max_proc' id="id_max_proc">
                                                          </td>
                                                     </tr>
                                              </table>
                                            <br>
                                            
                                    </div>
                        <button class="accordion"><i class="fas fa-angle-double-right"></i> Memory Settings</button>
                            <div class="panel">
                                <table >
                                    <tr>
                                        <td >
                                            Minimum memory 
                                         </td>
                                        <td >
                                             <input  class ="form-control" value="{{$lpar->min_memory}}" type="range" min="0" max="256" step="0.1" value="0" class="slider" id="myRange">
                                        </td> 
                                        <td style="text-align:right">
                                        <input style="width:50%; "  step="0.1"  value="{{$lpar->min_memory}}" type="number" id="id_value" name="min_memo" >GB
                                        </td>

                                    </tr>
                                    <tr>
                                        <td >
                                            Desired memory 
                                         </td>
                                        <td >
                                             <input class ="form-control"  value="{{$lpar->disired_memory}}" type="range" min="0" max="256" step="0.1" value="0" class="slider1" id="myRange1">
                                        </td> 
                                        <td style="text-align:right">
                                        <input style="width:50%; "type="number" name="desired_memo"  value="{{$lpar->disired_memory}}" step="0.1" id="id_value1"  >GB
                                        </td>

                                    </tr>
                                    <tr>
                                        <td >
                                            Maximum memory 
                                         </td>
                                        <td >
                                             <input class ="form-control"  type="range" name="max_memo"  value="{{$lpar->max_memory}}"  step="0.1" min="0" max="256" value="0" class="slider2" id="myRange2">
                                        </td> 
                                        <td style="text-align:right">
                                        <input style="width:50%; "type="number" step="0.1" id="id_value2"  value="{{$lpar->max_memory}}" >GB
                                        </td>

                                    </tr>

                                </table>
                            </div>

                        <button class="accordion" ><i class="fas fa-angle-double-right"></i> physical I/O</button>
                            <div class="panel" id="panel1"  >
                                <br>
                                  <?php 
                                  $j=0;
                                  foreach($array as $i)
                                  {
                                    $j=$j+1;}

                                    ?>
                                <input id="secret_input" value="{{$j}}" hidden>
          <table class="table table-hover" id="datatable" style="text-align:center">
          <thead>
            <tr>
              <th style="text-align:center" scope="col">#</th>
              <th  style="text-align:center" scope="col">Index Slot</th>
              <th style="text-align:center" scope="col">Type</th>
              <th style="text-align:center" scope="col">Required/Desired</th>
              <th style="text-align:center" scope="col">Actions</th>


            </tr>
              </thead>
              <tbody>
                <?php $i=0;?>
                @foreach($array as $phy)
                <?php $i=$i+1;?>
                <tr>
                  <th scope="row">{{$i}}</th>
                  <td style="text-align:center">{{$phy->index_slot}}</td>
                  <td style="text-align:center">{{$phy->type}}</td>
                  <td style="text-align:center">
                  <?php 
                  if( $phy->isrequired==TRUE){
                  echo'Required';}
                  else{
                    echo'Desired';
                  }
                  ?>   </td>
                   <td style="text-align:center">


                  
                   {!!Form::open(['action' => ['LparController@deletephy',$phy->id], 'method' => 'GET'])!!}       
                 <button type="submit" class="btn btn-outline-danger"style='border-color:white;background-color:white;'>
                <i class="fa fa-trash" aria-hidden="true">
                </i> </button>                
                {!!Form::close()!!}


                 </td>
                  
                   
                </tr>
                  @endforeach


                




            
                    </tbody>
                </table> 
                <br>  <br>  <br>  <br>  <br>
                    <p>
                    <button  data-toggle="modal" data-target="#myModal1" style="margin-left:40%" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>
                                      Add physical I/O
                                    </button>
                    </p>

            <!-- The Modal -->
            <div class="modal fade" id="myModal1">
              <div class="modal-dialog">
                <div class="modal-content">
                
                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">New physical IO</h4>
                    <button type="button" style="margin-left:40%" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  
                  <!-- Modal body -->

                  <div class="modal-body">
                  {!!Form::open(['action' => ['LparController@createphysicalIO',$client->id,$lpar->id], 'method' => 'POST'])!!}       
              
                  <input type="text" value="" name="template_name_hidden1" id="id_template_name_hidden1"hidden >        
                  <input type="text" value="" name="profile_name_hidden1" id="id_profile_name_hidden1"hidden >        
                  <input type="text" value="" name="radio_hidden1" id="id_radio_hidden1" hidden>        
                  <input type="text" value="" name="max_proc_units_hidden1" id="id_max_proc_units_hidden1" hidden>        
                  <input type="text" value="" name="min_proc_units_hidden1" id="id_min_proc_units_hidden1"hidden>        
                  <input type="text" value="" name="desired_proc_units_hidden1" id="id_desired_proc_units_hidden1" hidden>        
                  <input type="text" value="" name="sync_conf_hidden1" id="id_sync_conf_hidden1"hidden>        
                  <input type="text" value="" name="min_v_proc_hidden1" id="id_min_v_proc_hidden1" hidden>        
                  <input type="text" value="" name="max_v_proc_hidden1" id="id_max_v_proc_hidden1" hidden>        
                  <input type="text" value="" name="desired_v_proc_hidden1" id="id_desired_v_proc_hidden1" hidden>        
                  <input type="text" value="" name="proc_pool_hidden1" id="id_proc_pool_hidden1" hidden>        
                  <input type="text" value=""  id="id_input_pool_hidden1" name="input_pool_hidden1" hidden>
                  <input type='text' value="" name='max_proc_hidden1' id="id_max_proc_hidden1" hidden>
                  <input type='text' value="" name='min_proc_hidden1' id="id_min_proc_hidden1" hidden>
                  <input type='text' value="" name='desired_proc_hidden1'  id="id_desired_proc_hidden1" hidden>
                  <input type='text' value="" id="id_value_hidden1" name="value_hidden1" hidden>
                  <input type='text' value="" id="id_value1_hidden1" name="value1_hidden1" hidden>
                  <input type='text' value="" id="id_value2_hidden1" name="value2_hidden1" hidden>
                  <input type="text" name="max_v_adapters_hidden31"  id="id_max_v_adapters_hidden31" hidden  > 
                  <input type="text" name="boot_mode_hidden1" hidden id="id_boot_mode_hidden1" hidden  > 
                  <input type="text" name="check_hidden1" id="id_check_hidden1" hidden> 
                  <input type="text" name="env_hidden1" id="id_env_hidden1" hidden> 
                  <input type="text" name="LPAR_id_hidden1" id="id_LPAR_id_hidden1" hidden> 


                  <input type="text" name="uncap_hidden1" id="id_uncap_hidden1" hidden > 
                  <input type="text" name="uncap_weigth_hidden1" id="id_uncap_weigth_hidden1" hidden > 

                    <table>
                          <tr>
                          <td style="width:40%;text-align:center">
                          
                                <label>Index Slot</label>
                          </td>
                          <td>
                          
                            <input type="text" class="form-control" name="index_slot">
                          </td>
                        </tr>
                        <tr>
                          <td style="width:40%;text-align:center">
                          <br>
                                <label>Type</label>
                          </td>
                          <td>
                          <br>
                          <select class="form-control" name="type_physical_IO">
                          <option value="Ethernet">
                                Ethernet
                              </option>
                              <option  value="Red Controller">
                              Red Controller
                              </option>
                              <option  value="FC">
                              Fibre Channel
                              </option>
                              <option  value="other">
                              Other
                              </option>
                              </select>
                          </td>
                        </tr>
                        <tr>
                          <td style="width:40%;text-align:center">
                          <br>
                                <label>Required</label>
                          </td>
                          <td>
                          <br>
                          Yes
                          <input checked  type="radio" value="required" name="req_des">
                          No
                          <input  type="radio" value="desired" name="req_des">
                          </td>
                        </tr>
          </table>
                  </div>
                  
                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger"  data-dismiss="modal">Close</button>
                  

                    <button type="submit" class="btn btn-success"  >Save</button>
                
                    {!!Form::close()!!}
  </div>
                  
                </div>
              </div>
            </div>
</div>

<button class="accordion"> <i class="fas fa-angle-double-right"></i>   Virtual Adapters</button>
  
<div class="panel" id="panel2" >
      
      
<br>
            <table >
           <tr>
           <td style="width:5%">
           </td>
           <td style="width:20%">
           
           <label>   Maximum virtual adapters:</label>
           </td>
           <td style="width:20%">
            <input type="number" placeholder="0" min="0" value="{{$lpar->max_v_adapters}}" name="max_v_adapters" id="id_max_v_adapters"  class="form-control form-control-sm" > 
           </td>
           <td style="width:30%">
           </td>
           <td style="width:10%">
           <label>Filter By :</label>
           </td>
           <td style="width:30%" >
            <select onclick="selection_type_Adapters()" name="type_select_adapters" id="id_type_select_adapters"  class="form-control form-control-sm" > 
                  <option value="All">
                  All
                  </option>
                  <option value="Ethernet">
                  Virtual Ethernet Adapter
                  </option>
                  <option value="SCSI">
                 Virtual SCSI Adapter
                  </option>
                  <option value="FC">
                  Virtual FC Adapter
                  </option>
            </select>
           </td>
           </tr>
           </table>
           <br>
           <div id="table_all">
     <table class="table table-hover" >
          <thead>
            <tr>
              <th  scope="col" style="text-align:center">#</th>
              <th scope="col" style="text-align:center">Type</th>
              <th scope="col" style="text-align:center">Identifiant</th>
              <th scope="col" style="text-align:center">Required</th>
              <th scope="col" style="text-align:center">Actions</th>

            </tr>
          </thead>
          <tbody>
          <?php
            $i=0;?>
          @if($array1!="[]")
           @foreach($array1 as $fc)
           <?php $i=$i+1;?>
            <tr>
              <th style="text-align:center" scope='row'>{{$i}}</th>
              <td style="text-align:center">Virtual {{$fc->type}}  Adapter</td>
              <td style="text-align:center">{{$fc->id}}</td>
              <td style="text-align:center">

              <?php
              if($fc->isrequired==TRUE)
              echo"Yes";
              else{
              echo"No
              ";}
              ?>
              </td>
              <td style="text-align:center">
              
                 {!!Form::open(['action' => ['LparController@deleteFC',$fc->id], 'method' => 'GET'])!!}       
                 <button type="submit" class="btn btn-outline-danger"style='border-color:white;background-color:white;'>
                <i class="fa fa-trash" aria-hidden="true">
                </i> </button>                
                {!!Form::close()!!}
                 </td>
            </tr>

            @endforeach
            @endif
            <?php
            $j=$i;?>
            @foreach($array2 as $ethernet)
           <?php $j=$j+1;?>
            <tr>
              <th style="text-align:center" scope='row'>{{$j}}</th>
              <td style="text-align:center">Virtual {{$ethernet->type}} Adapter</td>
              <td style="text-align:center">{{$ethernet->id}}</td>
              <td style="text-align:center"><?php
              if($ethernet->isrequired==TRUE)
              echo"Yes";
              else{
              echo"No
              ";}
              ?></td>
              <td style="text-align:center">
                 {!!Form::open(['action' => ['LparController@deleteEth',$ethernet->id], 'method' => 'GET'])!!}       
                 <button type="submit" class="btn btn-outline-danger"style='border-color:white;background-color:white;'>
                <i class="fa fa-trash" aria-hidden="true">
                </i> </button>                
                {!!Form::close()!!}
                 </td>
            </tr>
            @endforeach
            <?php
            $k=$j;?>
            @foreach($array3 as $scsi)
           <?php $k=$k+1;?>
            <tr>
              <th style="text-align:center" scope='row'>{{$k}}</th>
              <td style="text-align:center">Virtual {{$scsi->type}} Adapter</td>
              <td style="text-align:center">{{$scsi->id}}</td>
              <td style="text-align:center"><?php
              if($scsi->isrequired==TRUE)
              echo"Yes";
              else{
              echo"No
              ";}
              ?></td>
              <td style="text-align:center">
              
                 {!!Form::open(['action' => ['LparController@deleteSCSI',$scsi->id], 'method' => 'GET'])!!}       
                 <button type="submit" class="btn btn-outline-danger"style='border-color:white;background-color:white;'>
                <i class="fa fa-trash" aria-hidden="true">
                </i> </button>                
                {!!Form::close()!!}
                 </td>
            </tr>
            @endforeach
            <input id="secret_input_all" name="secret_input_all1" hidden value="{{$k}}" >
          </tbody>
        </table>
        </div>
        <div id="table_fc" style="display:none" >
    <table class="table table-hover" >
          <thead>
            <tr>
              <th style="text-align:center" scope="col">#</th>
              <th style="text-align:center" scope="col">Type</th>
              <th style="text-align:center" scope="col">Identifiant</th>
              <th style="text-align:center" scope="col">Required</th>
              <th style="text-align:center" scope="col">Actions</th>

            </tr>
          </thead>
          <tbody>
          <?php
            $i=0;?>
            @if($array1!="[]")

            @foreach($array1 as $fc)
           <?php $i=$i+1;?>
            <tr>
              <th style="text-align:center" scope='row'>{{$i}}</th>
              <td style="text-align:center">Virtual {{$fc->type}} Adapter</td>
              <td style="text-align:center">{{$fc->id}}</td>
              <td style="text-align:center"><?php
              if($fc->isrequired==TRUE)
              echo"Yes";
              else{
              echo"No
              ";}
              ?></td>
              <td style="text-align:center">
             
                 {!!Form::open(['action' => ['LparController@deleteFC',$fc->id], 'method' => 'GET'])!!}       
                 <button type="submit" class="btn btn-outline-danger"style='border-color:white;background-color:white;'>
                <i class="fa fa-trash" aria-hidden="true">
                </i> </button>                
                {!!Form::close()!!}
                 </td>
            </tr>
            @endforeach
            @endif
            
          </tbody>
        </table>
        </div>
        <div id="table_ethernet" style="display:none">
     <table class="table table-hover"  >
          <thead>
            <tr>
              <th style="text-align:center" scope="col">#</th>
              <th style="text-align:center" scope="col">Type</th>
              <th style="text-align:center" scope="col">Identifiant</th>
              <th style="text-align:center" scope="col">Required</th>
              <th style="text-align:center" scope="col">Actions</th>

            </tr>
          </thead>
          <tbody>
          <?php
            $j=0;?>
            @foreach($array2 as $ethernet)
           <?php $j=$j+1;?>
            <tr>
              <th style="text-align:center" scope='row'>{{$j}}</th>
              <td style="text-align:center">Virtual {{$ethernet->type}} Adapter</td>
              <td style="text-align:center">{{$ethernet->id}}</td>
              <td style="text-align:center"><?php
              if($ethernet->isrequired==TRUE)
              echo"Yes";
              else{
              echo"No
              ";}
              ?></td>
              <td style="text-align:center">
             
             
                 {!!Form::open(['action' => ['LparController@deleteEth',$ethernet->id], 'method' => 'GET'])!!}       
                 <button type="submit" class="btn btn-outline-danger"style='border-color:white;background-color:white;'>
                <i class="fa fa-trash" aria-hidden="true">
                </i> </button>                
                {!!Form::close()!!}
                 </td>
            </tr>
            @endforeach
            

          </tbody>
        </table>
        </div>
    <div id="table_scsi" style="display:none">
     <table class="table table-hover"  >
          <thead>
            <tr>
              <th style="text-align:center" scope="col">#</th>
              <th style="text-align:center" scope="col">Type</th>
              <th style="text-align:center" scope="col">Identifiant</th>
              <th style="text-align:center"  scope="col">Required</th>
              <th style="text-align:center"  scope="col">Actions</th>

            </tr>
          </thead>
          <tbody>
          <?php
            $k=0;?>
            @foreach($array3 as $scsi)
           <?php $k=$k+1;?>
            <tr>
              <th style="text-align:center" scope='row'>{{$k}}</th>
              <td style="text-align:center">Virtual {{$scsi->type}} Adapter</td>
              <td style="text-align:center">{{$scsi->id}}</td>
              <td style="text-align:center">
              <?php
              if($scsi->isrequired==TRUE)
              echo"Yes";
              else{
              echo"No";}
              ?></td>
              <td style="text-align:center">

              
                 {!!Form::open(['action' => ['LparController@deleteSCSI',$scsi->id], 'method' => 'GET'])!!}       

                 <button type="submit" class="btn btn-outline-danger"style='border-color:white;background-color:white;'>
                 <i class="fa fa-trash" aria-hidden="true">
                 </i> </button>                
                  {!!Form::close()!!}

                 </td>
            </tr>
            @endforeach

          </tbody>
        </table>

        </div>
           <br>
    
   
           <table>
           <tr> 
            <td style="width:40%;text-align:right">
                <button style="margin-left:200px" id="btn_scsi" data-toggle="modal" data-target="#myModal4" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>
                  Virtal SCSI Adapter
                </button>

                {!!Form::open(['action' => ['LparController@createSCSI',$client->id,$lpar->id], 'method' => 'POST'])!!}       
                <input type="text" name="max_v_adapters_hidden"   hidden id="id_max_v_adapters_hidden"  class="form-control form-control-sm" > 
                <input type="text" value="" name="template_name_hidden2" id="id_template_name_hidden2" hidden>        
                  <input type="text" value="" name="profile_name_hidden2" id="id_profile_name_hidden2" hidden>        
                  <input type="text" value="" name="radio_hidden2" id="id_radio_hidden2" hidden>        
                  <input type="text" value="" name="max_proc_units_hidden2" id="id_max_proc_units_hidden2" hidden>        
                  <input type="text" value="" name="min_proc_units_hidden2" id="id_min_proc_units_hidden2"hidden>        
                  <input type="text" value="" name="desired_proc_units_hidden2" id="id_desired_proc_units_hidden2"hidden >        
                  <input type="text" value="" name="sync_conf_hidden2" id="id_sync_conf_hidden2"hidden>        
                  <input type="text" value="" name="min_v_proc_hidden2" id="id_min_v_proc_hidden2" hidden>        
                  <input type="text" value="" name="max_v_proc_hidden2" id="id_max_v_proc_hidden2" hidden>        
                  <input type="text" value="" name="desired_v_proc_hidden2" id="id_desired_v_proc_hidden2" hidden>        
                  <input type="text" value="" name="proc_pool_hidden2" id="id_proc_pool_hidden2" hidden>        
                  <input type="text" value=""  id="id_input_pool_hidden2" name="input_pool_hidden2" hidden>
                  <input type='text' value="" name='max_proc_hidden2' id="id_max_proc_hidden2" hidden>
                  <input type='text' value="" name='min_proc_hidden2' id="id_min_proc_hidden2" hidden>
                  <input type='text' value="" name='desired_proc_hidden2'  id="id_desired_proc_hidden2" hidden>
                  <input type='text' value="" id="id_value_hidden2" name="value_hidden2" hidden>
                  <input type='text' value="" id="id_value1_hidden2" name="value1_hidden2" hidden>
                  <input type='text' value="" id="id_value2_hidden2" name="value2_hidden2" hidden>
                  <input type="text" name="max_v_adapters_hidden32"  id="id_max_v_adapters_hidden32" hidden  > 
                  <input type="text" name="boot_mode_hidden2" hidden id="id_boot_mode_hidden2" hidden  > 
                  <input type="text" name="check_hidden2" id="id_check_hidden2" hidden> 
                  <input type="text" name="env_hidden2" id="id_env_hidden2" hidden> 
                  <input type="text" name="LPAR_id_hidden2" id="id_LPAR_id_hidden2" hidden> 
                  <input type="text" name="uncap_hidden2" id="id_uncap_hidden2"  hidden> 
                  <input type="text" name="uncap_weigth_hidden2" id="id_uncap_weigth_hidden2" hidden > 

                    
               
            <!-- The Modal -->
            <div class="modal fade" id="myModal4">
              <div class="modal-dialog">
                <div class="modal-content">
                
                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">New Virtual SCSI Adapter
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  
                  <!-- Modal body -->
                  <div class="modal-body">
                   


                  <div id="table_vios">
                    <table  >
                    <tr>
                          <td style="width:40%;text-align:left"><br><label>
                          Adapter Id*</label>
                          </td>
                          <td>
                          <br>
                          <input type="number" min="2" placeholder="2" class ="form-control" name="adapter" >
                          </td>
                        </tr>
                          <tr>
                          <td style="width:40%;text-align:left">
                          <br>
                                <label>Type of Adapter*</label>
                          </td>
              
                          <td>
                          <br>
                            <select class="form-control" disabled id='adapter_select' name="adapter_select_1">
                            <option  value="Server">
                                Server
                              </option>
                              <option value="Client">
                                Client
                              </option>
                            
                              </select>
                          </td>
                        </tr>
                        </table>
                        <table>
                        
                        <tr>
                        <td style="text-align:left">
                        <br>
                        <input type="radio" checked name="1_client" value="yes" id="id_all_client">
                        <label>Any Client Partition can connect</label>
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <br>
                        <input type="radio" name="1_client" value="no" id="id_1_client">
                        <label>Only Selected Client Partition can connect</label>
                        </td>
                        </tr>
</table>
<table>
                        <tr>
                          <td style="width:40%;text-align:left">
                          <br>
                          <label >Client Partition
                                </label> </td>
                          <td>
                          <br>
                          <select class="form-control" onclick="partition_target()" disabled name="partition_select_1" id="id_partition_select">
                              <option>
                              </option>
                              @foreach($array4 as $lpar)
                              <option value="{{$lpar->LPAR_name}}">
                              {{$lpar->LPAR_name}}
                              </option>
                              @endforeach
                              <option  value="other">
                             <label> <B> Other</B></label>
                              </option>
                              </select>
                              <input type='text' hidden name="partion_target_hidden" id="id_partion_target_hidden">
                          </td>
                          <tr >
                          <td>
                          </td>
                          <td>
                          <br>
                          <input style='height:5%;display:none'  class="form-control"  type="text" name="client_partition_1" id="client_p_id">
                          </td>
                          </tr>

                        <tr>
                          <td style="width:40%;text-align:left">
                          <br>
                          <label >Client Adapter Id
                                </label>                          </td>
                          <td>
                          <br>
                          <input type="number" disabled min="2" class ="form-control" name="client_adapter_id"  id="id_client_adapter_id">

                          </td>
                        </tr>
                        
                        <td style="width:40%;text-align:left">
                        <br>
                                <label >Required:</label>
                        </td>
                        <td style="text-align:left">
                        <br>
                        Yes
                        <input type="radio" checked value="yes" name="req_SCSI">
                        No
                        <input type="radio" value="no" name="req_SCSI">
                        
                        </td>
                        <tr>
                        </tr>
          </table>
          </div>
          <div id="table_aix">
          <table  >
                    <tr>
                          <td style="width:40%;text-align:left"><br><label>
                          Adapter Id*</label>
                          </td>
                          <td>
                          <br>
                          <input type="number" min="2" placeholder="2" class ="form-control" name="adapter_id" >
                          </td>
                        </tr>
                          <tr>
                          <td style="width:40%;text-align:left">
                          <br>
                                <label>Type of Adapter*</label>
                          </td>
              
                          <td>
                          <br>
                            <select class="form-control" disabled id='adapter_select' name="adapter_select">
                            <option value="Client">
                                Client
                              </option>
                            <option  value="Server">
                                Server
                              </option>
                              
                            
                              </select>
                          </td>
                        </tr>
                        </table>
                        
                        <table>

                        <tr>
                          <td style="width:40%;text-align:left">
                          <br>
                          <label >Server Partition
                                </label> </td>
                          <td>
                          <br>
                          <select class="form-control"  name="partition_select" id="id_partition_select">
                              
                              @foreach($array5 as $lpar)
                              <option value="{{$lpar->LPAR_name}}">
                              {{$lpar->LPAR_name}}
                              </option>
                              @endforeach
                              
                              </select>

                          </td>
                         
                        <tr>
                          <td style="width:40%;text-align:left">
                          <br>
                          <label >Server Adapter Id
                                </label>                          </td>
                          <td>
                          <br>
                          <input type="number"  min="2" class ="form-control" name="client_adapter_id_1"  id="id_client_adapter_id">

                          </td>
                        </tr>
                        
                        <td style="width:40%;text-align:left">
                        <br>
                                <label >Required:</label>
                        </td>
                        <td style="text-align:left">
                        <br>
                        Yes
                        <input type="radio" checked value="yes" name="req_SCSI_1">
                        No
                        <input type="radio" value="no" name="req_SCSI_1">
                        
                        </td>
                        <tr>
                        </tr>
          </table>

          </div>

                  </div>
                  <!-- Modal footer -->
                  <div class="modal-footer">  
                  <button type="submit" class="btn btn-success"  >Save</button>
                    <button type="button" class="btn btn-danger"  data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            {!!Form::close()!!}
            </td>
            <td style="width:40%;text-align:center">
               <button style="margin-left:50px" class="btn btn-primary" data-toggle="modal" data-target="#myModal2" id="btn_ethernet" ><i class="fa fa-plus" aria-hidden="true"></i>   Virtual Ethernet Adapter</button>
               {!!Form::open(['action' => ['LparController@createEthernet',$client->id,$lpar->id], 'method' => 'POST'])!!}       
               <input type="text" name="max_v_adapters_hidden1" hidden id="id_max_v_adapters_hidden1"  class="form-control form-control-sm" hidden> 

     
               <input type="text" value="" name="template_name_hidden3" id="id_template_name_hidden3" hidden>        
          <input type="text" value="" name="profile_name_hidden3" id="id_profile_name_hidden3" hidden>        
          <input type="text" value="" name="radio_hidden3" id="id_radio_hidden3"hidden >        
          <input type="text" value="" name="max_proc_units_hidden3" id="id_max_proc_units_hidden3" hidden>        
          <input type="text" value="" name="min_proc_units_hidden3" id="id_min_proc_units_hidden3" hidden>        
          <input type="text" value="" name="desired_proc_units_hidden3" id="id_desired_proc_units_hidden3" hidden>        
          <input type="text" value="" name="sync_conf_hidden3" id="id_sync_conf_hidden3" hidden>        
          <input type="text" value="" name="min_v_proc_hidden3" id="id_min_v_proc_hidden3" hidden>        
          <input type="text" value="" name="max_v_proc_hidden3" id="id_max_v_proc_hidden3" hidden>        
          <input type="text" value="" name="desired_v_proc_hidden3" id="id_desired_v_proc_hidden3" hidden>        
          <input type="text" value="" name="proc_pool_hidden3" id="id_proc_pool_hidden3" hidden>        
          <input type="text" value=""  id="id_input_pool_hidden3" name="input_pool_hidden3" hidden>
          <input type='text' value="" name='max_proc_hidden3' id="id_max_proc_hidden3" hidden>
          <input type='text' value="" name='min_proc_hidden3' id="id_min_proc_hidden3" hidden>
          <input type='text' value="" name='desired_proc_hidden3'  id="id_desired_proc_hidden3" hidden>
          <input type='text' value="" id="id_value_hidden3" name="value_hidden3" hidden>
          <input type='text' value="" id="id_value1_hidden3" name="value1_hidden3" hidden>
          <input type='text' value="" id="id_value2_hidden3" name="value2_hidden3" hidden>
          <input type="text" name="max_v_adapters_hidden33" hidden id="id_max_v_adapters_hidden33"   > 
          <input type="text" name="boot_mode_hidden3" hidden id="id_boot_mode_hidden3" hidden  > 
          <input type="text" name="check_hidden3" id="id_check_hidden3" hidden> 
          <input type="text" name="env_hidden3" id="id_env_hidden3" hidden> 
          <input type="text" name="LPAR_id_hidden3" id="id_LPAR_id_hidden3" hidden> 


          <input type="text" name="uncap_hidden3" id="id_uncap_hidden3" hidden > 
          <input type="text" name="uncap_weigth_hidden3" id="id_uncap_weigth_hidden3" hidden > 

                <!-- The Modal -->
            <div class="modal fade" id="myModal2">
              <div class="modal-dialog">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">New virtual Ethernet Adapter</h4>
                    <button type="button"  class="close" data-dismiss="modal">&times;</button>
                  </div>
                  
                  <!-- Modal body -->
                  <div class="modal-body">
                    <table>
                    <tr>
                          <td style="width:40%;text-align:left"><br>
                        <label>  Adapter Id*</label>
                          </td>
                          <td>
                          <br>
                          <input type="number" min="2" class ="form-control" name="adapter_id" >
                          </td>
                        </tr>
                          <tr>
                          <td style="width:40%;text-align:left" ><br>
                      <label>    PV_id* </label>
                          </td>
                          <td>
                          <br>
                          <input type="number" class ="form-control" name="pv_id" >
                          </td>
                        </tr>
                        <tr>
                          <td style="width:40%;text-align:left">
                          <br>
                        <label >  VLANS </label>
                          </td>
                          <td >
                          <br>
                          <input type="text" class ="form-control" name="vlans" >
                          </td>
                          </tr>
                          <tr>
                          <td style="width:40%;text-align:left"><br>
                         <label > VSwitch* </label>
                          </td>
                          <td>
                          <br>
                          <select name="vswitch" id="vswitch_id" onclick="fctVS()" class="form-control" >

    <option value="Default">
      Ethernet0(Default)
    </option>
    <option value="Other">
      Other
    </option>

    </select>
    </td>
    </tr>
    <tr>
    <td>
    </td>
    <td>
    <br>
    <input type="text" placeholder="Enter vswitch name ..." style="display:none" name="hidden_vs" class="form-control" id="id_vs_hidden">
    </td>
    </tr>
                              <tr>
                              <td style="width:40%;text-align:left">
                              <br>
                            <label>  Required : </label>
                              </td>
                              <td style="text-align:left">
                          <br>
                          <input type="radio" checked value ="yes" name="ethernet_req" >
                          Yes
                          <input type="radio"   value ="no" name="ethernet_req" >
                          No
                          </td>
                        </tr>
                        <tr>
                          <td style="width:40%;text-align:left">
                          <br>
                          <label> Ieee : </label>
                          </td>
                          <td style="text-align:left">
                          <br>
                          <input type="radio" value ="yes" name="ieee_req" >
                          Yes
                          <input type="radio"   checked value ="no" name="ieee_req" >
                          No
                          </td>
                        </tr>
          </table>
                  </div>
                  
                  
                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success"   >Save</button>
                    <button type="button" class="btn btn-danger"  data-dismiss="modal">Close</button>
                  </div>
                  
                </div>
              </div>
            </div>
            {!!Form::close()!!}
              </td>
            <td style="width:40%;text-align:left">
            <button style="margin-left:50px" id="btn_fc" class="btn btn-primary"  data-toggle="modal" data-target="#myModal3"><i class="fa fa-plus" aria-hidden="true"></i>   Virtual FC Adapter</button>
            {!!Form::open(['action' => ['LparController@createFC',$client->id,$lpar->id], 'method' => 'POST'])!!}       
            <input type="text" name="max_v_adapters_hidden2" hidden  id="id_max_v_adapters_hidden2"  hidden class="form-control form-control-sm" > 

  
            <input type="text" value="" name="template_name_hidden4" id="id_template_name_hidden4" hidden>        
          <input type="text" value="" name="profile_name_hidden4" id="id_profile_name_hidden4" hidden>        
          <input type="text" value="" name="radio_hidden4" id="id_radio_hidden4"hidden >        
          <input type="text" value="" name="max_proc_units_hidden4" id="id_max_proc_units_hidden4" hidden>        
          <input type="text" value="" name="min_proc_units_hidden4" id="id_min_proc_units_hidden4" hidden>        
          <input type="text" value="" name="desired_proc_units_hidden4" id="id_desired_proc_units_hidden4" hidden>        
          <input type="text" value="" name="sync_conf_hidden4" id="id_sync_conf_hidden4" hidden>        
          <input type="text" value="" name="min_v_proc_hidden4" id="id_min_v_proc_hidden4" hidden>        
          <input type="text" value="" name="max_v_proc_hidden4" id="id_max_v_proc_hidden4" hidden>        
          <input type="text" value="" name="desired_v_proc_hidden4" id="id_desired_v_proc_hidden4" hidden>        
          <input type="text" value="" name="proc_pool_hidden4" id="id_proc_pool_hidden4" hidden>        
          <input type="text" value=""  id="id_input_pool_hidden4" name="input_pool_hidden4" hidden>
          <input type='text' value="" name='max_proc_hidden4' id="id_max_proc_hidden4" hidden>
          <input type='text' value="" name='min_proc_hidden4' id="id_min_proc_hidden4" hidden>
          <input type='text' value="" name='desired_proc_hidden4'  id="id_desired_proc_hidden4" hidden>
          <input type='text' value="" id="id_value_hidden4" name="value_hidden4" hidden>
          <input type='text' value="" id="id_value1_hidden4" name="value1_hidden4" hidden>
          <input type='text' value="" id="id_value2_hidden4" name="value2_hidden4" hidden>
          <input type="text" name="max_v_adapters_hidden34"  id="id_max_v_adapters_hidden34" hidden  > 
          <input type="text" name="boot_mode_hidden4" hidden id="id_boot_mode_hidden4" hidden  > 
          <input type="text" name="check_hidden4" id="id_check_hidden4" hidden> 
          <input type="text" name="env_hidden4" id="id_env_hidden4" hidden> 
          <input type="text" name="LPAR_id_hidden4" id="id_LPAR_id_hidden4" hidden> 


          <input type="text" name="uncap_hidden4" id="id_uncap_hidden4" hidden > 
          <input type="text" name="uncap_weigth_hidden4" id="id_uncap_weigth_hidden4" hidden > 

           
           <!-- The Modal -->
           <div class="modal fade" id="myModal3">
              <div class="modal-dialog">
                <div class="modal-content">
                
                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">New Virtual FC Adapter
                  </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  
                  <!-- Modal body -->
                  <div class="modal-body">
                    <table>
                    <tr>
                          <td style="width:50%"><br>
                          <label>Adapter Id*</label>
                          </td>
                          <td>
                          <br>
                          <input type="number" min="2" class ="form-control" name="adapter_id" >
                          </td>
                        </tr>
                          <tr>
                            <td>
                            <br>
                            <label>Server Partition*</label>
                            </td>
                            <td>  
                            <br>
                            <input type="text" class ="form-control" name="server_partition" >
                            </td>
                          </tr>
                          <tr>
                            <td>
                            <br>
                            <label>World Wide Port Name*</label>
                            </td>
                            <td>
                            <br>
                            <input type="text" class ="form-control" name="wwpn" >
                            </td>
                          </tr>
                          <tr>
                            <td>
                            <br>
                            <label>World Wide Port Name LPM*</label>
                            </td>
                            <td>
                            <br>
                            <input type="text" class ="form-control" name="lpm" >
                            </td>
                          </tr>
                          <tr>
                          <td>
                          <br><label>
                          Required: </label>
                          </td>
                          <td>
                          <br>
                          <input type="radio" checked value ="yes" name="fc_req" >
                          Yes
                          <input type="radio"   value ="no" name="fc_req" >
                          No
                          </td>
                        </tr>
          </table>
                  </div>
                  
                  <!-- Modal footer -->
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-success"  >Save</button>
                    <button type="button" class="btn btn-danger"  data-dismiss="modal">Close</button>
                  </div>
                  
                </div>
              </div>
            </div>
{!!Form::close()!!}
          </td>

          </tr>
          </table>
<br>
    </div>


   <button class="accordion"><i class="fas fa-angle-double-right"></i> Optional Settings</button>
        <div class="panel">
        <table> 
            <tr>
            @if($lpar->isEnable_Connection_Monitoring==1)
                <td style="width:500px">
              <input  style="color:red" name="check" checked type="radio" id="id_check3" value="cnx_monit" > Enable connection monitoring 
                </td>
                @else
                <td style="width:500px">
              <input  style="color:red" name="check" type="radio" id="id_check3" value="cnx_monit" > Enable connection monitoring 
                </td>
                @endif

                <td>
                
                <label>Boot mode</label>
                </td>
                
                </tr>

        
        <tr>
        @if($lpar->isAuto_StartWithMangedSys==1)
                <td>
                <input type=radio name="check" value="auto" checked id="id_check2"> Automatically start with managed system 
                </td>
                @else
                <td>
                <input type=radio name="check" value="auto"  id="id_check2"> Automatically start with managed system 
                </td>
                @endif
                @if($lpar->isNormal_BootMode==1)
                <td>
                <input  type="radio" name="boot_mode" checked id="id_boot_mode_nrml" value='normal' checked>Normal
                </td>
                @else
                <td>
                <input  type="radio" name="boot_mode"  id="id_boot_mode_nrml" value='normal' checked>Normal
                </td>@endif
        </tr>
        <tr>
        @if($lpar->isEnable_redundant_Error_Path_report==1)
                <td>
             <input type='radio' name="check" checked value="redund" id="id_check1"> Enable redundant error path reporting  
                </td>
                @else
                <td>
             <input type='radio' name="check"  value="redund" id="id_check1"> Enable redundant error path reporting  
                </td>
                @endif
                @if($lpar->isSMS_BootMode==1)
                <td>
                <input type="radio" name="boot_mode" checked id="id_boot_mode_sms" value="sms">System Managment Services(SMS)
                </td>
                @else
                <td>
                <input type="radio" name="boot_mode"  id="id_boot_mode_sms" value="sms">System Managment Services(SMS)
                </td>
                @endif
              
        </tr>
        </table>
        <table>
        <tr>
        <td>
        <br>
        
        
          </td>
        </tr>

</table>
        </div>
        <br>
        <br>
          <div class="row">
          <div class="col-lg-6" style="text-align:right">

              {!!Form::open(['action' => ['LPARController@CreateLPAR',$lpar->id], 'method' => 'POST'])!!}       
            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>Save</button>

            <input type="text" value="" name="template_name_hidden" id="id_template_name_hidden" hidden>        
          <input type="text" value="" name="profile_name_hidden" id="id_profile_name_hidden" hidden>        
          <input type="text" value="" name="radio_hidden" id="id_radio_hidden"hidden >        
          <input type="text" value="" name="max_proc_units_hidden" id="id_max_proc_units_hidden" hidden>        
          <input type="text" value="" name="min_proc_units_hidden" id="id_min_proc_units_hidden" hidden>        
          <input type="text" value="" name="desired_proc_units_hidden" id="id_desired_proc_units_hidden" hidden>        
          <input type="text" value="" name="sync_conf_hidden" id="id_sync_conf_hidden" hidden>        
          <input type="text" value="" name="min_v_proc_hidden" id="id_min_v_proc_hidden" hidden>        
          <input type="text" value="" name="max_v_proc_hidden" id="id_max_v_proc_hidden" hidden>        
          <input type="text" value="" name="desired_v_proc_hidden" id="id_desired_v_proc_hidden" hidden>        
          <input type="text" value="" name="proc_pool_hidden" id="id_proc_pool_hidden" hidden>        
          <input type="text" value=""  id="id_input_pool_hidden" name="input_pool_hidden" hidden>
          <input type='text' value="" name='max_proc_hidden' id="id_max_proc_hidden" hidden>
          <input type='text' value="" name='min_proc_hidden' id="id_min_proc_hidden" hidden>
          <input type='text' value="" name='desired_proc_hidden'  id="id_desired_proc_hidden" hidden>
          <input type='text' value="" id="id_value_hidden" name="value_hidden" hidden>
          <input type='text' value="" id="id_value1_hidden" name="value1_hidden" hidden>
          <input type='text' value="" id="id_value2_hidden" name="value2_hidden" hidden>
          <input type="text" name="max_v_adapters_hidden3"  id="id_max_v_adapters_hidden3" hidden  > 
          <input type="text" name="boot_mode_hidden" hidden id="id_boot_mode_hidden" hidden  > 
          <input type="text" name="check_hidden" id="id_check_hidden" hidden> 
          <input type="text" name="env_hidden" id="id_env_hidden" hidden> 
          <input type="text" name="LPAR_id_hidden" id="id_LPAR_id_hidden" hidden> 


          <input type="text" name="uncap_hidden" id="id_uncap_hidden"  hidden> 
          <input type="text" name="uncap_weigth_hidden" id="id_uncap_weigth_hidden" hidden > 

       
        {!!Form::close()!!}
       </div>
        <?php 
          $server=Server::find($lpar->Server_FK_id);
          $client=Client::find($server->Client_FK_id);
          ?>
                    <div class="col-lg-6" style="text-align:left">

        {!!Form::open(['action' => ['LPARController@edit',$client->id,$server->id,$lpar->id], 'method' => 'GET'])!!}       
            <button  type="submit" class="btn btn-danger">Cancel</button>
            {!!Form::close()!!}

             </div>
              </div>
<script>
//env
var input_env = document.getElementById("id_env");
 document.getElementById("id_env_hidden").value=input_env.value;
 document.getElementById("id_env_hidden1").value=input_env.value;
 document.getElementById("id_env_hidden2").value=input_env.value;
 document.getElementById("id_env_hidden3").value=input_env.value;
 document.getElementById("id_env_hidden4").value=input_env.value;


 function env_click(){
  document.getElementById("id_env_hidden").value=input_env.value;
  document.getElementById("id_env_hidden1").value=input_env.value;
  document.getElementById("id_env_hidden2").value=input_env.value;
  document.getElementById("id_env_hidden3").value=input_env.value;
  document.getElementById("id_env_hidden4").value=input_env.value;

 }
 //id_LPAR
 var input_LPAR_id = document.getElementById("id_LPAR_id");
 var input_LPAR_id_hidden = document.getElementById("id_LPAR_id_hidden");
 var input_LPAR_id_hidden1 = document.getElementById("id_LPAR_id_hidden1");
 var input_LPAR_id_hidden2 = document.getElementById("id_LPAR_id_hidden2");
 var input_LPAR_id_hidden3 = document.getElementById("id_LPAR_id_hidden3");
 var input_LPAR_id_hidden4 = document.getElementById("id_LPAR_id_hidden4");

 input_LPAR_id_hidden.value=input_LPAR_id.value;
 input_LPAR_id_hidden1.value=input_LPAR_id.value;
 input_LPAR_id_hidden2.value=input_LPAR_id.value;
 input_LPAR_id_hidden3.value=input_LPAR_id.value;
 input_LPAR_id_hidden4.value=input_LPAR_id.value;

 input_LPAR_id.oninput= function() {
  input_LPAR_id_hidden.value = this.value;
  input_LPAR_id_hidden1.value = this.value;
  input_LPAR_id_hidden2.value = this.value;
  input_LPAR_id_hidden3.value = this.value;
  input_LPAR_id_hidden4.value = this.value;


}
//uncap
var input_uncap = document.getElementById("id_uncap_hidden");
var input_uncap1 = document.getElementById("id_uncap_hidden1");
var input_uncap2 = document.getElementById("id_uncap_hidden2");
var input_uncap3 = document.getElementById("id_uncap_hidden3");
var input_uncap4 = document.getElementById("id_uncap_hidden4");

var input_uncap_weight=document.getElementById("id_uncap_weight");
var input_uncap_weight_hidden=document.getElementById("id_uncap_weigth_hidden");
var input_uncap_weight_hidden1=document.getElementById("id_uncap_weigth_hidden1");
var input_uncap_weight_hidden2=document.getElementById("id_uncap_weigth_hidden2");
var input_uncap_weight_hidden3=document.getElementById("id_uncap_weigth_hidden3");
var input_uncap_weight_hidden4=document.getElementById("id_uncap_weigth_hidden4");


input_uncap_weight_hidden.value=input_uncap_weight.value;
input_uncap_weight_hidden1.value=input_uncap_weight.value;
input_uncap_weight_hidden2.value=input_uncap_weight.value;
input_uncap_weight_hidden3.value=input_uncap_weight.value;
input_uncap_weight_hidden4.value=input_uncap_weight.value;

var input_uncap_secret=document.getElementById("uncap_secret");
input_uncap.value=input_uncap_secret.value;
input_uncap1.value=input_uncap_secret.value;
input_uncap2.value=input_uncap_secret.value;
input_uncap3.value=input_uncap_secret.value;
input_uncap4.value=input_uncap_secret.value;

function activ_uncap(){
  if(document.getElementById("id_incap").value=='Uncapped'){
  document.getElementById("p_uncap").style.display="block";
  document.getElementById("id_uncap_weight").style.display="block";
  input_uncap.value="1";
  input_uncap1.value="1";
  input_uncap2.value="1";
  input_uncap3.value="1";
  input_uncap4.value="1";




  document.getElementById("id_uncap_weight").value=null;
  }
  else{
    input_uncap_weight_hidden.value=0;
    document.getElementById("p_uncap").style.display="none";
  document.getElementById("id_uncap_weight").style.display="none";
  input_uncap.value="0";
  input_uncap1.value="0";
  input_uncap2.value="0";
  input_uncap3.value="0";
  input_uncap4.value="0";


  document.getElementById("id_uncap_weight").value=null;

  }
}

input_uncap_weight.oninput = function() {
  input_uncap_weight_hidden.value=input_uncap_weight.value;
  input_uncap_weight_hidden1.value=input_uncap_weight.value;
  input_uncap_weight_hidden2.value=input_uncap_weight.value;
  input_uncap_weight_hidden3.value=input_uncap_weight.value;
  input_uncap_weight_hidden4.value=input_uncap_weight.value;

}

//boot_mode

var input_boot_mode1 = document.getElementById("id_boot_mode_sms");
var input_boot_mode2 = document.getElementById("id_boot_mode_nrml");
var input_boot_mode_hidden = document.getElementById("id_boot_mode_hidden");
var input_boot_mode_hidden1 = document.getElementById("id_boot_mode_hidden1");
var input_boot_mode_hidden2 = document.getElementById("id_boot_mode_hidden2");
var input_boot_mode_hidden3 = document.getElementById("id_boot_mode_hidden3");
var input_boot_mode_hidden4= document.getElementById("id_boot_mode_hidden4");

input_boot_mode_hidden.value =input_boot_mode2.value ;
input_boot_mode_hidden1.value =input_boot_mode2.value ;
input_boot_mode_hidden2.value =input_boot_mode2.value ;
input_boot_mode_hidden3.value =input_boot_mode2.value ;
input_boot_mode_hidden4.value =input_boot_mode2.value ;


input_boot_mode1.oninput = function() {
  input_boot_mode_hidden.value = this.value;
  input_boot_mode_hidden1.value = this.value;
  input_boot_mode_hidden2.value = this.value;
  input_boot_mode_hidden3.value = this.value;
  input_boot_mode_hidden4.value = this.value;

}
input_boot_mode2.oninput = function() {
  input_boot_mode_hidden.value = this.value;
  input_boot_mode_hidden1.value = this.value;
  input_boot_mode_hidden2.value = this.value;
  input_boot_mode_hidden3.value = this.value;
  input_boot_mode_hidden4.value = this.value;

}


//check
var input_check1 = document.getElementById("id_check1");
var input_check2 = document.getElementById("id_check2");
var input_check3 = document.getElementById("id_check3");

var input_check_hidden = document.getElementById("id_check_hidden");
var input_check_hidden1 = document.getElementById("id_check_hidden1");
var input_check_hidden2 = document.getElementById("id_check_hidden2");
var input_check_hidden3 = document.getElementById("id_check_hidden3");
var input_check_hidden4 = document.getElementById("id_check_hidden4");

input_check_hidden.value =input_check2.value ;
input_check_hidden1.value =input_check2.value ;
input_check_hidden2.value =input_check2.value ;
input_check_hidden3.value =input_check2.value ;
input_check_hidden4.value =input_check2.value ;

input_check1.oninput = function() {
  input_check_hidden.value = this.value;
  input_check_hidden1.value = this.value;
  input_check_hidden2.value = this.value;
  input_check_hidden3.value = this.value;
  input_check_hidden4.value = this.value;

}
input_check2.oninput = function() {
  input_check_hidden.value = this.value;
  input_check_hidden1.value = this.value;
  input_check_hidden2.value = this.value;
  input_check_hidden3.value = this.value;
  input_check_hidden4.value = this.value;

}
input_check3.oninput = function() {
  input_check_hidden.value = this.value;
  input_check_hidden1.value = this.value;
  input_check_hidden2.value = this.value;
  input_check_hidden3.value = this.value;
  input_check_hidden4.value = this.value;

}
 //max_v_adapters
 
 document.getElementById("btn_ethernet").disabled=true;
 document.getElementById("btn_fc").disabled=true;
 document.getElementById("btn_scsi").disabled=true;

 var secret_input_all_elem=document.getElementById("secret_input_all");
 var input_max_v_adapters=document.getElementById("id_max_v_adapters");
 var input_max_v_adapters_hidden=document.getElementById("id_max_v_adapters_hidden");
 var input_max_v_adapters_hidden1=document.getElementById("id_max_v_adapters_hidden1");
 var input_max_v_adapters_hidden2=document.getElementById("id_max_v_adapters_hidden2");
 var input_max_v_adapters_hidden3=document.getElementById("id_max_v_adapters_hidden3");
 var input_max_v_adapters_hidden31=document.getElementById("id_max_v_adapters_hidden31");
 var input_max_v_adapters_hidden32=document.getElementById("id_max_v_adapters_hidden32");
 var input_max_v_adapters_hidden33=document.getElementById("id_max_v_adapters_hidden33");
 var input_max_v_adapters_hidden34=document.getElementById("id_max_v_adapters_hidden34");
 input_max_v_adapters_hidden33.value=input_max_v_adapters.value;
 input_max_v_adapters_hidden3.value=input_max_v_adapters.value;
 input_max_v_adapters_hidden31.value=input_max_v_adapters.value;
 input_max_v_adapters_hidden32.value=input_max_v_adapters.value;
 input_max_v_adapters_hidden34.value=input_max_v_adapters.value;

 if(secret_input_all_elem.value>=input_max_v_adapters.value){
          document.getElementById("btn_ethernet").disabled=true;
          document.getElementById("btn_fc").disabled=true;
          document.getElementById("btn_scsi").disabled=true;}
else{

            document.getElementById("btn_ethernet").disabled=false;
            document.getElementById("btn_fc").disabled=false;
            document.getElementById("btn_scsi").disabled=false;
}

input_max_v_adapters.oninput = function() {
          input_max_v_adapters_hidden.value=input_max_v_adapters.value;
          input_max_v_adapters_hidden1.value=input_max_v_adapters.value;
          input_max_v_adapters_hidden2.value=input_max_v_adapters.value;
          input_max_v_adapters_hidden3.value=input_max_v_adapters.value;
          input_max_v_adapters_hidden31.value=input_max_v_adapters.value;
          input_max_v_adapters_hidden32.value=input_max_v_adapters.value;
          input_max_v_adapters_hidden33.value=input_max_v_adapters.value;
          input_max_v_adapters_hidden34.value=input_max_v_adapters.value;

          if(input_max_v_adapters.value<=secret_input_all_elem.value){
            document.getElementById("btn_ethernet").disabled=true;
            document.getElementById("btn_fc").disabled=true;
            document.getElementById("btn_scsi").disabled=true;  
          }
          else{
            document.getElementById("btn_ethernet").disabled=false;
            document.getElementById("btn_fc").disabled=false;
            document.getElementById("btn_scsi").disabled=false;
}


}
    

//sync_conf
var input_sync_conf = document.getElementById("id_sync_conf");
var input_sync_conf_hidden = document.getElementById("id_sync_conf_hidden");
var input_sync_conf_hidden1 = document.getElementById("id_sync_conf_hidden1");
var input_sync_conf_hidden2 = document.getElementById("id_sync_conf_hidden2");
var input_sync_conf_hidden3 = document.getElementById("id_sync_conf_hidden3");
var input_sync_conf_hidden4 = document.getElementById("id_sync_conf_hidden4");

input_sync_conf_hidden.value = input_sync_conf.value;
input_sync_conf_hidden1.value = input_sync_conf.value;
input_sync_conf_hidden2.value = input_sync_conf.value;
input_sync_conf_hidden3.value = input_sync_conf.value;
input_sync_conf_hidden4.value = input_sync_conf.value;

input_sync_conf.oninput = function() {
  input_sync_conf_hidden.value = this.value;
  input_sync_conf_hidden1.value = this.value;
  input_sync_conf_hidden2.value = this.value;
  input_sync_conf_hidden3.value = this.value;
  input_sync_conf_hidden4.value = this.value;

}

//template_name
var input_template_name = document.getElementById("id_template_name");
var input_template_name_hidden = document.getElementById("id_template_name_hidden");
var input_template_name_hidden1 = document.getElementById("id_template_name_hidden1");
var input_template_name_hidden2 = document.getElementById("id_template_name_hidden2");
var input_template_name_hidden3 = document.getElementById("id_template_name_hidden3");
var input_template_name_hidden4 = document.getElementById("id_template_name_hidden4");

input_template_name_hidden.value = input_template_name.value;
input_template_name_hidden1.value = input_template_name.value;
input_template_name_hidden2.value = input_template_name.value;
input_template_name_hidden3.value = input_template_name.value;
input_template_name_hidden4.value = input_template_name.value;

input_template_name.oninput = function() {
  input_template_name_hidden.value = this.value;
  input_template_name_hidden1.value = this.value;
  input_template_name_hidden2.value = this.value;
  input_template_name_hidden3.value = this.value;
  input_template_name_hidden4.value = this.value;


}

//profile_name
var input_profile_name = document.getElementById("id_profile_name");
var input_profile_name_hidden = document.getElementById("id_profile_name_hidden");
var input_profile_name_hidden1 = document.getElementById("id_profile_name_hidden1");
var input_profile_name_hidden2 = document.getElementById("id_profile_name_hidden2");
var input_profile_name_hidden3 = document.getElementById("id_profile_name_hidden3");
var input_profile_name_hidden4 = document.getElementById("id_profile_name_hidden4");

input_profile_name_hidden.value = input_profile_name.value;
input_profile_name_hidden1.value = input_profile_name.value;
input_profile_name_hidden2.value = input_profile_name.value;
input_profile_name_hidden3.value = input_profile_name.value;
input_profile_name_hidden4.value = input_profile_name.value;


input_profile_name.oninput = function() {
  input_profile_name_hidden.value = this.value;
  input_profile_name_hidden1.value = this.value;
  input_profile_name_hidden2.value = this.value;
  input_profile_name_hidden3.value = this.value;
  input_profile_name_hidden4.value = this.value;


}




//proc_units
// max_proc_units
var input_max_proc_units = document.getElementById("id_max_proc_units");
var input_max_proc_units_hidden = document.getElementById("id_max_proc_units_hidden");
var input_max_proc_units_hidden1 = document.getElementById("id_max_proc_units_hidden1");
var input_max_proc_units_hidden2 = document.getElementById("id_max_proc_units_hidden2");
var input_max_proc_units_hidden3 = document.getElementById("id_max_proc_units_hidden3");
var input_max_proc_units_hidden4 = document.getElementById("id_max_proc_units_hidden4");

input_max_proc_units_hidden.value = input_max_proc_units.value;
input_max_proc_units_hidden1.value = input_max_proc_units.value;
input_max_proc_units_hidden2.value = input_max_proc_units.value;
input_max_proc_units_hidden3.value = input_max_proc_units.value;
input_max_proc_units_hidden4.value = input_max_proc_units.value;

input_max_proc_units.oninput = function() {
  input_max_proc_units_hidden.value = this.value;
  input_max_proc_units_hidden1.value = this.value;
  input_max_proc_units_hidden2.value = this.value;
  input_max_proc_units_hidden3.value = this.value;
  input_max_proc_units_hidden4.value = this.value;

}
// min_proc_units
var input_min_proc_units = document.getElementById("id_min_proc_units");
var input_min_proc_units_hidden = document.getElementById("id_min_proc_units_hidden");
var input_min_proc_units_hidden1 = document.getElementById("id_min_proc_units_hidden1");
var input_min_proc_units_hidden2 = document.getElementById("id_min_proc_units_hidden2");
var input_min_proc_units_hidden3 = document.getElementById("id_min_proc_units_hidden3");
var input_min_proc_units_hidden4 = document.getElementById("id_min_proc_units_hidden4");

input_min_proc_units_hidden.value = input_min_proc_units.value;
input_min_proc_units_hidden1.value = input_min_proc_units.value;
input_min_proc_units_hidden2.value = input_min_proc_units.value;
input_min_proc_units_hidden3.value = input_min_proc_units.value;
input_min_proc_units_hidden4.value = input_min_proc_units.value;

input_min_proc_units.oninput = function() {
  input_min_proc_units_hidden.value = this.value;
  input_min_proc_units_hidden1.value = this.value;
  input_min_proc_units_hidden2.value = this.value;
  input_min_proc_units_hidden3.value = this.value;
  input_min_proc_units_hidden4.value = this.value;

}
// desired_proc_units
var input_desired_proc_units = document.getElementById("id_desired_proc_units");
var input_desired_proc_units_hidden = document.getElementById("id_desired_proc_units_hidden");
var input_desired_proc_units_hidden1 = document.getElementById("id_desired_proc_units_hidden1");
var input_desired_proc_units_hidden2 = document.getElementById("id_desired_proc_units_hidden2");
var input_desired_proc_units_hidden3 = document.getElementById("id_desired_proc_units_hidden3");
var input_desired_proc_units_hidden4 = document.getElementById("id_desired_proc_units_hidden4");

input_desired_proc_units_hidden.value = input_desired_proc_units.value;
input_desired_proc_units_hidden1.value = input_desired_proc_units.value;
input_desired_proc_units_hidden2.value = input_desired_proc_units.value;
input_desired_proc_units_hidden3.value = input_desired_proc_units.value;
input_desired_proc_units_hidden4.value = input_desired_proc_units.value;

input_desired_proc_units.oninput = function() {
  input_desired_proc_units_hidden.value = this.value;
  input_desired_proc_units_hidden1.value = this.value;
  input_desired_proc_units_hidden2.value = this.value;
  input_desired_proc_units_hidden3.value = this.value;
  input_desired_proc_units_hidden4.value = this.value;

}
//v_proc
//max_v_proc
var input_max_v_proc = document.getElementById("id_max_v_proc");
var input_max_v_proc_hidden = document.getElementById("id_max_v_proc_hidden");
var input_max_v_proc_hidden1 = document.getElementById("id_max_v_proc_hidden1");
var input_max_v_proc_hidden2 = document.getElementById("id_max_v_proc_hidden2");
var input_max_v_proc_hidden3 = document.getElementById("id_max_v_proc_hidden3");
var input_max_v_proc_hidden4 = document.getElementById("id_max_v_proc_hidden4");

input_max_v_proc_hidden.value = input_max_v_proc.value;
input_max_v_proc_hidden1.value = input_max_v_proc.value;
input_max_v_proc_hidden2.value = input_max_v_proc.value;
input_max_v_proc_hidden3.value = input_max_v_proc.value;
input_max_v_proc_hidden4.value = input_max_v_proc.value;

input_max_v_proc.oninput = function() {
  input_max_v_proc_hidden.value = this.value;
  input_max_v_proc_hidden1.value = this.value;
  input_max_v_proc_hidden2.value = this.value;
  input_max_v_proc_hidden3.value = this.value;
  input_max_v_proc_hidden4.value = this.value;

}

//min_v_proc
var input_min_v_proc = document.getElementById("id_min_v_proc");
var input_min_v_proc_hidden = document.getElementById("id_min_v_proc_hidden");
var input_min_v_proc_hidden1 = document.getElementById("id_min_v_proc_hidden1");
var input_min_v_proc_hidden2 = document.getElementById("id_min_v_proc_hidden2");
var input_min_v_proc_hidden3 = document.getElementById("id_min_v_proc_hidden3");
var input_min_v_proc_hidden4 = document.getElementById("id_min_v_proc_hidden4");

input_min_v_proc_hidden.value = input_min_v_proc.value;
input_min_v_proc_hidden1.value = input_min_v_proc.value;
input_min_v_proc_hidden2.value = input_min_v_proc.value;
input_min_v_proc_hidden3.value = input_min_v_proc.value;
input_min_v_proc_hidden4.value = input_min_v_proc.value;

input_min_v_proc.oninput = function() {
  input_min_v_proc_hidden.value = this.value;
  input_min_v_proc_hidden1.value = this.value;
  input_min_v_proc_hidden2.value = this.value;
  input_min_v_proc_hidden3.value = this.value;
  input_min_v_proc_hidden4.value = this.value;


}


//desired_v_proc
var input_desired_v_proc = document.getElementById("id_desired_v_proc");
var input_desired_v_proc_hidden = document.getElementById("id_desired_v_proc_hidden");
var input_desired_v_proc_hidden1 = document.getElementById("id_desired_v_proc_hidden1");
var input_desired_v_proc_hidden2 = document.getElementById("id_desired_v_proc_hidden2");
var input_desired_v_proc_hidden3 = document.getElementById("id_desired_v_proc_hidden3");
var input_desired_v_proc_hidden4 = document.getElementById("id_desired_v_proc_hidden4");

input_desired_v_proc_hidden.value = input_desired_v_proc.value;
input_desired_v_proc_hidden1.value = input_desired_v_proc.value;
input_desired_v_proc_hidden2.value = input_desired_v_proc.value;
input_desired_v_proc_hidden3.value = input_desired_v_proc.value;
input_desired_v_proc_hidden4.value = input_desired_v_proc.value;

input_desired_v_proc.oninput = function() {
  input_desired_v_proc_hidden.value = this.value;
  input_desired_v_proc_hidden1.value = this.value;
  input_desired_v_proc_hidden2.value = this.value;
  input_desired_v_proc_hidden3.value = this.value;
  input_desired_v_proc_hidden4.value = this.value;


}
//////////////////////////////////////////////////////////////
///SCSI:VIOS
if((input_env.value=='VIOS')||(input_env.value=='IBM i"')){
  document.getElementById('table_vios').style.display='block';
  document.getElementById('table_aix').style.display='none';

}
else{
  document.getElementById('table_vios').style.display='none';
  document.getElementById('table_aix').style.display='block';

}
input_env.oninput= function() {
  if((input_env.value=='VIOS')||(input_env.value=='IBM i')){
  document.getElementById('table_vios').style.display='block';
  document.getElementById('table_aix').style.display='none';

}
else{
  document.getElementById('table_vios').style.display='none';
  document.getElementById('table_aix').style.display='block';

}
}
document.getElementById('id_1_client').oninput= function() {
  document.getElementById('id_partition_select').disabled=false;
  document.getElementById('id_client_adapter_id').disabled=false;  
}
document.getElementById('id_all_client').oninput= function() {
  document.getElementById('id_partition_select').disabled=true;
  document.getElementById('id_client_adapter_id').disabled=true;  
  document.getElementById("client_p_id").style.display='none';
}
document.getElementById('id_partition_select').oninput= function() {
  if(document.getElementById('id_partition_select').value=="other"){
    document.getElementById("client_p_id").style.display='block';
      }
  else
  {       document.getElementById("client_p_id").style.display='none';



  }
}



 /////////////////////////////////////////////////////////////////
//shared_proc_pool
var input_proc_pool = document.getElementById("id_proc_pool");
var input_proc_pool_hidden = document.getElementById("id_proc_pool_hidden");
var input_proc_pool_hidden1 = document.getElementById("id_proc_pool_hidden1");
var input_proc_pool_hidden2 = document.getElementById("id_proc_pool_hidden2");
var input_proc_pool_hidden3 = document.getElementById("id_proc_pool_hidden3");
var input_proc_pool_hidden4 = document.getElementById("id_proc_pool_hidden4");

input_proc_pool_hidden.value = input_proc_pool.value;
input_proc_pool_hidden1.value = input_proc_pool.value;
input_proc_pool_hidden2.value = input_proc_pool.value;
input_proc_pool_hidden3.value = input_proc_pool.value;
input_proc_pool_hidden4.value = input_proc_pool.value;


input_proc_pool.oninput = function() {
  input_proc_pool_hidden.value = this.value;
  input_proc_pool_hidden1.value = this.value;
  input_proc_pool_hidden2.value = this.value;
  input_proc_pool_hidden4.value = this.value;


}

//input_pool_hidden
var input_pool_1 = document.getElementById("id_input_pool");
var input_pool_hidden_1 = document.getElementById("id_input_pool_hidden");
var input_pool_hidden_11= document.getElementById("id_input_pool_hidden1");
var input_pool_hidden_12= document.getElementById("id_input_pool_hidden2");
var input_pool_hidden_13= document.getElementById("id_input_pool_hidden3");
var input_pool_hidden_14= document.getElementById("id_input_pool_hidden4");

 function verifier(){
        var select_var = document.getElementById("id_proc_pool");
        var input_var = document.getElementById("id_input_pool");

        if(select_var.value!="Default pool"){ 
          document.getElementById("id_input_pool").style.display="block";
          input_var.placeholder="enter a pool ...";
          input_var.value ="";

        }
        else{       
             document.getElementById("id_input_pool").style.display="none";
              input_pool_hidden_1.value="";
              input_pool_hidden_11.value="";
              input_pool_hidden_12.value="";
              input_pool_hidden_13.value="";
              input_pool_hidden_14.value="";

        }
      }
input_pool_hidden_1.value = input_pool_1.value;
input_pool_hidden_11.value = input_pool_1.value;
input_pool_hidden_12.value = input_pool_1.value;
input_pool_hidden_13.value = input_pool_1.value;
input_pool_hidden_14.value = input_pool_1.value;

input_pool_1.oninput = function() {
  input_pool_hidden_1.value = this.value;
  input_pool_hidden_11.value = this.value;
  input_pool_hidden_12.value = this.value;
  input_pool_hidden_14.value = this.value;
  input_pool_hidden_13.value = this.value;

}

//proc
//desired
var input_desired_proc = document.getElementById("id_desired_proc");
var input_desired_proc_hidden = document.getElementById("id_desired_proc_hidden");
var input_desired_proc_hidden1 = document.getElementById("id_desired_proc_hidden1");
var input_desired_proc_hidden2 = document.getElementById("id_desired_proc_hidden2");
var input_desired_proc_hidden3 = document.getElementById("id_desired_proc_hidden3");
var input_desired_proc_hidden4 = document.getElementById("id_desired_proc_hidden4");

input_desired_proc_hidden.value = input_desired_proc.value;
input_desired_proc_hidden1.value = input_desired_proc.value;
input_desired_proc_hidden2.value = input_desired_proc.value;
input_desired_proc_hidden3.value = input_desired_proc.value;
input_desired_proc_hidden4.value = input_desired_proc.value;

input_desired_proc.oninput = function() {
  input_desired_proc_hidden.value = this.value;
  input_desired_proc_hidden1.value = this.value;
  input_desired_proc_hidden2.value = this.value;
  input_desired_proc_hidden3.value = this.value;
  input_desired_proc_hidden4.value = this.value;

}
//max
var input_max_proc = document.getElementById("id_max_proc");
var input_max_proc_hidden = document.getElementById("id_max_proc_hidden");
var input_max_proc_hidden1 = document.getElementById("id_max_proc_hidden1");
var input_max_proc_hidden2 = document.getElementById("id_max_proc_hidden2");
var input_max_proc_hidden3 = document.getElementById("id_max_proc_hidden3");
var input_max_proc_hidden4 = document.getElementById("id_max_proc_hidden4");

input_max_proc_hidden.value = input_max_proc.value;
input_max_proc_hidden1.value = input_max_proc.value;
input_max_proc_hidden2.value = input_max_proc.value;
input_max_proc_hidden3.value = input_max_proc.value;
input_max_proc_hidden4.value = input_max_proc.value;

input_max_proc.oninput = function() {
  input_max_proc_hidden.value = this.value;
  input_max_proc_hidden1.value = this.value;
  input_max_proc_hidden2.value = this.value;
  input_max_proc_hidden3.value = this.value;
  input_max_proc_hidden4.value = this.value;


}
//min
var input_min_proc = document.getElementById("id_min_proc");
var input_min_proc_hidden = document.getElementById("id_min_proc_hidden");
var input_min_proc_hidden1 = document.getElementById("id_min_proc_hidden1");
var input_min_proc_hidden2 = document.getElementById("id_min_proc_hidden2");
var input_min_proc_hidden3 = document.getElementById("id_min_proc_hidden3");
var input_min_proc_hidden4 = document.getElementById("id_min_proc_hidden4");


input_min_proc_hidden.value = input_min_proc.value;
input_min_proc_hidden1.value = input_min_proc.value;
input_min_proc_hidden2.value = input_min_proc.value;
input_min_proc_hidden3.value = input_min_proc.value;
input_min_proc_hidden4.value = input_min_proc.value;


input_min_proc.oninput = function() {
  input_min_proc_hidden.value = this.value;
  input_min_proc_hidden1.value = this.value;
  input_min_proc_hidden2.value = this.value;
  input_min_proc_hidden3.value = this.value;
  input_min_proc_hidden4.value = this.value;

}

//panel:Pysical IO
  var variable_input = document.getElementById("secret_input");
  var mypanel = document.getElementById("panel1");

  if(variable_input.value>0){
    mypanel.style.display="block";
  }
  else{
    mypanel.style.display="none";

  }

//panel:Virtual adapters
  
  var variable_input_adap = document.getElementById("secret_input_all");
  var mypanel_adap = document.getElementById("panel2");

  if(variable_input_adap.value>0){
    mypanel_adap.style.display="block";
  }
  else{
    mypanel_adap.style.display="none";

  }

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("activ");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}


///Script Minimum
var slider = document.getElementById("myRange");
var output = document.getElementById("id_value");
var output_hidden = document.getElementById("id_value_hidden");
var output_hidden1 = document.getElementById("id_value_hidden1");
var output_hidden2 = document.getElementById("id_value_hidden2");
var output_hidden3 = document.getElementById("id_value_hidden3");
var output_hidden4 = document.getElementById("id_value_hidden4");

output.value = slider.value;
output_hidden.value = slider.value;
output_hidden1.value = slider.value;
output_hidden2.value = slider.value;
output_hidden3.value = slider.value;
output_hidden4.value = slider.value;


slider.oninput = function() {
  output.value = this.value;
  output_hidden.value = this.value;
  output_hidden1.value = this.value;
  output_hidden2.value = this.value;
  output_hidden3.value = this.value;
  output_hidden4.value = this.value;

}
output.oninput = function() {
  slider.value = this.value;
  output_hidden.value = slider.value;
  output_hidden1.value = slider.value;
  output_hidden2.value = slider.value;
  output_hidden3.value = slider.value;
  output_hidden4.value = slider.value;


}

var start_value = slider.getAttribute("value");

var x = start_value;
var color = 'linear-gradient(90deg, rgb(117, 252, 117)' + x + '% , rgb(214, 214, 214)' + x + '%)';
slider.style.background = color;

slider.addEventListener("mousemove", function() {
    x = slider.value;
    color = 'linear-gradient(90deg, rgb(117, 252, 117)' + x + '% , rgb(214, 214, 214)' + x + '%)';
    slider.style.background = color;
});


///Script Desired
var slider1 = document.getElementById("myRange1");
var output1 = document.getElementById("id_value1");
var output1_hidden = document.getElementById("id_value1_hidden");
var output1_hidden1 = document.getElementById("id_value1_hidden1");
var output1_hidden2 = document.getElementById("id_value1_hidden2");
var output1_hidden3 = document.getElementById("id_value1_hidden3");
var output1_hidden4 = document.getElementById("id_value1_hidden4");



output1.value = slider1.value;
output1_hidden.value = slider1.value;
output1_hidden1.value = slider1.value;
output1_hidden2.value = slider1.value;
output1_hidden3.value = slider1.value;
output1_hidden4.value = slider1.value;



slider1.oninput = function() {
  output1.value = this.value;
  output1_hidden.value = slider1.value;
  output1_hidden1.value = slider1.value;
  output1_hidden2.value = slider1.value;
  output1_hidden3.value = slider1.value;
  output1_hidden4.value = slider1.value;


}
output1.oninput = function() {
  slider1.value = this.value;
  output1_hidden.value = slider1.value;
  output1_hidden1.value = slider1.value;
  output1_hidden2.value = slider1.value;
  output1_hidden3.value = slider1.value;
  output1_hidden4.value = slider1.value;


}
var start_value1 = slider1.getAttribute("value");

var x1 = start_value;
var color1 = 'linear-gradient(90deg, rgb(117, 252, 117)' + x1 + '% , rgb(214, 214, 214)' + x1 + '%)';
slider1.style.background = color1;

slider1.addEventListener("mousemove", function() {
    x1 = slider.value;
    color1 = 'linear-gradient(90deg, rgb(117, 252, 117)' + x1 + '% , rgb(214, 214, 214)' + x1 + '%)';
    slider1.style.background = color1;
});
///Script Maximum
var slider2 = document.getElementById("myRange2");
var output2 = document.getElementById("id_value2");
var output2_hidden = document.getElementById("id_value2_hidden");
var output2_hidden1 = document.getElementById("id_value2_hidden1");
var output2_hidden2 = document.getElementById("id_value2_hidden2");
var output2_hidden3 = document.getElementById("id_value2_hidden3");
var output2_hidden4 = document.getElementById("id_value2_hidden4");



output2.value = slider2.value;
output2_hidden.value = slider2.value;
output2_hidden1.value = slider2.value;
output2_hidden2.value = slider2.value;
output2_hidden3.value = slider2.value;
output2_hidden4.value = slider2.value;



slider2.oninput = function() {
  output2.value = this.value;
  output2_hidden.value = this.value;
  output2_hidden1.value = this.value;
  output2_hidden2.value = this.value;
  output2_hidden3.value = this.value;
  output2_hidden4.value = this.value;


}
output2.oninput = function() {
  slider2.value = this.value;
  output2_hidden.value = slider2.value;
  output2_hidden1.value = slider2.value;
  output2_hidden2.value = slider2.value;
  output2_hidden3.value = slider2.value;
  output2_hidden4.value = slider2.value;

}

var start_value2 = slider2.getAttribute("value");

var x2 = start_value;
var color2 = 'linear-gradient(90deg, rgb(117, 252, 117)' + x2 + '% , rgb(214, 214, 214)' + x2 + '%)';
slider2.style.background = color1;

slider2.addEventListener("mousemove", function() {
    x2 = slider.value;
    color2= 'linear-gradient(90deg, rgb(117, 252, 117)' + x2 + '% , rgb(214, 214, 214)' + x2 + '%)';
    slider2.style.background = color2;
});


var input_radio_hidden = document.getElementById("id_radio_hidden");
var input_radio_hidden1 = document.getElementById("id_radio_hidden1");
var input_radio_hidden2 = document.getElementById("id_radio_hidden2");
var input_radio_hidden3 = document.getElementById("id_radio_hidden3");
var input_radio_hidden4 = document.getElementById("id_radio_hidden4");

var input_radio = document.getElementById("radio_shared");
var input_radio1 = document.getElementById("radio_dedicated");

///
var input_rad = document.getElementById("shared_1");

if(input_rad.value=="1"){
  document.getElementById("proc_shared").style.display = 'block';
        document.getElementById("proc_settings_shared").style.display = 'block';
        document.getElementById("table_shared").style.display = 'block';
        document.getElementById("table_dedicated").style.display = 'none';
        document.getElementById("p_dedicated").style.display = 'none';
}
else{
  document.getElementById("proc_shared").style.display = 'none';
        document.getElementById("proc_settings_shared").style.display = 'none';
        document.getElementById("table_shared").style.display = 'none';
        document.getElementById("table_dedicated").style.display = 'block';
        document.getElementById("p_dedicated").style.display = 'block';
}


input_radio_hidden.value=input_radio.value;
input_radio_hidden1.value=input_radio.value;
input_radio_hidden2.value=input_radio.value;
input_radio_hidden3.value=input_radio.value;
input_radio_hidden4.value=input_radio.value;


      function displaying_shared(){
        document.getElementById("proc_shared").style.display = 'block';
        document.getElementById("proc_settings_shared").style.display = 'block';
        document.getElementById("table_shared").style.display = 'block';
        document.getElementById("table_dedicated").style.display = 'none';
        document.getElementById("p_dedicated").style.display = 'none';
        input_radio_hidden.value="Shared";
        input_radio_hidden1.value="Shared";
        input_radio_hidden2.value="Shared";
        input_radio_hidden3.value="Shared";
        input_radio_hidden4.value="Shared";

      }
      function displaying_dedicated(){
        document.getElementById("proc_shared").style.display = 'none';
        document.getElementById("proc_settings_shared").style.display = 'none';
        document.getElementById("table_shared").style.display = 'none';
        document.getElementById("table_dedicated").style.display = 'block';
        document.getElementById("p_dedicated").style.display = 'block';
        input_radio_hidden.value='Dedicated';
        input_radio_hidden1.value='Dedicated';
        input_radio_hidden2.value='Dedicated';
        input_radio_hidden3.value='Dedicated';
        input_radio_hidden4.value='Dedicated';

      }
     
      
    function selection_type_Adapters(){
      $select=document.getElementById('id_type_select_adapters');
      if($select.value=="All"){
        document.getElementById("table_all").style.display="block";
        document.getElementById("table_ethernet").style.display="none";
        document.getElementById("table_fc").style.display="none";
        document.getElementById("table_scsi").style.display="none";

      }
      if($select.value=="Ethernet")
      {
      document.getElementById("table_all").style.display="none";
        document.getElementById("table_ethernet").style.display="block";
        document.getElementById("table_fc").style.display="none";
        document.getElementById("table_scsi").style.display="none";
      
      }
      if($select.value=="SCSI")
      {
        document.getElementById("table_all").style.display="none";
        document.getElementById("table_ethernet").style.display="none";
        document.getElementById("table_fc").style.display="none";
        document.getElementById("table_scsi").style.display="block";

      }
      if($select.value=="FC")
      {
        document.getElementById("table_all").style.display="none";
        document.getElementById("table_ethernet").style.display="none";
        document.getElementById("table_fc").style.display="block";
        document.getElementById("table_scsi").style.display="none";


      }
    }
    //VSWITCH
var input_vswitch= document.getElementById("vswitch_id");
var input_vswitch_hidden = document.getElementById("id_vs_hidden");
function fctVS(){
  if(input_vswitch.value!="Default"){
  input_vswitch_hidden.style.display='block';
}
else{
  input_vswitch_hidden.style.display='none';

}
}
   

    
</script>
<script type="text/javascript">
  /*$(document).ready(function(){
    console.log("ok");

    var table=$('#datatable').DataTable();
    table.on('click','.edit',function(){
      console.log("ok");

      $tr=$(this).closest('tr');
      if($($tr).hasClass('child')){
        $tr=$tr.prev('.parent');
      }
      var data=table.row($tr).data();
      console.log(data);
      $('#indx_slot_edit').val(data[1]);
     

      $('#EditForm').attr('action',"/PhysicalIO/"+data[0]+"/editPhy");
      $('#Modal-Edit-PhysicalIO').modal('show');

    });
});*/
</script>





<script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js')}}"></script>
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js')}}"></script>
<script src="{{asset('https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js')}}"></script>
<script src="{{asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js')}}"></script>


@endsection
