<!DOCTYPE html>
<html lang="en">

<head>
    <title>STI</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="{{asset('plantilla/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('plantilla/css/bootstrap-responsive.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('plantilla/css/matrix-login.css')}}"/>
    <link href="{{asset('plantilla/font-awesome/css/font-awesome.css')}}" rel="stylesheet"/>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <style>
        body, html{
            background: #fff;
        }
        input[type="checkbox"].ios8-switch {
            position: absolute;
            margin: 8px 0 0 16px;
        }
        input[type="checkbox"].ios8-switch + label {
            position: relative;
            padding: 5px 0 0 50px;
            line-height: 2.0em;
        }
        input[type="checkbox"].ios8-switch + label:before {
            content: "";
            position: absolute;
            display: block;
            left: 0;
            top: 0;
            width: 40px; /* x*5 */
            height: 24px; /* x*3 */
            border-radius: 16px; /* x*2 */
            background: #fff;
            border: 1px solid #d9d9d9;
            -webkit-transition: all 0.3s;
            transition: all 0.3s;
        }
        input[type="checkbox"].ios8-switch + label:after {
            content: "";
            position: absolute;
            display: block;
            left: 0px;
            top: 0px;
            width: 24px; /* x*3 */
            height: 24px; /* x*3 */
            border-radius: 16px; /* x*2 */
            background: #fff;
            border: 1px solid #d9d9d9;
            -webkit-transition: all 0.3s;
            transition: all 0.3s;
        }
        input[type="checkbox"].ios8-switch + label:hover:after {
            box-shadow: 0 0 5px rgba(0,0,0,0.3);
        }
        input[type="checkbox"].ios8-switch:checked + label:after {
            margin-left: 16px;
        }
        input[type="checkbox"].ios8-switch:checked + label:before {
            background: #55D069;
        }

        /* SMALL */

        input[type="checkbox"].ios8-switch-sm {
            margin: 5px 0 0 10px;
        }
        input[type="checkbox"].ios8-switch-sm + label {
            position: relative;
            padding: 0 0 0 32px;
            line-height: 1.3em;
        }
        input[type="checkbox"].ios8-switch-sm + label:before {
            width: 25px; /* x*5 */
            height: 15px; /* x*3 */
            border-radius: 10px; /* x*2 */
        }
        input[type="checkbox"].ios8-switch-sm + label:after {
            width: 15px; /* x*3 */
            height: 15px; /* x*3 */
            border-radius: 10px; /* x*2 */
        }
        input[type="checkbox"].ios8-switch-sm + label:hover:after {
            box-shadow: 0 0 3px rgba(0,0,0,0.3);
        }
        input[type="checkbox"].ios8-switch-sm:checked + label:after {
            margin-left: 10px; /* x*2 */
        }

        /* LARGE */

        input[type="checkbox"].ios8-switch-lg {
            margin: 10px 0 0 20px;
        }
        input[type="checkbox"].ios8-switch-lg + label {
            position: relative;
            padding: 7px 0 0 60px;
            line-height: 2.3em;
        }
        input[type="checkbox"].ios8-switch-lg + label:before {
            width: 50px; /* x*5 */
            height: 30px; /* x*3 */
            border-radius: 20px; /* x*2 */
        }
        input[type="checkbox"].ios8-switch-lg + label:after {
            width: 30px; /* x*3 */
            height: 30px; /* x*3 */
            border-radius: 20px; /* x*2 */
        }
        input[type="checkbox"].ios8-switch-lg + label:hover:after {
            box-shadow: 0 0 8px rgba(0,0,0,0.3);
        }
        input[type="checkbox"].ios8-switch-lg:checked + label:after {
            margin-left: 20px; /* x*2 */
        }

        #loginbox{
            padding-bottom: 10px !important;
        }
    </style>
</head>
<body>
<div id="loginbox">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="control-group normal_text"><h3>STI UAA{}</h3></div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_lg"><i class="icon-envelope-alt"> </i></span><input id="email" type="email"
                                                                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                                                               name="email"
                                                                                               placeholder="Email:"
                                                                                               value="{{ old('email') }}"
                                                                                               required autofocus>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_ly"><i class="icon-lock"></i></span><input id="password" type="password"
                                                                                      placeholder="Contraseña:"
                                                                                      class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                                                      name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
        </div>
        <div class=control-group">
            <div class="controls">
            <div class="controls">
                <div class="form-check">
                    <input class="ios8-switch ios8-switch-sm" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" style="color: #fff" for="remember">
                        {{ __('Recordar') }}
                    </label>
                </div>
            </div>
        </div>
        <div class="text-center">
            {{--<span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Lost password?</a></span>--}}
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                    </button>
                </div>
            </div>
        </div>
        </div>
    </form>
</div>
</body>

</html>

