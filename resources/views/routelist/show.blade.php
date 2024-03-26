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
						<h6 class="mb-0 text-uppercase">Form Edit List Rute</h6>
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
                        <input readonly type="text" value="{{ old('name', $data->name) }}" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nama Rute...">
                      </div>
                    </div>
                    @error('name')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
										<div class="row mb-3">
                      <label for="description" class="col-sm-3 col-form-label">Deskripsi</label>
                      <div class="col-sm-9">
                        <textarea readonly class="form-control" name="description" id="inputAddress" placeholder="Deskripsi..." rows="3">{{ old('description', $data->description) }}</textarea>
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
					<h6 class="mb-0 text-uppercase">Datatable Detail List Rute</h6>
					<a href="{{ route('create.route_detail', $data->id) }}" class="btn btn-success px-2" style="justify-content: space-between ">
						<i class="bx bx-folder-plus me-1"></i>
						Tambah Data
					</a>
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
											<th>Customer Name</th>
											<th>Alamat</th>
											<th>Opsi</th>
										</tr>
									</thead>
									<tbody>
										@php
												$no = 0;
										@endphp
										@forelse ($route_detail as $item)
											<tr>
												<td>{{ $no+=1 }}</td>
												<td>{{ $item->customer_name }}</td>
												<td>
														Kelurahan : {{ $item->customer_kel }} <br>
														Kecamatan : {{ $item->customer_kec }}
												</td>
												<td>
													<form action="{{ route('destroy.route_detail', [$data->id, $item->id]) }}" method="post">
														@csrf
														@method('delete')
														
														
														{{-- <iframe height="200" width="300" src="{{asset('berkas/'.$item->berkas)}}" frameborder="0"></iframe> --}}
														<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus data ini?')">
															<i class="bx bx-trash-alt me-0"></i>
														</button>
													</form>

												</td>
											</tr>
										@empty
											<tr>
												<td colspan="7"> Data tidak ada</td>
											</tr>
										@endforelse
										
									</tbody>
									<tfoot>
										<tr>
											<th>No</th>
											<th>Customer Name</th>
											<th>Customer ID</th>
											<th>Opsi</th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-body">
							<div class="col-sm-12">
								<div id="map" style='width: 100%; height: 40vh;'></div>
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
      //input type ID
      let longitude = document.getElementById("longitude");
      let latitude = document.getElementById("latitude");
			const rat = {!! json_encode($listRoute) !!} ;
			console.log('DATA', rat);


      mapboxgl.accessToken = 'pk.eyJ1IjoibWFyY2VsbGthbGl0b3V3IiwiYSI6ImNqbWM3Z2k4OTA3NXIza256OWY4MXM1cWQifQ.ZuXcoyil-xRQl1JRGdl69g';
      const map = new mapboxgl.Map({
        container: 'map',
        // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
        style: 'mapbox://styles/mapbox/streets-v12',
        center: [124.91014,1.30113],
        // center: [{{ $data->longitude }}, {{ $data->latitude }}],
        zoom: 11
      });
      
      const geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        marker:false,
        mapboxgl: mapboxgl
      });

			// for (const data of rat) {
			// // create a HTML element for each data
			// 	const el = document.createElement('div');
			// 	el.className = 'marker';
				
			// 	// make a marker for each data and add it to the map
			// 	new mapboxgl.Marker(el)
			// 	.setLngLat([data.long, data.lat])
			// 	.setPopup(
			// 	new mapboxgl.Popup({ offset: 25 }) // add popups
			// 	.setHTML(
			// 	`<h3>${data.customer_name}</h3><p>${data.customer.}</p>`
			// 	)
			// 	)
			// 	.addTo(map);
			// }

			// const popup = new mapboxgl.Popup({
			// 	closeButton: false,
			// 	closeOnClick: false
			// });

      rat.map((v,key) => {
				// const el = document.createElement('div');
				// el.className = 'marker';
				const popup = new mapboxgl.Popup({ offset: 25 }).setHTML(
				`	<h6> ${v.customer_name} </h6> 
					<p> Alamat : ${v.customer_kel}, ${v.customer_kec} </p>
					<p>Status : ${v.status}</p>
				`
				);

				const marker = new mapboxgl.Marker({
          draggable: false
        })
        .setLngLat([v.long, v.lat])
				.setPopup(popup)
        .addTo(map)

				
			});

			
      


    </script>
@endpush
  