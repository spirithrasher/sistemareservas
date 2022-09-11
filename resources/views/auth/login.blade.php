@extends('layouts.master-without_nav')

@section('title') Login @endsection

@section('content')

<body class="account-body accountbg">


<div class="container">
    <div class="row vh-100 d-flex justify-content-center">
        <div class="col-12 align-self-center">
            <div class="row">
                <div class="col-lg-5 mx-auto">
                    <div class="card">
                        <div class="card-body p-0 auth-header-box">
                            <div class="text-center p-3">
                                <h4 class="mt-3 mb-1 fw-semibold text-white font-18">Sistema de Reservas</h4>
                                <p class="text-muted  mb-0">Demo</p>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <!-- Tab panes -->
                            <div class="tab-content mt-1">
                                <div class="tab-pane active  p-3" id="LogIn_Tab" role="tabpanel">

                                    @if(Session::has('success'))
                                        <div class="alert alert-success text-center">
                                            {{Session::get('success')}}
                                        </div>
                                    @endif
                                    <form class="form-horizontal auth-form" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="username">Username</label>
                                            <div class="input-group">
                                                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', 'admin@mannatthemes.com') }}" id="username" placeholder="Enter Email" autocomplete="email" autofocus>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group mb-2">
                                            <label class="form-label" for="userpassword">Password</label>
                                            <div class="input-group">
                                                <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" id="userpassword" value="123456" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end form-group-->

                                        <div class="form-group mb-0 row">
                                            <div class="col-12">
                                                <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log In <i class="fas fa-sign-in-alt ms-1"></i></button>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end form-group-->
                                    </form>
                                    <!--end form-->
                                </div>
                            </div>
                        </div>

                        <div class="card-body bg-light-alt text-center">
                            <span class="text-muted d-none d-sm-inline-block">Aplicación Desarrollada por Javier Contreras. © <script>
                                    document.write(new Date().getFullYear())
                                </script>
                                <br/> Contacto: javiercontrerav@gmail.com
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection