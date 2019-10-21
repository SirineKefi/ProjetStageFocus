@extends('layout.head')
@extends('layout.template')
@section('content')
<div class="container-fluid">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                      <label style="font-size:15px;width:150%;text-align:center">Clients number</label></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <label style="font-size:30px;width:150%;text-align:center">    
                      {{$nb_client}}
                        </label>
                    </div>
                    </div>
                    <div class="col-auto">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                      <label style="font-size:15px;width:150%;text-align:center">Servers number</label></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <label style="font-size:30px;width:150%;text-align:center">    
                      {{$nb_server}}
                        </label>
                      </div>
                    </div>
                    <div class="col-auto">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                      <label style="font-size:15px;width:150%;text-align:center">Lpars number</label>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <label style="font-size:30px;width:150%;text-align:center">    
                      {{$nb_lpar}}
                        </label>
                      </div>
                    </div>
                    <div class="col-auto">
                    </div>
                  </div>
                </div>
                  </div>
                </div>
                <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                      <label style="font-size:15px;width:150%;text-align:center">Templates number</label>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <label style="font-size:30px;width:150%;text-align:center">    
                      {{$nb_template}}
                        </label>
                      </div>
                    </div>
                    <div class="col-auto">
                    </div>
                  </div>
                </div>
              </div>
            </div>
              </div>
              <br><br>
<div class="row">
              <button type="button"  data-toggle="modal" data-target="#exampleModal" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" style="margin-left:45%" ><i class="fas fa-plus"></i> New Client</button>


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
        <td >
          
            {{ Form::label("Name*", null, ['class' => 'control-label',"style"=>"font-size:18px"]) }}
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
            {{ Form::label("Mail*", null, ['class' => 'control-label',"style"=>"font-size:18px"]) }}</td> 
        <td>  
        <br> 
            {{Form::text("Client_mail", 
            old("Client_mail") ? old("Client_mail") : (!empty($Client) ? $client->Client_mail: null), [
            "class" => "form-control","style"=>"width:300px", "placeholder" => "mail@exemple.com", 
             ])}}
        </td> 
    </tr>
    <tr>
        <td>
        <br> 
            {{ Form::label("Address*", null, ['class' => 'control-label',"style"=>"font-size:18px;width:150px"]) }}
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
        {{ Form::label("Servers number*", null, ['class' => 'control-label',"style"=>"font-size:18px;width:150px"]) }}
   
       </td> 
       <td> 
       <br> 
           <input class="form-control" type='number' min="1" value="" name="Client_servers_nbr" style='width:300px' placeholder='0'>

        </td>
        <td>
        
    </tr>  
    <tr>
         
        <td>
        <br>
        {{ Form::label("Servers type*", null, ['class' => 'control-label',"style"=>"font-size:18px;width:150px"]) }}
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
</div>
<div class="card-body">
      @if($errors->count()>0)
    <br>
    <div class="row ">
        <div class="col-md-8 col-md-offset-2">
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

@endif
</div>


            </div>
          

     
@endsection