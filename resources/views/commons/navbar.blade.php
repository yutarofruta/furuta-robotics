<header>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark"> 
        <a class="navbar-brand" href="/dashboard">Robotics</a>
         
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto">
                @if(Auth::check())
                <li class="nav-item">{!! link_to_route('lessons.index', 'Lessons', [], ['class'=>'nav-link']) !!}</li>
                <li class="nav-item">{!! link_to_route('users.index', 'Ranking', [], ['class'=>'nav-link']) !!}</li>
                    @if(Auth::user()->admin == 1)
                    <li class="nav-item">{!! link_to_route('admin.admin', 'Admin', [], ['class'=>'nav-link']) !!}</li>
                    @endif
                @endif
                
            </ul>
            <ul class="navbar-nav">
                @if (Auth::check())
                    <li class="nav-item">
                        <img src="{{ asset(Auth::user()->image) }}" width="40" height="40" alt="" class="rounded-circle d-none d-md-block shadow">
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item">{!! link_to_route('users.dashboard', 'Dashboard', ['user'=>Auth::user()]) !!}</li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">{!! link_to_route('logout.get', 'Logout') !!}</li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item"><a href="" class="nav-link" data-toggle="modal" data-target="#loginModal">Login</a></li>
                @endif
            </ul>
        </div>
    </nav>
</header>

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
            <!--Form挿入-->
            {!! Form::open(['route' => 'login.post']) !!}
                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'Password') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
                
                {!! Form::submit('Log in', ['class' => 'btn btn-primary btn-block']) !!}
                
            {!! Form::close() !!}

            <p class="mt-2">New user? <a href="" class="" data-toggle="modal" data-target="#signupModal">Sign up Now!</a></p>
            </div>
        </div>
    </div>
</div>

