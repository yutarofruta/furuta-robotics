<!--Login Modal-->
<div class="modal fade text-dark" id="loginModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Login</div>
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
            
            {!! Form::open(['route' => 'login.post']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'Password') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
                
                {!! Form::submit('Log in', ['class' => 'btn btn-primary btn-block']) !!}
                
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
