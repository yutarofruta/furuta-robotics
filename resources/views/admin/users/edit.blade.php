@extends('layouts.app')

@section('content')

{{ link_to_route('admin.users.show', 'Back', ['id'=>$user->id], ['class'=>'btn btn-success mb-5']) }}

<div class="text-center">
    <h1>Update User : {{$user->name}}</h1>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        
        <ul class="nav nav-tabs nav-justified">
          <li class="nav-item">
            <a href="#tab1" class="nav-link {{ $errors->has('password') ? '' : 'active' }}" data-toggle="tab">Info</a>
          </li>
          <li class="nav-item">
            <a href="#tab2" class="nav-link {{ $errors->has('password') ? 'active' : '' }}" data-toggle="tab">Password</a>
          </li>
        </ul>
        
        <!--タブのコンテンツ部分-->
        <div class="tab-content">
            <div id="tab1" class="tab-pane {{ $errors->has('password') ? '' : 'active' }}">
                {!! Form::model($user, ['route' => ['admin.users.update', 'id'=>$user->id], 'method'=>'PUT', 'files'=>true]) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
                    </div>
    
                    <div class="form-group">
                        {!! Form::label('email', 'Email') !!}
                        {!! Form::email('email', $user->email, ['class' => 'form-control']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('admin', 'Role') !!} <br>
                        {!! Form::radio('admin', 0, $user->admin == 0) !!} General User <br>
                        {!! Form::radio('admin', 1, $user->admin == 1) !!} Administrator
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('image', 'Image') !!} <br>
                        {!! Form::file('image', null) !!}
                    </div>
    
                    {!! Form::submit('Update this User', ['class' => 'btn btn-primary btn-block']) !!}
                {!! Form::close() !!}
            </div>
            
            
            <div id="tab2" class="tab-pane {{ $errors->has('password') ? 'active' : '' }}">
                {!! Form::model($user, ['route' => ['admin.password.update', 'id'=>$user->id], 'method'=>'PUT', 'files'=>true]) !!}
                    
                    <div class="form-group">
                        {!! Form::label('password', 'Password') !!}
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
    
                    <div class="form-group">
                        {!! Form::label('password_confirmation', 'Confirmation') !!}
                        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                    </div>
    
                    {!! Form::submit('Update this User', ['class' => 'btn btn-primary btn-block']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

