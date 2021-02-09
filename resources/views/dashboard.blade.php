<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from templates.stillidea.net/delight/dark-sidemenu.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 07 Sep 2020 07:54:35 GMT -->

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<title>Admin Template - Delight</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="" />
	<meta name="keywords" content="" />

	<!-- Styles -->
	<link rel="stylesheet" type="text/css" href="{{asset('admin/css/materialize.min.css')}}" />
	<link rel="stylesheet" href="{{asset('admin/css/icons.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('admin/css/style.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('admin/css/responsive.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('admin/css/color.css')}}" />
	<link href="{{asset('toastr/toastr.min.css')}}" rel="stylesheet" text="text/css" />

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.css">



	@yield('style')
</head>

<body>
	<div class="loader-container circle-pulse-multiple">
		<div class="page-loader">
			<div id="loading-center-absolute">
				<div class="object" id="object_four"></div>
				<div class="object" id="object_three"></div>
				<div class="object" id="object_two"></div>
				<div class="object" id="object_one"></div>
			</div>
		</div>
	</div>

	<div class="topbar">
		<div class="logo"><a href="#" title="">DELIGHT</a></div><!-- Logo -->
		<a class="sidemenu-btn waves-effect waves-light" href="#" title=""><i class="ti-menu"></i></a>
		<!-- Sidemenu Button -->
		<div class="topbar-links">

			<div class="launcher">
				<a class="click-btn" href="#" title=""><i class="ti-widget"></i></a>
				<div class="launcher-dropdown z-depth-2">
					<a href="profile.html" title="" class="launch-btn"><i class="ti-user green-text"></i> <span>View
							Profile</span></a>
					<a href="" title="" class="launch-btn"><i class="ti-lock orange-text"></i>
						<span>Sign
							Out</span></a>
				</div>
			</div>
		</div><!-- Launcher -->
	</div><!-- Topbar Links -->
	</div><!-- Top Bar -->

	<div class="sidemenu dark">
		<div class="sidemenu-inner scroll">
			<div class="admin">
				<img src="{{asset('admin/images/admin.jpg')}}" alt="" />
				<div class="admin-detail">
					<h2>user</h2>
					<a class="dropdown-button" href='#' title="" data-activates='dropdown2'><span class="green"></span>
						Online <i class="ti-angle-down"></i></a>
					<ul id='dropdown2' class='dropdown-content'>
						<li><a href="#!" onclick="hitAlert()">Offline</a></li>
						<li><a href="#!">Busy</a></li>
						<li><a href="#!">Away</a></li>
						<li class="divider"></li>
						<li><a href="login.html">Signout</a></li>
					</ul>
				</div>
			</div><!-- Admin -->

			<nav class="admin-nav">
				<h6>Main</h6>
				<ul>
					<li><a class="waves-effect" href="{{url('/')}}" title=""><i class="ti-home red lighten-1"></i>
							Dashboard</a>

					</li>
					<li><a class="waves-effect" href="#" title=""><i class="ti-widgetized pink lighten-3"></i>
							Category</a>
					</li>
				</ul>
			</nav>
		</div>
	</div><!-- Sidemenu -->


	<div class="content-area">
		<div class="breadcrumb-bar">
			<div class="page-title">

				@if (App\Models\Breathe::checkStatus())
				<h1> <button data-toggle="modal" data-target="add_modal"
						class="btn waves-effect waves-light blue edit-btn">Add</button></h1>
				@else

				<a data-toggle="modal" data-target="stop" id="display" class="btn blue text-bold">00:00:00</a>

				@endif



			</div>
		</div><!-- Breadcrumb Bar -->

		@yield('content')


		<div class="widgets-wrapper">
			<div class="streaming-table">
				<span id="found" class="label label-info"></span>
				<table id="stream_table" class='table table-striped table-bordered'>
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Time</th>

						</tr>
					</thead>
					<tbody>

						@foreach (App\Models\Breathe::all() as $key => $record)
						<tr>
							<td>{{$key+1}}</td>
							<td>{{$record->name}}</td>
							@if ($record->status ==0)
							<td>----</td>
							@else
							<td>{{$record->hour}}:{{$record->min}}:{{$record->sec}}</td>
							@endif


						</tr>
						@endforeach

					</tbody>
				</table>

				<div>
				</div>
			</div>
		</div>
		<div id="add_modal" class="modal">
			<div class="modal-content">

				<form method="POST" action="{{route('breathe.store')}}">
					@csrf

					<h2 class="mb-3">Update Cart</h2>

					<div class="mt-4 row">
						<div class="input-field col s9">
							<input id="name" name="name" type="text">
							<label class="active" for="">person name</label>
						</div>
					</div>

					<input name="status" value="0" hidden>
			</div>
			<button type="submit" class="btn btn-primary" id="start">start Time</button>
			</form>
		</div>
		<div id="stop" class="modal">
			<div class="modal-content ">

				<div>
					<button class="btn green" id="mstartStop" onclick="startStop()">Stop</button>



					<a href="{{route('end')}}" type="button" class="btn red" id="start">End</a>
				</div>



			</div>

			</form>
		</div>

	</div><!-- Content Area -->



	<script>
		let min = {{$min}};
		let hour = {{$hour}};
		let sec = {{$sec}};



		let displayMin = 0;
		let displayHour = 0;
		let displaySec = 0;


		let interval = null;
		let status ="started";


	function stopwatch(){

		sec++;
		if (sec/60 ==1){
			sec =0;
			min++;

			if(min/60 ==1){
				min = 0;
				hour++;

			}
		}


	if(sec<10){
		displaySec = "0" + sec.toString();
	}
	else{
		displaySec = sec;
	}
	
	
	if(min<10){
		displayMin = "0" + min.toString();
	}
	else{
		displayMin = min;
	}
	
	if(hour<10){
		displayHour = "0" + hour.toString();
	}
	else{
		displayHour = hour;
	}

	document.getElementById("display").innerHTML = displayHour + ":" + displayMin + ":" + displaySec;

}

		function startStop(){
		
			if(status == "started")
			{
				window.clearInterval(interval);
				document.getElementById("mstartStop").innerHTML = "start";
				status = "stopped";
				stopAjax();

			}
		
			else
			{
				interval = window.setInterval(stopwatch,1000);
				document.getElementById("mstartStop").innerHTML = "stop";
				status = "started";
				startAjax();
			}
		
	}

			function stopAjax()
			{
				
				event.preventDefault();
				$.ajax({
						url: "update/stop",
						type:"post",

					success: function(response) {
				console.log(response)
 				 }
			});
			}
			
			function startAjax()
			{
				event.preventDefault();
				$.ajax({
						url: "update/start",
						type:"POST",

						
					success: function(response) {
				console.log(response)
 				 }
			});
			}
	</script>


	<script src="{{asset('admin/js/jquery.min.js')}}"></script>
	<script src="{{asset('admin/js/materialize.min.js')}}"></script>
	<script src="{{asset('admin/js/sparkline.js')}}"></script>
	<script src="{{asset('admin/js/amcharts.js')}}"></script>
	<script src="{{asset('admin/js/morris.js')}}"></script>
	<script src="{{asset('admin/js/enscroll-0.5.2.min.js')}}"></script>
	<script src="{{asset('admin/js/animate-headline.js')}}"></script>
	<script src="{{asset('admin/js/slick.min.js')}}"></script>
	<script src="{{asset('admin/js/skycons.js')}}"></script>
	<script src="{{asset('admin/js/script.js')}}" type="text/javascript"></script>
	<script src="{{asset('admin/js/isotope.js')}}"></script>
	<script src="{{asset('toastr/toastr.min.js')}}"></script>

	<script>
		function startInterval(){
			interval = window.setInterval(stopwatch,1000);

		}

		startInterval();

	</script>

	@yield('scripts')

	<script>

	</script>
</body>

</html>