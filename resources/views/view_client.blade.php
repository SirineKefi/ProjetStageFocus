@extends('layout.head')
@extends('layout.template')
@section('content')
<!DOCTYPE html>
<html>

<body>
<!-- Begin Page Content-->
<div class="container-fluid">

<!-- Page Heading -->
    <table>
        <tr>
          <td style="width:85%"> 
            <h1 class="h3 mb-4 text-gray-800">
              Client Details 
              <a href="{{action('ClientContoller@ViewClient', ['id' => $client->id])}}" style="font-size:15px">
              {{$client->Client_name}}></a></td>
              <td>
             
              </td>
          <td >
          {!!Form::open(['action' => ['TemplateController@Gotoadd',$client->id], 'method' => 'PUT', 'class' => 'pull-right'])!!}       

                  <button type="submit" class="btn btn-primary" style="margin-left:50x"><i class="fas fa-plus"></i> New template</button>
                
        {!! Form::close() !!}
      </td>
      <td style="width:100%">
          {!!Form::open(['action' => ['ServerController@NewServer',$client->id], 'method' => 'POST', 'class' => 'pull-right'])!!}       

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1"><i class="fas fa-plus"></i> New Server</button>
                {!! Form::close() !!}

                {!! Form::open(array('url' => '/createServer','method' => 'POST'))!!}

                <!-- Modal -->
                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><h1 class="h3 mb-4 text-gray-800">Create New Server</h1></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        
                      <table>
    <tr>
        <td>
        </td>
    </tr>
    <tr>
        <td>
            {{ Form::label("Name*", null, ['class' => 'control-label',"style"=>"width:110px"]) }}
        </td>
        <input type="text" name="id" value="{{$client->id}}" hidden>
        <td>
            {{Form::text("Server_name",
            old("Server_name") ? old("Server_name") : (!empty($server) ? $server->Server_name : null), [
            "class" => "form-control","style"=>"width:350px",   "placeholder" => "Enter Server's name", 
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
        <textarea class='form-control' style='width:350px' name='Server_description' placeholder = "Enter some details ..."></textarea>
        </td>
            </tr>
        <tr>
           
        <td> 
          <br>
            {{ Form::label("
                Type*", null, ['class' => 'control-label']) }}
         </td>
        <td>
          <br>
        <select name="Server_type"  class="form-control" style="width:350px">
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
        {{ Form::label("LPAR's prefix*", null, ['class' => 'control-label']) }}
        </td>
        <td>
        <br>   
        {{Form::text("LPAR_prefix", 
                    old("LPAR_prefix") ? old("LPAR_prefix") : (!empty($server) ? $server->LPAR_prefix: null), [
                    "class" => "form-control","style"=>"width:350px", "placeholder" => "Enter LPAR's prefix..", 
                     ])}}
            </td>
              
    </tr>
    <tr>
        <td>
           <br>
            {{ Form::label(" LPAR's number* ", null, ['class' => 'control-label']) }}
        </td>
        <td>
            <br>
            <input type='number' value="" min="1" class="form-control" name="Server_LPARs_nbr" style='width:350px'>

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
       <tr> 
           <td>
                    </td>
    <td style="text-align:center">
   
            </td>
    </tr>
        
</table>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button name="btn" type="submit" value="save" class="btn btn-success"><i class="fa fa-check"></i>Save</button>
                      </div>
                    </div>
                  </div>
                </div>      
                                {!! Form::close() !!}
                </td>
                </h1> 
                </tr>
                </table><!-- Button trigger modal -->

                <div class="row">
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
      </div>
   
<div class="row">

  <div class="col-lg-12">

    <!-- Circle Buttons -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Client's description</h6>
      </div>
      <div class="card-body">
     
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
            <table>
              <tr>
                <td style="width:300%" >
              </td>
               <td>
               <button   type="button"  data-toggle="modal" data-target="#exampleModal2" class="btn btn-info"><i class="fa fa-edit " ></i>   Edit</button>
                   
<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><h1 class="h3 mb-4 text-gray-800">Edit Client </h1>
</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
<!-- Page Heading -->

<div class="row">
  <div class="col-lg-11">

      <div class="card-body">
      

{!!Form::open(['action' => ['ClientContoller@SaveUpdateClient',$client->id], 'method' => 'POST'])!!}       

        <table>
       
            <tr>
                <td>
                
                    {{ Form::label("Name*", null, ['class' => 'control-label']) }}
                </td>  
                <td> 
                    {{Form::text("Client_name", 
                    old("Client_name") ? old("Client_name") : (!empty($client) ? $client->Client_name : null), [
                    "class" => "form-control","style"=>"width:385px", "placeholder" => "Client's name", 
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
                    <textarea class='form-control' name='Client_description' >{{$client->Client_description}}
</textarea>
                </td>
            </tr>
            <tr>         
                <td>  
                <br> 
                    {{ Form::label("Mail*", null, ['class' => 'control-label']) }}
                </td> 
                <td>  
                <br> 
                <input type="mail" class='form-control' name='Client_mail' value="{{$client->Client_mail}}">
                  
                </td> 
            </tr>
            <tr>
                <td>
                <br> 
                    {{ Form::label("Address*", null, ['class' => 'control-label']) }}
               </td> 
               <td> 
               <br> 
                    {{Form::text("Client_adresse", 
                    old("Client_adresse") ? old("Client_adresse") : (!empty($client) ? $client->Client_adresse: null), [
                    "class" => "form-control","style"=>"width:385px","placeholder" => "Enter address", 
                    ])}}
                </td>   
            </tr>  
           
            <tr>
                 
                <td>
                </td>
                <td style="text-align:center">
                   
                    </td>
                     
            </tr>
            <br>
    </table>
    

    <br>
    
 
      </div>
      </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success"><i class="fas fa-check"></i>Save</button>
      </div>
    </div>
  </div>
  
</div>


              </td>
              </tr>

          </table>

       
</div>
    </div>

    <!-- Brand Buttons -->
    

  </div>
    </div>
<div class="row">

  <div class="col-lg-6">

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Servers List</h6>
      </div>
      <div class="card-body">
      
                      <table class="table table-bordered" name="server">
                      <thead>
                          <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Type</th>
                      <th scope="col">Lpars Number</th>
                      <th scope="col">Actions</th>


                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=0;?>
                  @foreach($array as $server)
                  <?php $i++;?>
                    <tr>
                      <th scope="row">{{$i}}</th>
                      <td style="text-align:center">{{$server->Server_name}}</td>
                      <td style="text-align:center">
                        <?php
                        if($server->Server_type==null){
                          echo"---";
                        }
                        else {
                          echo $server->Server_type;
                        }
                        ?>
                        </td>
                      <td style="text-align:center">
                      <?php
                        if($server->Server_LPARs_nbr==null){
                          echo"0";
                        }
                        else {
                          echo $server->Server_LPARs_nbr;
                        }
                        ?></td>
                      
              <td>
                      <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Actions
            </button >
            <div class="dropdown-menu"  aria-labelledby="btnGroupDrop1">
           
            <a class="dropdown-item"  style="color:#3377ff;width:50%" href="{{action('ServerController@ViewServer', ['id' => $server->id])}}">
            <i class="far fa-edit"   
            ></i>Edit  </a>

            
            <a class="dropdown-item" style="color:#b30000;width:50px" href="{{action('ServerController@deleteServer', ['id' => $server->id])}}">
            <i class="fa fa-trash"   
            ></i> Delete </a>

            
              
     
    </div>
  </div>
                        </td>

                    </tr>
                    @endforeach
                  </tbody>
</table>

      </div>
    </div>

  </div>


    
  <div class="col-lg-6">

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Templates List</h6>
  </div>
  <div class="card-body">
  
                  <table class="table table-bordered" name="server">
                  <thead>
                      <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Profile Name</th>
                  <th scope="col">Actions</th>


                </tr>
              </thead>
              <tbody>
                <?php $i=0;?>
              @foreach($templates as $temp)
              <?php $i++;?>
                <tr>
                  <th scope="row">{{$i}}</th>
                  <td style="text-align:center">
                  <?php
                  if($temp->template_name==null)
                  echo '---';
                  else
                  echo $temp->template_name;
                  ?>
                  </td>
                  <td style="text-align:center">
                  <?php
                  if($temp->profil_name==null)
                  echo '---';
                  else
                  echo $temp->profil_name;
                  ?>
                    </td>
                  
                  
          <td>
                  <div class="btn-group" role="group">
        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Actions
        </button>
        <div class="dropdown-menu"  aria-labelledby="btnGroupDrop1">
       <a class="dropdown-item"  style="color:#3377ff;width:50%" href="{{action('TemplateController@ReadTemplate', ['id' => $temp->id])}}">
        <i class="far fa-edit"   
        ></i>   Edit </a>
        
        <a class="dropdown-item" style="color:#b30000;width:50px" href="{{action('TemplateController@DeleteTemplate', ['id' => $temp->id])}}">
        <i class="fa fa-trash"   
        ></i> Delete </a>

          
 
</div>
</div>

                    </td>

                </tr>
                @endforeach
              </tbody>
</table>

  </div>
</div>

</div>
</div>
    </div>

</body>
</html>
<!-- /.container-fluid -->
@endsection