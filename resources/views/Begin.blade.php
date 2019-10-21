@extends('layout.head')
<!doctype html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0" >
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
    <div class="container">
    </div>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  Launch demo modal
</button>
<!-- Modal -->
<div class="modal fade"  id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog"  role="document">
    <div class="modal-content" style="height: 400px;">
      <div class="modal-header" >
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body" style="height: 300px; overflow: scroll;" >
      <h4>  New Client</h4>
      {!! Form::open(array('url' => '/actioncreate','method' => 'POST'))!!}
      <div class="form-group">
            {{ Form::label("Name", null, ['class' => 'control-label']) }}
      {{Form::text("Client_name", 
                    old("Client_name") ? old("Client_name") : (!empty($client) ? $client->Client_name : null), [
                    "class" => "form-group user-email", "placeholder" => "Client's name", 
                     ])}}
                       
        </div>
    <div class="form-group">
                {{ Form::label("Description", null, ['class' => 'control-label']) }}
                {{Form::textarea('Client_description', old("Client_description") ? old("Client_description") : (!empty($client) ? $client->Client_description : null), 
                         [  "class" => "form-group",  "placeholder" => "Enter some details ..."])}}
                   
        </div>
    <div class="form-group">
            {{ Form::label("Email", null, ['class' => 'control-label']) }}
            {{Form::text("Client_mail", 
                    old("Client_mail") ? old("Client_mail") : (!empty($Client) ? $client->Client_mail: null), [
                    "class" => "form-group user-email", "placeholder" => "@exemple.com", 
                     ])}}
        </div>
  <div class="form-group">
                    {{ Form::label("Adress", null, ['class' => 'control-label']) }}
                {{Form::text("Client_adresse", 
                        old("Client_adresse") ? old("Client_adresse") : (!empty($client) ? $client->Client_adresse: null), [
                        "class" => "form-group user-adress", "placeholder" => "Enter your adress", 
                         ])}}
                    
     </div>
  
  <div class="form-group">
  {{ Form::label("Server's number", null, ['class' => 'control-label']) }}
  <select name="Client_servers_nbr" class="form-control">
                            @for ($i =0; $i <=100; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor  
                         </select>
     </div>
    {!! Form::close() !!}

      </div>
      <div class="modal-footer" style="height: 50px;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
  
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
