@extends('partials.layouts')

@section('content')
    <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
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
					<div class="col-xl-10 mx-auto">
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
                        <input type="text" value="{{ old('name', $data->name) }}" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nama Rute...">
                      </div>
                    </div>
                    @error('name')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
										<div class="row mb-3">
                      <label for="description" class="col-sm-3 col-form-label">Deskripsi</label>
                      <div class="col-sm-9">
                        <textarea class="form-control" name="description" id="inputAddress" placeholder="Deskripsi..." rows="3">{{ old('description', $data->description) }}</textarea>
                      </div>
                    </div>
                    @error('description')
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
  