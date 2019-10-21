@extends('layout.head')
@extends('layout.template')
@section('content')
<!DOCTYPE html>
<html>
<head></head>
<body>
<div class="container-fluid">

<!-- Page Heading -->

<h1 class="h3 mb-4 text-gray-800">
<table>
<tr>
  <td style="width:700%" >Client List </td>
  <td >
  
</td><td>

<button type="button"  data-toggle="modal" data-target="#exampleModal" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"  ><i class="fas fa-plus"></i> New Client</button>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><h1 class="h3 mb-4 text-gray-800">Create Client </h1>
</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
   

<!-- Page Heading -->
{!! Form::open(array('url' => '/actioncreate','method' => 'POST'))!!}

<div class="row">
  <div class="col-lg-11">

      <div class="card-body">
      

<table>
    <tr>
        <td>
          
            {{ Form::label("Name", null, ['class' => 'control-label',"style"=>"font-size:18px"]) }}
        </td>  
        <td> 
            {{Form::text("Client_name", 
            old("Client_name") ? old("Client_name") : (!empty($client) ? $client->Client_name : null), [
            "class" => "form-control","style"=>"width:300px", "placeholder" => "Client's name", 
             ])}}
        </td>  
    </tr>  
    <tr>
        <td>
            <br>
            {{ Form::label("Description", null, ['class' => 'control-label',"style"=>"font-size:18px"]) }}
        </td> 
        <td> 
            <br> 
            <textarea class='form-control' style='width:300px' name='Client_description' placeholder="Enter Some details .." >
</textarea>
           
        </td>
    </tr>
    <tr>         
        <td>  
        <br> 
            {{ Form::label("Mail", null, ['class' => 'control-label',"style"=>"font-size:18px"]) }}
        </td> 
        <td>  
        <br> 
            {{Form::text("Client_mail", 
            old("Client_mail") ? old("Client_mail") : (!empty($Client) ? $client->Client_mail: null), [
            "class" => "form-control","style"=>"width:300px", "placeholder" => "@exemple.com", 
             ])}}
        </td> 
    </tr>
    <tr>
        <td>
        <br> 
            {{ Form::label("Address", null, ['class' => 'control-label',"style"=>"font-size:18px;width:150px"]) }}
       </td> 
       <td> 
       <br> 
            {{Form::text("Client_adresse", 
            old("Client_adresse") ? old("Client_adresse") : (!empty($client) ? $client->Client_adresse: null), [
            "class" => "form-control","style"=>"width:300px","placeholder" => "Enter address", 
            ])}}
        </td>   
    </tr>  
    <tr>
        <td >   
        <br> 
        {{ Form::label("Server's number", null, ['class' => 'control-label',"style"=>"font-size:18px;width:150px"]) }}
   
       </td> 
       <td> 
       <br> 
           <input class="form-control" type='number' value="" name="Client_servers_nbr" style='width:300px' placeholder='0'>

        </td>
        <td>
        
    </tr>  
    <tr>
         
        <td>
        <br>
        {{ Form::label("Server's number", null, ['class' => 'control-label',"style"=>"font-size:18px;width:150px"]) }}

        </td>
        <td >
        <br>
        <select name="Server_type"  class="form-control" style="width:300px">
                <option name="Server_type" value="POWER 5">POWER 5</option>
                <option name="Server_type" value="POWER 6">POWER 6</option>
                <option name="Server_type" value="POWER 7">POWER 7</option>
                <option name="Server_type" value="POWER 8">POWER 8</option>
                <option name="Server_type" value="POWER 9">POWER 9</option>
        </select>
            </td>
             <br>
    </tr>

</table>


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
  {!! Form::close() !!}
</div>






</td>
</tr>
</table>
</h1>
    
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
      </div>
    </div>
    


<div class="row">
  <div class="col-lg-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> All Clients</h6>
      </div>
      <div class="card-body">
                <table style="text-align:center" class="table table-bordered">
            <thead style="text-align:center">
                <tr>
                <th scope="col" style="text-align:center">#</th>
                <th style="text-align:center" scope="col">Name</th>
                <th  style="text-align:center" scope="col">Address</th>
                <th style="text-align:center" scope="col">Email</th>
                <th style="text-align:center" scope="col">Actions</th>

                </tr>
            </thead>
            <tbody><?php $i=0;?>
            @foreach($array as $client)
            <?php $i++;?>
                <tr>
                <th style="text-align:center" scope="row">{{$i}}</th>
                <td>{{$client->Client_name}}</td>
                <td>{{$client->Client_adresse}}</td>
                <td>{{$client->Client_mail}}</td>
                <td>
                <div class="dropdown show">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Actions
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" style="color:#3377ff;font-size=10%" href="{{action('ClientContoller@GoToEditClient', ['id' => $client->id])}}"><label style="font-size:150%">Edit</label></a>
                    <a class="dropdown-item" style="color:#b30000" href="{{action('ClientContoller@DeleteClient', ['id' => $client->id])}}"><label style="font-size:150%">Delete</label></a>
                  </div>
                </div>
                </td>

                </tr>
              @endforeach
            </tbody>
            </table>
           {{ $array->links()}}
      </div>
      </div>
      </div>
      </div>
    </div>
     
</body>
</html>
@endsection

