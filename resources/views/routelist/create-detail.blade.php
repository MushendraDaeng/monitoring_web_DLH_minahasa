@extends('partials.layouts')

@section('content')
    <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Driver</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Form Driver</li>
							</ol>
						</nav>
					</div>
					
				</div>
				<!--end breadcrumb-->
				
				<!--end row-->
				<div class="row">
					<div class="col-xl-10 mx-auto">
						<h6 class="mb-0 text-uppercase">Form Data Pelanggan</h6>
						<hr/>
						<div class="card border-top border-0 border-4 border-info">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="card-title d-flex align-items-center">
										<div><i class="bx bxs-user me-1 font-22 text-info"></i>
										</div>
										<h5 class="mb-0 text-info">Data Pelanggan</h5>
									</div>
									<hr/>
                  <form action="{{ route('store.route_detail') }}" method="post" >
                    @csrf

                    <div class="row mb-3">
                      <label for="customer_id" class="col-sm-3 col-form-label">Pelanggan</label>
                      <div class="col-sm-9">
                         <select name="customer_id" class="form-select mb-3" aria-label="Default select example">
                          <option selected disabled>Pilih Pelanggan</option>
                          @foreach ($customer as $c)
                            <option @if(old('customer_id') == $c->id) selected @endif value="{{ $c->id }}">{{ $c->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    @error('customer_id')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <input type="hidden" name="route_id" value="{{ $id }}">
                          
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
  