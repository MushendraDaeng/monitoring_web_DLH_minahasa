@extends('partials.layouts')

@section('content')
    <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Tracking</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Form Tracking</li>
							</ol>
						</nav>
					</div>
					
				</div>
				<!--end breadcrumb-->
				
				<!--end row-->
				<div class="row">
					<div class="col-xl-10 mx-auto">
						<h6 class="mb-0 text-uppercase">Form Tracking</h6>
						<hr/>
						<div class="card border-top border-0 border-4 border-info">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="card-title d-flex align-items-center">
										<div><i class="bx bxs-user me-1 font-22 text-info"></i>
										</div>
										<h5 class="mb-0 text-info">Data Tracking</h5>
									</div>
									<hr/>
                  <form action="{{ route('tracking.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    
                    <div class="row mb-3">
                      <label for="driver_id" class="col-sm-3 col-form-label">Driver</label>
                      <div class="col-sm-9">
                         <select name="driver_id" class="form-select mb-3" aria-label="Default select example">
                          <option selected disabled>Pilih Driver</option>
                          @foreach ($driver as $c)
                            <option @if(old('driver_id') == $c->id) selected @endif value="{{ $c->id }}">{{ $c->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    @error('driver_id')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
{{-- 
                    
                    {{-- <div class="row mb-3">
                      <label for="truck_id" class="col-sm-3 col-form-label">Truck</label>
                      <div class="col-sm-9">
                         <select name="truck_id" class="form-select mb-3" aria-label="Default select example">
                          <option selected disabled>Pilih Truck</option>
                          @foreach ($truck as $t)
                            <option @if(old('truck_id') == $t->id) selected @endif value="{{ $t->id }}">{{ $t->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    @error('truck_id')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror --}}

                    <div class="row mb-3">
                      <label for="route_id" class="col-sm-3 col-form-label">Rute</label>
                      <div class="col-sm-9">
                         <select name="route_id" class="form-select mb-3" aria-label="Default select example">
                          <option selected disabled>Pilih Rute</option>
                          @foreach ($route as $r)
                            <option @if(old('route_id') == $r->id) selected @endif value="{{ $r->id }}">{{ $r->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    @error('route_id')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

										

                    <div class="row mb-3">
                      <label for="act_date" class="col-sm-3 col-form-label">Tanggal Pelaksanaan</label>
                      <div class="col-sm-9">
                        <input type="date"
                         value="{{ old('act_date') }}"  name="act_date" class="form-control @error('act_date') is-invalid @enderror" id="act_date" placeholder="Tanggal Pelaksanaan...">
                      </div>
                    </div>

                    @error('act_date')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    {{-- <div class="row mb-3">
                      <label for="start_time" class="col-sm-3 col-form-label">Waktu Mulai Pelaksanaan</label>
                      <div class="col-sm-9">
                        <input type="datetime-local"
                         value="{{ old('start_time') }}"  name="start_time" class="form-control @error('start_time') is-invalid @enderror" id="start_time" placeholder="Waktu Mulai Pelaksanaan...">
                      </div>
                    </div>

                    @error('start_time')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="row mb-3">
                      <label for="stop_time" class="col-sm-3 col-form-label">Waktu Berakhir Pelaksanaan</label>
                      <div class="col-sm-9">
                        <input type="datetime-local"
                         value="{{ old('stop_time') }}"  name="stop_time" class="form-control @error('stop_time') is-invalid @enderror" id="stop_time" placeholder="Waktu Akhir Pelaksanaan...">
                      </div>
                    </div>

                    @error('stop_time')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror


                    <div class="row mb-3">
                      <label for="start_location" class="col-sm-3 col-form-label">Titik Lokasi Mulai</label>
                      <div class="col-sm-9">
                        <input type="text"
                         oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                         value="{{ old('start_location') }}"  name="start_location" class="form-control @error('start_location') is-invalid @enderror" id="start_location" placeholder="Titik Lokasi Mulai...">
                      </div>
                    </div>

                    @error('start_location')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="row mb-3">
                      <label for="stop_location" class="col-sm-3 col-form-label">Titik Lokasi Berhenti</label>
                      <div class="col-sm-9">
                        <input type="text"
                         oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                         value="{{ old('stop_location') }}"  name="stop_location" class="form-control @error('stop_location') is-invalid @enderror" id="stop_location" placeholder="Titik Lokasi Berhenti...">
                      </div>
                    </div>

                    @error('stop_location')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

 --}}


										      
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
  