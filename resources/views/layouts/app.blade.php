<!DOCTYPE html>
<html lang=en>
<head>
<link rel="shortcut icon" type="image/x-icon" href="{{asset('public/img/'. config('app.icon'))}}"/>
<meta charset=utf-8>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=viewport content="width=device-width, initial-scale=1">
<meta http-equiv=X-UA-Compatible content="IE=edge">
<meta name=keywords itemprop=keywords content="@yield('keywords')">
<meta name=description content="@yield('description')">


<link rel="stylesheet" type="text/css" href="{{asset('css/lib/csscompressed.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
<script type="text/javascript" src="{{asset('js/compressed.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.lazy.min.js')}}"></script>

<title>@yield('title') | {{config('app.name')}}</title>
<style type="text/css">
	form.gsc-search-box{
		margin-bottom: -1px !important;
	}
	.cse .gsc-control-cse, .gsc-control-cse{
		padding: 0px !important;
	}
	table.gsc-search-box{
		margin-bottom: 0px !important;
	}
</style>
</head>
<body>

	@yield('content')
	@include('include.footer')
</body>
</html>