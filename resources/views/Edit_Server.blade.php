@extends('layout.head')
@extends('layout.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Edit Server </h1>

<div class="row">
  <div class="col-lg-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">  Edit Server : {{$server->Server_name}}</h6>
      </div>
      <div class="card-body">
      {!!Form::open(['action' => ['ServerController@saveUpdate',$server->id], 'method' => 'POST'])!!}       

<div class="col-lg-2">
</div>
<div class="col-lg-8">
<table>
    <tr>
        <td>
        <input type="hidden" value="{{$server->id}}" name="id">
        </td>
    </tr>
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
            {{ Form::label("Description", null, ['class' => 'control-label']) }}
        </td>
        <td>
            <br>
            {{Form::textarea('Server_description', old("Server_description") ? old("Server_description") : (!empty($server) ? $server->Server_description : null), 
                         [  "class" => "form-control","style"=>"width:385px",  "placeholder" => "Enter some details ..."])}}
        </td>
            </tr>
        <tr>
           
        <td> 
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
    <tr>
        <td>
           
            {{ Form::label(" LPAR's number ", null, ['class' => 'control-label']) }}
        </td>
        <td>
            <br>
            <input class="form-control" type='number' value="" name="Server_LPARs_nbr" style='width:385px'>

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
                @foreach($array as $template)
                    <option value="{{ $template->id }}">{{ $template->template_name }}</option>
                @endforeach  
         </select>
                 
        </td>
    </tr>
       <tr> 
           <td>
                    </td>
    <td style="text-align:center">
   <br>
   <button name="btn" type="submit" value="save" class="btn btn-success"><i class="fa fa-check"></i>Save</button>
   
    <br>
            </td>
    </tr>
        
</table>
<div class="col-lg-2">
</div>
                    </div>
{!! Form::close() !!}
 
       
        

       
      </div>
    </div>

  </div>

</div>

</div>


    
    @endsection
