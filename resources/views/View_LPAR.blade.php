@extends('layout.head')
@extends('layout.template')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
</head>
<body>

        <!-- Begin Page Content -->
        <div class="container-fluid">

        <!-- Page Heading -->
    <table>
        <tr>
          <td style="width:850px"> 
            <h1 class="h3 mb-4 text-gray-800">
              LPAR Details
              <a style="font-size:15px" href="{{action('ClientContoller@ViewClient', ['id' => $client->id])}}">
              {{$client->Client_name}}></a>
              <a href="{{action('ServerController@ViewServer', ['id' => $server->id])}}" style="font-size:15px">
              {{$server->Server_name}}></a>
              <a href="{{action('LPARController@edit', ['id_c'=>$client->id,'id_s'=>$server->id,'id' => $lpar->id,])}}" style="font-size:15px">
              {{$lpar->LPAR_name}}></a></td>
          <td style="width:25%;text-align:left">
          {!!Form::open(['action' => ['LPARController@go_edit',$client->id,$server->id,$lpar->id], 'method' => 'GET', 'class' => 'pull-right'])!!}       

                  <button  type="submit" style='width:120%' class="btn btn-info"><i class="fa fa-edit " ></i>   Edit</button>
                
        {!! Form::close() !!}
</td><td style="width:120px">

{!!Form::open(['action' => ['LPARController@delete',$client->id,$server->id,$lpar->id], 'method' => 'POST', 'class' => 'pull-right'])!!}       
                <button type="submit"   class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
        {!! Form::close() !!}
