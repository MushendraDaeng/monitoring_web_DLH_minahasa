@extends('partials.layouts')

@section('content')
    <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Setting</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Form Edit Setting</li>
							</ol>
						</nav>
					</div>
					
				</div>
				<!--end breadcrumb-->
				
				<!--end row-->
				<div class="row">
					<div class="col-xl-10 mx-auto">
						<h6 class="mb-0 text-uppercase">Form Edit Setting</h6>
						<hr/>
						<div class="card border-top border-0 border-4 border-info">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="card-title d-flex align-items-center">
										<div><i class="bx bxs-user me-1 font-22 text-info"></i>
										</div>
										<h5 class="mb-0 text-info">Berkas Setting</h5>
									</div>
									<hr/>
                  <form action="{{ route('setting.update', $data->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row mb-3">
                      <label for="ops_name" class="col-sm-3 col-form-label">Ops Name</label>
                      <div class="col-sm-9">
                        <input type="text" value="{{ old('ops_name', $data->ops_name) }}" name="ops_name" class="form-control @error('ops_name') is-invalid @enderror" id="ops_name" placeholder="Nama Ops...">
                      </div>
                    </div>
                    @error('ops_name')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

										<div class="row mb-3">
                      <label for="values" class="col-sm-3 col-form-label">Value</label>
                      <div class="col-sm-9">
                        <input type="text"
                         oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                         value="{{ old('values', $data->values) }}"  name="values" class="form-control @error('values') is-invalid @enderror" id="values" placeholder="Value...">
                      </div>
                    </div>

                    @error('values')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror


										<div class="row mb-3">
                      <label for="status" class="col-sm-3 col-form-label">Status</label>
                      <div class="col-sm-9">
                         <select name="status" class="form-select mb-3" aria-label="Default select example">
                          <option selected disabled>Pilih Status</option>
                          <option {{ $data->status == 'Active' ? 'selected' : '' }} value="Active">Aktiv</option>
                          <option {{ $data->status == 'Deactive' ? 'selected' : '' }} value="Deactive">Tidak Aktiv</option>
                        </select>
                      </div>
                    </div>

                    @error('status')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

										<div class="row mb-3">
                      <label for="unit" class="col-sm-3 col-form-label">Unit</label>
                      <div class="col-sm-9">
                         <select name="unit" class="form-select mb-3" aria-label="Default select example">
                          <option selected disabled>Pilih Unit</option>
                          <option {{ $data->unit == 'Minutes' ? 'selected' : '' }} value="Minutes">Menit</option>
                          <option {{ $data->unit == 'Hour' ? 'selected' : '' }} value="Hour">Jam</option>
                          <option {{ $data->unit == 'Day' ? 'selected' : '' }} value="Day">Hari</option>
                        </select>
                      </div>
                    </div>

                    @error('unit')
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
  