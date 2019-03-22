@extends('layouts.app')
@section('title')
CheckOut Page
@endsection
<?php

use App\components\Shared;
?>

@section('content')
@include("include.menu")
<div class="spacing"></div>
<div class="container ">
    <div class="row ">
        @if (session('message'))			
        <div class="col-md-12">
            <div class="alert alert-danger no-bg" >
                <strong><i class="fa fa-check"></i>
                    {{session('message')}}
                </strong>
            </div>
        </div>			
        @endif	
        @if (session('loginError'))			
        <div class="col-md-12">
            <div class="alert alert-danger no-bg" >
                <strong><i class="fa fa-check"></i>
                    {{session('loginError')}}
                </strong>
            </div>
        </div>			
        @endif	
        <div class="col-md-12">
            @if (count($errors) > 0)
            <div class="alert alert-danger alert-success" style="background-color: none; ">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>	
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-md-push-8 col-sm-push-8">
            <form  method="post" action="{{route('check.login')}}">
                {{ csrf_field() }}
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" 
                           href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            LOGIN 
                        </a> &nbsp; <small style="font-style: italic;">you have account yet ?</small>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group {{$errors->first('email') ? 'has-error' : ''}}">
                                <div class="col-md-12 "><strong class="control-label" for="inputError">Email*</strong></div>
                                <div class="col-md-12">
                                    <input type="email" class="form-control" name="email_log" value="{{ old('email_log') }}">
                                </div>
                            </div>
                            <div class="form-group {{$errors->first('password_log') ? 'has-error' : ''}}">
                                <div class="col-md-12 w3-margin-top"><strong class="control-label" for="inputError">Password*</strong></div>
                                <div class="col-md-12">
                                    <input type="password" class="form-control" name="password_log" >
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 w3-margin-top">
                                    <button type="submit" class="w3-btn w3-blue btn-submit-fix">Login </button>
                                    &nbsp;&nbsp;&nbsp;<a href="/forgot_password">Forgot password ?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-md-pull-4 col-sm-pull-4">
            <!--SHIPPING METHOD-->
            <form class="form-horizontal" method="post" action="{{route('check.account')}}">
                {{ csrf_field() }}
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" 
                           href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            REGISTER
                        </a>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4 col-xs-12 ">
                                    <div class="form-group {{$errors->first('first_name') ? 'has-error' : ''}} ">
                                        <div class="col-md-12 col-xs-12">
                                            <strong class="control-label" for="first_name">First Name*</strong>
                                            <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-12 ">
                                    <div class="form-group ">
                                        <div class="col-md-12 col-xs-12 ">
                                            <strong  class="control-label" for="middle_name">Middle Name</strong>
                                            <input type="type" name="middle_name" class="form-control" value="{{ old('middle_name') }}" />
                                        </div>
                                    </div>
                                </div>	 
                                <div class="col-md-4 col-xs-12 ">
                                    <div class="form-group {{$errors->first('last_name') ? 'has-error' : ''}}">
                                        <div class="col-md-12 col-xs-12 ">
                                            <strong class="control-label" for="last_name">Last Name</strong>
                                            <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{$errors->first('nation') ? 'has-error' : ''}}">
                                <div class="col-md-12"><strong class="control-label" for="nation">Nationality*</strong></div>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="nation" value="{{ old('nation') }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-xs-12 ">
                                    <div class="form-group {{$errors->first('passport_number') ? 'has-error' : ''}}">
                                        <div class="col-md-12 col-xs-12 ">
                                            <strong class="control-label" for="inputError">Passport Number*</strong>
                                            <input onkeyup="checkInp()" type="type" name="passport_number" class="form-control" value="{{ old('passport_number') }}" />
                                        </div>
                                    </div>
                                </div>	 
                                <div class="col-md-6 col-xs-12 ">
                                    <div class="form-group {{$errors->first('expiry_date') ? 'has-error' : ''}}">
                                        <div class="col-md-12 col-xs-12 ">
                                            <strong class="control-label" for="inputError">Expiry Date*</strong>
                                            <input type="text" name="expiry_date" class="form-control" value="{{ old('expiry_date') }}" id="expiry_date"/>
                                        </div>
                                    </div>
                                </div>
                            </div>	
                            <div class="form-group {{$errors->first('address_street') ? 'has-error' : ''}}">
                                <div class="col-md-12"><strong class="control-label" for="inputError">Address Street*</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="address_street" class="form-control" value="{{ old('address_street') }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-xs-12 ">
                                    <div class="form-group {{$errors->first('town_city') ? 'has-error' : ''}}">
                                        <div class="col-md-12 col-xs-12 ">
                                            <strong class="control-label" for="inputError">Town / City*</strong>
                                            <input type="text" name="town_city" class="form-control" value="{{ old('town_city') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12 ">
                                    <div class="form-group {{$errors->first('country_state') ? 'has-error':''}}">
                                        <div class="col-md-12 col-xs-12 ">
                                            <strong class="control-label" for="inputError">Country / State*</strong>
                                      
                                            <select class="form-control" name="country_state"> 
                                                @foreach(\App\Country::all() as $state)
                                                <option value="{{$state['country_name']}}">{{ $state['country_name'] }}</option>
                                                @endforeach 
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong > Zip / Postal Code</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="zip_code" class="form-control" value="{{ old('zip_code') }}" />
                                </div>
                            </div>
                            <div class="form-group {{$errors->first('phone_number') ? 'has-error' : ''}}">
                                <div class="col-md-12"><strong class="control-label" for="inputError">Phone Number*</strong></div>
                                <div class="col-md-12"><input type="text" name="phone_number" class="form-control" value="{{ old('phone_number') }}" /></div>
                            </div>
                            <div class="form-group {{$errors->first('email') ? 'has-error' : ''}} {{ session('message') ? 'has-error' : ''}}">
                                <div class="col-md-12"><strong class="control-label" for="inputError">Email Address*</strong></div>
                                <div class="col-md-12"><input type="email" name="email" class="form-control" value="{{ old('email') }}"/></div>
                            </div>
                            <div class="form-group {{$errors->first('password') ? 'has-error' : ''}}">
                                <div class="col-md-12"><strong class="control-label" for="inputError">Password*</strong></div>
                                <div class="col-md-12"><input type="password" name="password" class="form-control" value="{{ old('password') }}" /></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <button type="submit" class="w3-btn w3-blue btn-submit-fix">Continue </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>	   
            </form>
        </div>
    </div>        
</div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script>
                                                                        $(document).ready(function () {
                                                                            var nowTemp = new Date();
                                                                            var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
                                                                            var to = $('#expiry_date').datepicker({
                                                                                onRender: function (date) {
                                                                                    return date.valueOf() <= now.date.valueOf() ? 'disabled' : '';
                                                                                }
                                                                            }).on('changeDate', function (ev) {
                                                                                to.hide();
                                                                            }).data('datepicker');
                                                                        });
</script>
<script type="text/javascript">
    function checkInp()
    {
        var x = $(this).value;
        if (isNaN(x))
        {
            return false;
        }
    }
</script>
@endsection
