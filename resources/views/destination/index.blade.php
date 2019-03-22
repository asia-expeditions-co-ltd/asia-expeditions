@extends('layouts.app')
@section('title')
Destination In {{$coun['country_name']}}
@endsection

@section('keywords')
{{$coun['country_name']}} Tours, {{$coun['country_name']}} Travel, DMC, Holiday, Itineraries, Golf {{$coun['country_name']}}
@endsection

@section('description')
About {{$coun['country_name']}} Tours Travel DMC Itineraries
@endsection

@section('content')
	<?php
	$countryId = isset($coun) ? $coun->id : 0;
	use App\components\Shared;
	$baseUrl = explode('/', base_path());
	?>
@include('include.menu')
@include('include.slide')
<div class="container" >
	<div class="col-md-8">
		<div class="spacing"></div>
		<b><h2 style="text-transform: uppercase;"><b>Welcome to {{$coun['country_name']}}</b></h2></b>
		<p style="text-align: justify;"> <?php echo html_entity_decode($coun['country_intro']); ?></p>
	</div>
	<div class="col-md-4" ng-app="">
		<div class="spacing"></div><div class="spacing"></div>
		<b><h4 align="center"><b>COUNTRY FACTS</b></h4></b>	
		<div class="row">
			<div class="col-md-12">
				<ul class="list-unstyled">
				@foreach(\App\Country_facts::where('facts_status', 1)->get() as $facts)
					<li class="w3-padding"><a target="_blank" href="{{url('general-information')}}?active={{ $facts->slug }}"><i class="fa fa-arrow-circle-right "></i> &nbsp;{{$facts->facts_name}}</a></li>
				@endforeach
				</ul>
			</div>
		</div>
	</div>
	<div class="clear"></div>
	<div class="spacing"></div>
	<div class="col-md-12">
		<?php
			$get_province= \App\Province::where(['country_id'=>$countryId, 'web'=>1, 'province_status'=>1])->orderBy('province_name', "ASC")->get();
		?>
		@if($get_province->count() > 0)
		<div class="title text-center"><h2 ><b>Popular Places in</b><b style="text-transform: capitalize;"> {{$coun['country_name']}}</b></h2></div>
		<div class="row">
			@if($get_province->count() > 3 )
		        <div class="row">
		            <div class="col-md-9">
		            </div>
		             <div class="col-md-3">
	                    <div class="controls pull-right " style="margin-bottom:5px;">
	                        <a class="left fa fa-chevron-left btn btn-primary" href="#carousel-example"
	                            data-slide="prev"></a>                        
	                        <a  class="right fa fa-chevron-right btn btn-primary" href="#carousel-example"
	                            data-slide="next"></a>
	                    </div>
	                </div>  
	            </div>
            @endif
            <div class="row">   
            	<div class="col-md-12">		       
			        <div id="carousel-example" class="carousel slide " data-ride="carousel">
			            <div class="carousel-inner">
			            @foreach($get_province->chunk(3) as $key => $chunkprovince)
							<div class="item  {{$key == 0 ? 'active' : ''}}"> 
					    		<div class="row">
					    		@foreach($chunkprovince as $pro)
					    		<?php
						    		
						    		$countTour = \App\Tour::where(['province_id'=> $pro->province_id, 'web'=> 1])->count();
					    		?>
									<div class="col-sm-4">
					                    <span class="thumbnail text-center">
									        <a class="img-card" href="{{route('destination', [$coun->country_slug, $pro->slug])}}" title="{{$pro['province_name']}}">
				                                <img class="lazy" data-src="{{Shared::getInstance()->urlResource($pro['province_picture'])}}" />
				                            </a>
				                            @if($countTour != 0)
				                            <div class="tour_item_wrap col-md-12"><div class="atgrid__item__angle">{{$countTour}} Destination</div></div>
				                            @endif
					                        <h3><a class="text-danger" href="{{route('destination', [$coun->country_slug, $pro->slug])}}">
					                        <p><b>{{ $pro->province_name }}</b></p></a></h3>
				                            <span>{!! str_limit(strip_tags($pro->province_intro),85) !!}</span>  
				                            <hr class="line">
				                            <div class="row">
				                                <div class="col-md-12 col-sm-12">
				                                    <a style="font-weight:100;" href="{{route('destination', [$coun->country_slug, $pro->slug])}}" class=" w3-btn w3-white w3-border w3-border-green w3-round-xlarge"> View More</a>
				                                </div>      
				                             	<div class="clear"></div>                          
				                            </div>
					                    </span>
					                </div>
					                @endforeach
					            </div>
					        </div>	
					    @endforeach		           
			            </div>
			        </div>
		        </div>
		    </div>
		</div>
		@endif 
	</div>
	<div class="clear"></div>
	<br><br>
	<div class="col-md-12">
		<?php
        	$getTour = \App\Tour::where(['country_id'=> $countryId, 'web'=> 1, 'post_type'=> 0])->orderBy('tour_name', 'ASC')->get();
        ?>
        @if($getTour->count() > 0)
        <div class="title text-center">
			<h2><b>Popular Tours in</b><b style="text-transform: capitalize;"> {{$coun->country_name}}</b></h2>
		</div>
		<div class="row">
			@if($getTour->count() > 3)
	        <div class="row">
	            <div class="col-md-9">
	            </div>
	             <div class="col-md-3">
                    <div class="controls pull-right " style="margin-bottom:5px;">
                        <a class="left fa fa-chevron-left btn btn-primary" href="#carousel-example-generic"
                            data-slide="prev"></a>
                        <a class="right fa fa-chevron-right btn btn-primary" href="#carousel-example-generic"    data-slide="next"></a>
                    </div>
                </div>  
            </div>
            @endif
            <div class="row">   
            	<div class="col-md-12">		       
			        <div id="carousel-example-generic" class="carousel slide " data-ride="carousel">
			            <div class="carousel-inner">
			            @foreach($getTour->chunk(3) as $key => $chunkTour)
							<div class="item  {{ $key == 0 ? 'active' : '' }}"> 
					    		<div class="row">
					    			@foreach($chunkTour as $tour)
										@include('include.item')
					                @endforeach
					            </div>
					        </div>	
					    @endforeach		           
			            </div>
			        </div>
		        </div>
		    </div>
		</div>
		@endif
	</div>
	</div>
</div>
@endsection