@extends('partials.layouts')

@section('content')
    <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Customer</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Form Customer</li>
							</ol>
						</nav>
					</div>
					
				</div>
				<!--end breadcrumb-->
				
				<!--end row-->
				<div class="row">
					<div class="col-xl-10 mx-auto">
						<h6 class="mb-0 text-uppercase">Form Customer</h6>
						<hr/>
						<div class="card border-top border-0 border-4 border-info">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="card-title d-flex align-items-center">
										<div><i class="bx bxs-user me-1 font-22 text-info"></i>
										</div>
										<h5 class="mb-0 text-info">Data Customer</h5>
									</div>
									<hr/>
                  <form action="{{ route('customer.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                      <label for="id_kategori" class="col-sm-3 col-form-label">Kategori</label>
                      <div class="col-sm-9">
                         <select name="id_kategori" class="form-select mb-3" aria-label="Default select example">
                          <option selected disabled>Pilih Kategori</option>
                          @foreach ($kategori as $k)
                            <option value="{{ $k->id }}">{{ $k->category_name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    @error('id_kategori')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="row mb-3">
                      <label for="id_sub_kategori" class="col-sm-3 col-form-label">Sub Kategori</label>
                      <div class="col-sm-9">
                        <select name="id_sub_kategori" class="form-select mb-3" aria-label="Default select example">
                          <option selected disabled>Pilih Sub Kategori</option>
                          @foreach ($subKategori as $sk)
                            <option value="{{ $sk->id }}">{{ $sk->subcategory_name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    @error('id_sub_kategori')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                   

                    <div class="row mb-3">
                      <label for="name" class="col-sm-3 col-form-label">Name</label>
                      <div class="col-sm-9">
                        <input type="text" value="{{ old('name') }}" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nama Pelanggan...">
                      </div>
                    </div>

                    @error('name')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="row mb-3">
                      <label for="urban_village" class="col-sm-3 col-form-label">Kelurahan</label>
                      <div class="col-sm-9">
                        <input type="text" value="{{ old('urban_village') }}" name="urban_village" class="form-control @error('urban_village') is-invalid @enderror" id="urban_village" placeholder="Kelurahan Pelanggan...">
                      </div>
                    </div>

                    @error('urban_village')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="row mb-3">
                      <label for="sub_district" class="col-sm-3 col-form-label">Kecamatan</label>
                      <div class="col-sm-9">
                        <input type="text" value="{{ old('sub_district') }}" name="sub_district" class="form-control @error('sub_district') is-invalid @enderror" id="sub_district" placeholder="Kecamatan Pelanggan...">
                      </div>
                    </div>

                    @error('sub_district')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="row mb-3">
                      <label for="tarif" class="col-sm-3 col-form-label">Tarif</label>
                      <div class="col-sm-9">
                        <input type="text"
                         oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                         value="{{ old('tarif') }}" pattern="[0-9]+" name="tarif" class="form-control @error('tarif') is-invalid @enderror" id="tarif" placeholder="Tarif Pelanggan...">
                      </div>
                    </div>

                    @error('tarif')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="row mb-3">
                      <label for="latitude" class="col-sm-3 col-form-label">Latitude</label>
                      <div class="col-sm-9">
                        <input type="text"
                        readonly
                         oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                         value="{{ old('latitude') }}"  name="latitude" class="form-control @error('latitude') is-invalid @enderror" id="latitude" placeholder="Latitude...">
                      </div>
                    </div>

                    @error('latitude')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="row mb-3">
                      <label for="longitude" class="col-sm-3 col-form-label">Longitude</label>
                      <div class="col-sm-9">
                        <input type="text".
                          readonly
                         oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                         value="{{ old('longitude') }}"  name="longitude" class="form-control @error('longitude') is-invalid @enderror" id="longitude" placeholder="Longitude...">
                      </div>
                    </div>

                    @error('longitude')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="row mb-3">
                      <label for="longitude" class="col-sm-3 col-form-label">Map</label>
                      <div class="col-sm-9">
                        <div id="map" style='width: 100%; height: 300px;'></div>
                      </div>
                    </div>

                    @error('longitude')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror


                    

                    <div class="row mb-3">
                      <label for="status" class="col-sm-3 col-form-label">Status Customer</label>
                      <div class="col-sm-9">
                         <select name="status" class="form-select mb-3" aria-label="Default select example">
                          <option selected disabled>Pilih Status</option>
                          <option value="Berlangganan">Berlangganan</option>
                          <option value="Berhenti Berlangganan">Berhenti Berlangganan</option>
                        </select>
                      </div>
                    </div>

                    @error('status')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    
                          
                    <div class="col-12">
                      <button type="submit" class="btn btn-primary px-5">Simpan</button>
                    </div>
                  </form>
								</div>
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
      //input type ID
      let longitude = document.getElementById("longitude");
      let latitude = document.getElementById("latitude");



      mapboxgl.accessToken = 'pk.eyJ1IjoibWFyY2VsbGthbGl0b3V3IiwiYSI6ImNqbWM3Z2k4OTA3NXIza256OWY4MXM1cWQifQ.ZuXcoyil-xRQl1JRGdl69g';
      const map = new mapboxgl.Map({
        container: 'map',
        // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
        style: 'mapbox://styles/mapbox/streets-v12',
        // center: [124.91014,1.30113],
        center: [124.91019766365713, 1.300563956728908],
        zoom: 16
      });
      
      const geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        marker:false,
        mapboxgl: mapboxgl
      });
      
      let marker = new mapboxgl.Marker({
          draggable: true
        })
        .setLngLat([124.91019766365713, 1.300563956728908])
        .addTo(map)
        marker.on('dragend', e => {
          // marker dragged

          // console.log(e.target.getLngLat());
          let {lng, lat} = e.target.getLngLat();
          longitude.value = `${lng}`;
          latitude.value = `${lat}`;
          // console.log(lng, lat);
            
        });

      

      geocoder.on('result', e => {
        // marker1.remove();
        marker.remove();
        // console.log('E', e.result.center)
        let [lng, lat] = e.result.center;
          longitude.value = `${lng}`;
          latitude.value = `${lat}`;

        
        // console.log(lng, lat);
        marker = new mapboxgl.Marker({
          draggable: true
        })
        .setLngLat(e.result.center)
        .addTo(map)
        marker.on('dragend', e => {
          // marker dragged
          // console.log(e.target.getLngLat());
          let {lng, lat} = e.target.getLngLat();
          longitude.value = `${lng}`;
          latitude.value = `${lat}`;
          // console.log(lng, lat);
        })
      })
      map.addControl(geocoder);
      // Add the control to the map.

      // geocoder.mapMarker.on('dragend', (e) => { console.log(e.target.getLngLat()); });
      // geocoder.on('results', function (results) {
        
      //   console.log(results.features[0].center[0]);
      //   console.log(results.features[0].center[1]);
        
      // })

    </script>

    <script>
      $('#fancy-file-upload').FancyFileUpload({
        params: {
          action: 'fileuploader'
        },
        maxfilesize: 1000000
      });
    </script>
    <script>
      $(document).ready(function () {
        $('#image-uploadify').imageuploadify();
      })
    </script>
@endpush
  