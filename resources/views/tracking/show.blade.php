@extends('partials.layouts')

@section('content')
    <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-5">
					<div class="breadcrumb-title pe-3">List Rute</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Form Edit List Rute</li>
							</ol>
						</nav>
					</div>
					
				</div>
				<!--end breadcrumb-->
				
				<!--end row-->
				<div class="row">
					<div class="col-xl-12 mx-auto">
						<h6 class="mb-0 text-uppercase">Form Detail List Rute</h6>
						<hr/>
						<div class="card border-top border-0 border-4 border-info">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="card-title d-flex align-items-center">
										<div><i class="bx bxs-user me-1 font-22 text-info"></i>
										</div>
										<h5 class="mb-0 text-info">Berkas List Rute</h5>
									</div>
									<hr/>
                  <form action="{{ route('routelist.update', $data->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row mb-3">
                      <label for="name" class="col-sm-3 col-form-label">Rute</label>
                      <div class="col-sm-9">
                        <input readonly type="text" value="{{ old('name', $tracking_detail->route_name) }}" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nama Rute...">
                      </div>
                    </div>
                    @error('name')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
										<div class="row mb-3">
                      <label for="description" class="col-sm-3 col-form-label">Deskripsi</label>
                      <div class="col-sm-9">
                        <textarea readonly class="form-control" name="description" id="inputAddress" placeholder="Deskripsi..." rows="3">{{ old('description', $tracking_detail->route_desc) }}</textarea>
                      </div>
                    </div>
                    @error('description')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  
                  </form>
                  {{-- <div id="pspdfkit" style="height:100vh"></div> --}}
								</div>
							</div>
						</div>
					</div>

				</div>
        <div style="display: flex; justify-content: space-between">
					<h6 class="mb-0 text-uppercase">Datatable Detail Tracking</h6>
					
					{{-- <div class="col">
						<button btype="button" class="btn btn-success px-5" onclick="round_success_custom_notif()"><i class="bx bx-check-circle mr-1"></i> Success</button>
					</div> --}}
				</div>
				<hr/>
				<div class="row">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table id="example2" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Driver</th>
											<th>Trucks</th>
										</tr>
									</thead>
									<tbody>
										@php
												$no = 0;
										@endphp
										{{-- @forelse ($tracking_detail as $item) --}}
											<tr>
												<td>{{ 1 }}</td>
												<td>{{ $tracking_detail->drivers_name }}</td>
												<td>{{ $tracking_detail->truck_name }}</td>
											</tr>
										{{-- @empty
											<tr>
												<td colspan="7"> Data tidak ada</td>
											</tr>
										@endforelse --}}
										
									</tbody>
									<tfoot>
										<tr>
											<th>No</th>
											<th>Driver Name</th>
											<th>Trucks</th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
					<div style="display: flex; justify-content: space-between">
						<h6 class="mb-0 text-uppercase">Map Detail Tracking</h6>

					</div>
					<hr>
					<div class="card">
						<div class="card-body">
							<div class="col-sm-12">
								<div id="map" style='width: 100%; height: 50vh;'></div>
							</div>
						</div>
					</div>
				</div>
        
				<!--end row-->
			</div>
		</div>
@endsection