</td>
</h1> 
</tr>
</table>

          <div class="row">

            <div class="col-lg-6">

               <!-- Collapsable Card Example -->
               <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample1" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample1">
                  <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample1">
                  <div class="card-body">

                  <table>
                        <tr>
                        <td >
                            <label>
                                Synch configuration  :
                            </label>
                        </td >
                        <td>
                           <?php
                           if($lpar->sync_conf==FALSE) 
                           echo '  OFF';
                           else
                           echo '  ON';
                           ?>
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <label>
                                LPAR name  :
                            </label>
                        </td>
                        <td>
                            {{$lpar->LPAR_name}}
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <label>
                                Profile name  :
                            </label>
                        </td>
                        <td>
                            {{$lpar->profil_name}}
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <label>
                                LPAR Env  :
                            </label>
                        </td>
                        <td>
                            {{$lpar->env}}
                        </td>
                        </tr>
                    </table>
                  </div>
                </div>
              </div>
              <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample2">
                  <h6 class="m-0 font-weight-bold text-primary">Processor Settings</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample2">
                  <div class="card-body">

                  <?php
                  if($lpar->shared==1){
                      echo'
                      <label >Processing units</label>
                      <table>
                      <tr>
                      <td>
                      <label>
                      Minimum processing units   :                         
                       </label>
                      </td>
                      <td>'.
                          $lpar->min_proc_units
                    .'  </td>
                      </tr>
                      <tr>
                      <td>
                      <label>
                      Desired processing units   :
                          </label>
                      </td>
                      <td>'.
                      $lpar->disired_proc_units.               
                      '</td>
                      </tr>
                      <tr>
                      <td>
                      <label>
                      Maximum processing units :
                          </label>
                      </td>
                      <td>'.
                      $lpar->max_proc_units             
                      .'</td>
                      </tr>
                  </table>
                  <br>

                  <label>Virtual Processors </label>
                  <table>
                  <tr>
                  <td>
                  <label>
                  Minimum virtual processors   :                         
                   </label>
                  </td>
                  <td>'.
                      $lpar->min_v_proc
                .'  </td>
                  </tr>
                  <tr>
                  <td>
                  <label>
                  Desired virtual processors    :
                      </label>
                  </td>
                  <td>'.
                  $lpar->disired_v_proc.               
                  '</td>
                  </tr>
                  <tr>
                  <td>
                  <label>
                  Maximum virtual processors  : 
                      </label>
                  </td>
                  <td>'.
                  $lpar->max_v_proc             
                  .'</td>
                  </tr>
              </table> 
                      <br>
                     <table>
                     <tr>
                     <td>
                      <label>  Shared processor pool :</label>
                      </td>
                      <td>'.
                      $lpar->proc_pool.'
                      </td>
                      </tr>
                      <tr>
                      ';
                      if($lpar->sharing_mode==0)
                      echo '
                     <td>
                      <label>  Sharing mode :</label>
                      </td>
                      <td>
                      Capped
                      </td>
                      </tr>
                      </table>';
                      else  
                      echo '
                      <td>
                       <label>  Sharing mode :</label>
                       </td>
                       <td>
                       Uncapped
                       </td>
                       <td>
                       </tr>
                       <tr>
                       <td>
                       <label>  Uncap weight :</label>
                       </td>
                       <td>
                       '.$lpar->uncap_weight.'
                       </td>
                       </tr>
                       </table>';
                  }
                  else{
                    echo'
                    <label >Processors</label>
                    <table>
                    <tr>
                    <td>
                    <label>
                    Minimum processors   :                         
                     </label>
                    </td>
                    <td>'.
                        $lpar->min_proc
                  .'  </td>
                    </tr>
                    <tr>
                    <td>
                    <label>
                    Desired processors   :
                        </label>
                    </td>
                    <td>'.
                    $lpar->desired_proc.               
                    '</td>
                    </tr>
                    <tr>
                    <td>
                    <label>
                    Maximum processors   :
                        </label>
                    </td>
                    <td>'.
                    $lpar->max_proc.               
                    '</td>
                    </tr>
                    </table>';


                  } ?>



                  </div>
                </div>
              </div>
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample1" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample1">
                  <h6 class="m-0 font-weight-bold text-primary">Optional Settings</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample1">
                  <div class="card-body">

                  <table>
                        <tr>
                            <td>
                            <?php 
                            if($lpar->isEnable_Connection_Monitoring ==TRUE){
                                echo '<input  style="color:red" disabled checked name="check" type="radio" id="id_check3" value="cnx_monit" > 
                               <b> Enable connection monitoring </b>
                                ';
                            }
                            else{
                                echo '<input  style="color:red" disabled  name="check" type="radio" id="id_check3" value="cnx_monit" > 
                               <b> Enable connection monitoring </b>
                                ';
                            }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <?php 
                            if($lpar->isAuto_StartWithMangedSys  ==TRUE){
                                echo '<input disabled type=radio name="check" value="auto" checked id="id_check2">
                               <b>  Automatically start with managed system </b>';
                            }
                            else{
                                echo '<input disabled type=radio name="check" value="auto" id="id_check2">
                                <b>Automatically start with managed system</b> ';
                            }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <?php 
                            if($lpar->isEnable_redundant_Error_Path_report  ==TRUE){
                                echo '<input type="radio" name="check" checked value="redund" disabled id="id_check1">
                             <b>    Enable redundant error path reporting  </b>
                                ';
                            }
                            else{
                                echo '<input type="radio" name="check" value="redund" disabled id="id_check1">
                           <b>  Enable redundant error path reporting  </b>
                                ';
                            }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <br>
                        </td>
                        </tr>
                        <tr>
                            <td>
                               <b> Boot Mode</b>
                               <br>
                        </td>
                        </tr>
                        <tr>
                            <td>
                            <br>
                               <?php
                                if($lpar->isNormal_BootMode ==TRUE)
                                {
                                   echo' <input  type="radio" name="boot_mode" id="id_boot_mode_nrml" disabled checked><b>Normal</b>';
                                }
                                else{
                                    echo' <input  type="radio" name="boot_mode" id="id_boot_mode_nrml" disabled ><b>Normal</b>';
                                }?>
                        </td>
                        </tr>
                        <tr>
                            <td>
                               
                               <?php
                                if($lpar->isSMS_BootMode  ==TRUE)
                                {
                                   echo'<input type="radio" name="boot_mode" disabled checked id="id_boot_mode_sms" value="sms">
                                   <b>System Managment Services(SMS)</b>
                                   ';
                                }
                                else{
                                    echo'<input type="radio" name="boot_mode" disabled id="id_boot_mode_sms" value="sms">
                                    <b>System Managment Services(SMS)</b>
                                    ';                                }?>
                        </td>
                        </tr>
                    </table>
                  </div>
                </div>
              </div>
</div>
<div class="col-lg-6">
               <!-- Collapsable Card Example -->
               <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample3" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample3">
                  <h6 class="m-0 font-weight-bold text-primary">Processor</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample3">
                  <div class="card-body">
                        <?php if($lpar->shared==TRUE)
                        echo '
                        <input type="radio" id="radio_shared" name="clickkk" checked disabled value="Shared">
                        <B>Shared : </B> Assign partial processor units from the shared processor pool.
                        ';
                        else{
                            echo'
                            <input type="radio" name="clickkk" id="radio_dedicated" class="radio_shared" checked  disabled value="Dedicate"><B> Dedicate :  </B>
                            Assign entire processors that can only be used by the partition';}
                        ?>
                                        
                             </div>
                </div>
              </div>
              <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample5" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample5">
                  <h6 class="m-0 font-weight-bold text-primary">Memory Settings</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample5">
                  <div class="card-body">
                      
                    <table>
                        <tr>
                         <td>
                             <label>
                         Minimum memory:
                        </label>
                        </td>
                        <td>
                            {{$lpar->min_memory}}
                        </td>
                        </tr>
                        <tr>
                        <td>
                            <label>
                        Desired memory:
                        </label>
                        </td>
                        <td>
                             {{$lpar->disired_memory}}
                        </td>
                        </tr>
                        <tr>
                        <td>
                            <label>
                        Maximum memory:
                        </label>
                        </td>
                        <td>
                            {{$lpar->max_memory}}
                        </td>
                        </tr>
                        </table>

                             </div>
                </div>
              </div>
              <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample6" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample6">
                  <h6 class="m-0 font-weight-bold text-primary">Virtual adapters</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample6">
                  <div class="card-body">
                 












                  <table >
           <tr>
           
           <td style="width:40%">
           
           <label>   Maximum virtual adapters:</label>
           </td>
           <td style="width:10%">
            <input type="number"  value="{{$lpar->max_v_adapters}}" disabled name="max_v_adapters" id="id_max_v_adapters"  class="form-control form-control-sm" > 
           </td>
           <td style="width:5%">
                        </td>
           <td style="width:15%">
           <label>Filter By :</label>
           </td>
           <td style="width:40%" >
            <select onclick="selection_type_Adapters()" name="type_select_adapters" id="id_type_select_adapters"  class="form-control form-control-sm" > 
                  <option value="All">
                  All
                  </option>
                  <option value="Ethernet">
                  Virtual Ethernet 
                  </option>
                  <option value="SCSI">
                 Virtual SCSI 
                  </option>
                  <option value="FC">
                  Virtual FC 
                  </option>
            </select>
           </td>
           </tr>
           </table>
           <br>
           <div id="table_all">
           <table class="table table-bordered">          <thead>
            <tr>
              <th  scope="col" style="text-align:center">#</th>
              <th scope="col" style="text-align:center">Type</th>
              <th scope="col" style="text-align:center">Identifiant</th>
              <th scope="col" style="text-align:center">Required</th>
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
            </tr>
            @endforeach
            @endif
            <input id="secret_input_all" name="secret_input_all1" value="{{$i}}" hidden>
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
            </tr>
            @endforeach
            <input id="secret_input_all" name="secret_input_all1" value="{{$j}}" hidden >

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
            </tr>
            @endforeach
         </tbody>
        </table>
</div>















                     </div>
                </div>
              </div>
              <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample4" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample4">
                  <h6 class="m-0 font-weight-bold text-primary">Physical I/O</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample4">
                  <div class="card-body">
                  <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Index Slot</th>
                            <th scope="col">Type</th>
                            <th scope="col">Required/Desired</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0;?>
                            @foreach($array as $phy)
                            <?php $i++;?>
                            <tr>
                            <th scope="row">{{$i}}</th>
                            <td>{{$phy->index_slot}}</td>
                            <td>{{$phy->type}}</td>
                            <td><?php
                            if($phy->isrequired==TRUE){
                                echo 'Required';
                            }
                            else{
                                echo'Desired';
                            }
                             ?></td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>            
                     </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

</body>
<script>
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
    </script>



</html>
@endsection