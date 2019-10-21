@extends('layout.head')
@extends('layout.template')
@section('content')
<!DOCTYPE html>
<html>
<head></head>
<body>
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Edit Client </h1>

<div class="row">
  <div class="col-lg-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> Client's Details</h6>
      </div>
      <div class="card-body">
      
    <div class="col-lg-3">

</div>
<div class="col-lg-8">
{!!Form::open(['action' => ['ClientContoller@SaveUpdateClient',$client->id], 'method' => 'POST'])!!}       

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
                    <textarea class='form-control' name='Client_description' >{{$client->Client_description}}
</textarea>
                </td>
            </tr>
            <tr>         
                <td>  
                <br> 
                    {{ Form::label("Mail", null, ['class' => 'control-label']) }}
                </td> 
                <td>  
                <br> 
                <input type="mail" class='form-control' name='Client_mail' value="{{$client->Client_mail}}">
                  
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
                </td>
                <td style="text-align:center">
                    <br>

                     <button type="submit" class="btn btn-success" ><i class="fas fa-check"></i> Save</button>
                     <br>
                    </td>
                     <br>
            </tr>
            <br>
    </table>
    {!!Form::close()!!}

    <br>
    <div class="col-lg-2">

</div>
      
</div>   </div>
      </div>
      </div>
      </div>
      </div>
</body>
</html>
@endsection