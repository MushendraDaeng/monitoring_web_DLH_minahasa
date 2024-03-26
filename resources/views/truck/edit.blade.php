@extends('partials.layouts')

@section('content')
    <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Truck</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Form Edit Truck</li>
							</ol>
						</nav>
					</div>
					
				</div>
				<!--end breadcrumb-->
				
				<!--end row-->
				<div class="row">
					<div class="col-xl-10 mx-auto">
						<h6 class="mb-0 text-uppercase">Form Edit Truck</h6>
						<hr/>
						<div class="card border-top border-0 border-4 border-info">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="card-title d-flex align-items-center">
										<div><i class="bx bxs-user me-1 font-22 text-info"></i>
										</div>
										<h5 class="mb-0 text-info">Berkas Truck</h5>
									</div>
									<hr/>
                  <form action="{{ route('truck.update', $data->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row mb-3">
                      <label for="name" class="col-sm-3 col-form-label">Name</label>
                      <div class="col-sm-9">
                        <input type="text" value="{{ old('name', $data->name) }}" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nama Truck...">
                      </div>
                    </div>

                    @error('name')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

										<div class="row mb-3">
                      <label for="plate" class="col-sm-3 col-form-label">Plat No</label>
                      <div class="col-sm-9">
                        <input type="text" value="{{ old('plate', $data->plate) }}" maxlength="10" name="plate" class="form-control @error('plate') is-invalid @enderror" id="plate" placeholder="Plat Nomor... Contoh DB2013RC, DB2014RX">
                      </div>
                    </div>

                    @error('plate')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="row mb-3">
                      <label for="mnf_year" class="col-sm-3 col-form-label">Tahun Manufaktur</label>
                      <div class="col-sm-9">
                        <input type="text"
                         oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                         value="{{ old('mnf_year', $data->mnf_year) }}"  name="mnf_year" class="form-control @error('mnf_year') is-invalid @enderror" id="mnf_year" placeholder="Tahun Manufaktur...Contoh 2012, 2013">
                      </div>
                    </div>

                    @error('mnf_year')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    
										<div class="row mb-3">
                      <label for="brand" class="col-sm-3 col-form-label">Merk</label>
                      <div class="col-sm-9">
                        <input type="text" value="{{ old('brand', $data->brand) }}" name="brand" class="form-control @error('brand') is-invalid @enderror" id="brand" placeholder="Merk Truck...">
                      </div>
                    </div>

                    @error('brand')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="row mb-3">
                      <label for="fuel_type" class="col-sm-3 col-form-label">Tipe Bahan Bakar</label>
                      <div class="col-sm-9">
                        <input type="text" value="{{ old('fuel_type', $data->fuel_type) }}" name="fuel_type" class="form-control @error('fuel_type') is-invalid @enderror" id="fuel_type" placeholder="Bahan Bakar...">
                      </div>
                    </div>

                    @error('fuel_type')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="row mb-3">
                      <label for="foto" class="col-sm-3 col-form-label">Foto Truck</label>
                      <div class="col-sm-9">
                        <input class="form-control" name="foto" type="file" id="formFile">
                      </div>
                    </div>

                    @error('foto')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  
                          
                    <div class="col-12">
                      <button type="submit" class="btn btn-primary px-5">Simpan</button>
                    </div>
                  </form>
                  {{-- <div id="pspdfkit" style="height:100vh"></div> --}}
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
        function gantiButton() {
          document.getElementById("btnNdaJadi").hidden = false;
          document.getElementById("btnGanti").hidden = true;
          document.getElementById("formFile").disabled = false;
        }

        function gantiButtonNdaJadi() {
          document.getElementById("btnNdaJadi").hidden = true;
          document.getElementById("btnGanti").hidden = false;
          document.getElementById("formFile").disabled = true;
        }
    </script>
@endpush
  