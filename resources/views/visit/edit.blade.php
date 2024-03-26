@extends('partials.layouts')

@section('content')
    <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Visit</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Form Edit Visit</li>
							</ol>
						</nav>
					</div>
					
				</div>
				<!--end breadcrumb-->
				
				<!--end row-->
				<div class="row">
					<div class="col-xl-10 mx-auto">
						<h6 class="mb-0 text-uppercase">Form Edit Visit</h6>
						<hr/>
						<div class="card border-top border-0 border-4 border-info">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="card-title d-flex align-items-center">
										<div><i class="bx bxs-user me-1 font-22 text-info"></i>
										</div>
										<h5 class="mb-0 text-info">Berkas Visit</h5>
									</div>
									<hr/>
                  <form action="{{ route('visit.update', $data->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row mb-3">
                      <label for="customer_id" class="col-sm-3 col-form-label">Pelanggan</label>
                      <div class="col-sm-9">
                         <select name="customer_id" class="form-select mb-3" aria-label="Default select example">
                          <option selected disabled>Pilih Pelanggan</option>
                          @foreach ($customer as $c)
                            <option @if(old('customer_id') == $c->id) selected  @elseif ($data->customer_id == $c->id) selected @endif value="{{ $c->id }}">{{ $c->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    @error('customer_id')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    
                    <div class="row mb-3">
                      <label for="tracking_id" class="col-sm-3 col-form-label">Tracking</label>
                      <div class="col-sm-9">
                         <select name="tracking_id" class="form-select mb-3" aria-label="Default select example">
                          <option selected disabled>Pilih Tracking</option>
                          @foreach ($tracking as $c)
                            <option @if(old('tracking_id') == $c->id) selected  @elseif ($data->tracking_id == $c->id) selected @endif value="{{ $c->id }}">{{ $c->act_date }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    @error('tracking_id')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

										

                    <div class="row mb-3">
                      <label for="photo_url" class="col-sm-3 col-form-label">Foto</label>
                      <div class="col-sm-9">
                        <input name="photo_url" value="{{ old('photo_url') }}" class="form-control" type="file" id="formFile">
                      </div>
                    </div>

                    @error('photo_url')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="row mb-3">
                      <label for="description" class="col-sm-3 col-form-label">Deskripsi</label>
                      <div class="col-sm-9">
                        <textarea class="form-control" name="description" id="inputAddress" placeholder="Deskripsi..." rows="3">{{ old('description', $data->description) }}
                        </textarea>
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
  