@push('addons-script')
		
    <script>
			let existNotif = '{{ Session::has('success') }}'
			let msgSuccesNotif = '{{ Session::get('success') }}';
			let msgDeleteNotif = '{{ Session::get('deleted') }}';
			let existDeleteNotif = '{{ Session::has('deleted') }}'


			// let comp = document.getElementById("page-wrapper");
			console.log('comp', msgSuccesNotif);

			window.onload = function() {
				if (existNotif) {
					round_success_custom_notif(msgSuccesNotif);
					console.log('comp', msgSuccesNotif);
				}
				if(existDeleteNotif){
					round_error_noti(msgDeleteNotif)
					console.log('comp', msgDeleteNotif);
				}

			}

			
			async function round_success_custom_notif(msg) {
				await Lobibox.notify('success', {
					pauseDelayOnHover: true,
					size: 'mini',
					rounded: true,
					icon: 'bx bx-check-circle',
					delayIndicator: false,
					continueDelayOnInactiveTab: false,
					position: 'top right',
					sound:false,
					msg: msg
				});
			}

			async function round_error_noti(msg) {
				await Lobibox.notify('error', {
					pauseDelayOnHover: true,
					size: 'mini',
					rounded: true,
					sound:false,
					delayIndicator: false,
					icon: 'bx bx-x-circle',
					continueDelayOnInactiveTab: false,
					position: 'top right',
					msg: msg,
				});
			}

		</script>

		<script>
      
			const rat = {!! json_encode($listLocation) !!} ;
			console.log('DATA', rat);


      mapboxgl.accessToken = 'pk.eyJ1IjoibWFyY2VsbGthbGl0b3V3IiwiYSI6ImNqbWM3Z2k4OTA3NXIza256OWY4MXM1cWQifQ.ZuXcoyil-xRQl1JRGdl69g';
    
			const map = new mapboxgl.Map({
				container: "map", // container ID
				// Choose from Mapbox's core styles, or make your own style with Mapbox Studio
				style: "mapbox://styles/mapbox/streets-v12", // style URL
				center: [rat[0].longitude, rat[0].latitude], // starting position [lng, latitude]
				zoom: 12.773, // starting zoom
		});
		const data = rat.map(v => [v.longitude, v.latitude]);
		console.log('DATA', data);
		const geojson = {
				type: "FeatureCollection",
				features: [
						{
								type: "Feature",
								properties: {},
								geometry: {
										coordinates: data,
										type: "LineString",
								},
						},
				],
		};
		map.on("load", () => {
				map.addSource("line", {
						type: "geojson",
						data: geojson,
				});
				// map.addLayer({
				// 	'id': 'route',
				// 	'type': 'line',
				// 	'source': 'route',
				// 	'layout': {
				// 		'line-join': 'round',
				// 		'line-cap': 'round'
				// 	},
				// 	'paint': {
				// 		'line-color': '#888',
				// 		'line-width': 8
				// 	}
				// });

				// add a line layer without line-dasharray defined to fill the gaps in the dashed line
				map.addLayer({
						type: "line",
						source: "line",
						id: "line-background",
						paint: {
								"line-color": "green",
								"line-width": 6,
								"line-opacity": 0.4,
						},
				});

				// add a line layer with line-dasharray set to the first value in dashArraySequence
				map.addLayer({
						type: "line",
						source: "line",
						id: "line-dashed",
						paint: {
								"line-color": "green",
								"line-width": 6,
								"line-dasharray": [0, 4, 3],
						},
				});

				// technique based on https://jsfiddle.net/2mws8y3q/
				// an array of valid line-dasharray values, specifying the lengths of the alternating dashes and gaps that form the dash pattern
				const dashArraySequence = [
						[0, 4, 3],
						[0.5, 4, 2.5],
						[1, 4, 2],
						[1.5, 4, 1.5],
						[2, 4, 1],
						[2.5, 4, 0.5],
						[3, 4, 0],
						[0, 0.5, 3, 3.5],
						[0, 1, 3, 3],
						[0, 1.5, 3, 2.5],
						[0, 2, 3, 2],
						[0, 2.5, 3, 1.5],
						[0, 3, 3, 1],
						[0, 3.5, 3, 0.5],
				];

				let step = 0;

				function animateDashArray(timestamp) {
						// Update line-dasharray using the next value in dashArraySequence. The
						// divisor in the expression `timestamp / 50` controls the animation speed.
						const newStep = parseInt((timestamp / 50) % dashArraySequence.length);

						if (newStep !== step) {
								map.setPaintProperty(
										"line-dashed",
										"line-dasharray",
										dashArraySequence[step]
								);
								step = newStep;
						}

						// Request the next frame of the animation.
						requestAnimationFrame(animateDashArray);
				}

				// start the animation
				animateDashArray(0);
		});

		rat.map((v,key) => {
				// const el = document.createElement('div');
				// el.className = 'marker';
				// const popup = new mapboxgl.Popup({ offset: 25 }).setHTML(
				// `	<h6> ${v.customer_name} </h6> 
				// 	<p> Alamat : ${v.customer_kel}, ${v.customer_kec} </p>
				// 	<p>Status : ${v.status}</p>
				// `
				// );

				const marker = new mapboxgl.Marker({
          draggable: false
        })
        .setLngLat([v.longitude, v.latitude])
				// .setPopup(popup)
        .addTo(map)

				
			});
</script>
@endpush
  