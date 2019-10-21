@extends('layout.head')
@extends('layout.template')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Create New Client</h1>

<div class="row">
  <div class="col-lg-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> New Client</h6>
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
  


    {!! Form::open(array('url' => '/actioncreate','method' => 'POST'))!!}
  
    <div class="col-lg-2">

</div>
<div class="col-lg-8">

        <table>
       
            <tr>
                <td>
                
                    {{ Form::label("Name", null, ['class' => 'control-label']) }}
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
                    {{Form::textarea("Client_description", 
                     old("Client_description") ? old("Client_description") : (!empty($client) ? $client->Client_adresse: null), [
                    "class" => "form-control",'style'=>'width:385px' ,"placeholder" => "Enter Some details ..", 
                      ])}}
                </td>
            </tr>
            <tr>         
                <td>  
                <br> 
                    {{ Form::label("Mail", null, ['class' => 'control-label']) }}
                </td> 
                <td>  
                <br> 
                    {{Form::text("Client_mail", 
                    old("Client_mail") ? old("Client_mail") : (!empty($Client) ? $client->Client_mail: null), [
                    "class" => "form-control","style"=>"width:385px", "placeholder" => "@exemple.com", 
                     ])}}
                </td> 
            </tr>
            <tr>
                <td>
                <br> 
                    {{ Form::label("Address", null, ['class' => 'control-label']) }}
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
                <br> 
                    <label> Server's number   </label>
               </td> 
               <td> 
               <br> 
                   <input class="form-control" type='number' value="" name="Client_servers_nbr" style='width:385px'>
  
                </td>
            </tr>  
            <tr>
                 
                <td>
                </td>
                <td style="text-align:center">
                    <br>
                     <button type="submit" class="btn btn-secondary" ><i class="fas fa-plus"></i> Create</button>
                     <br>
                    </td>
                     <br>
            </tr>
            <br>
    </table>
    <br>
    <div class="col-lg-2">

</div>
    {!! Form::close() !!}
            </div>  
        </div>
          </div>
        </div>
      </div>
    </div>
        </div>
</div>

    @endsection