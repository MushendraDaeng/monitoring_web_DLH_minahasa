@extends('partials.layouts')

@section('content')
    <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Sub Kategori</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Form SubKategori</li>
							</ol>
						</nav>
					</div>
					
				</div>
				<!--end breadcrumb-->
				
				<!--end row-->
				<div class="row">
					<div class="col-xl-10 mx-auto">
						<h6 class="mb-0 text-uppercase">Form Sub Kategori</h6>
						<hr/>
						<div class="card border-top border-0 border-4 border-info">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="card-title d-flex align-items-center">
										<div><i class="bx bxs-user me-1 font-22 text-info"></i>
										</div>
										<h5 class="mb-0 text-info">Data Sub Kategori</h5>
									</div>
									<hr/>
                  <form action="{{ route('sub-kategori.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    
                    <div class="row mb-3">
                      <label for="subcategory_name" class="col-sm-3 col-form-label">Sub Kategori</label>
                      <div class="col-sm-9">
                        <input type="text" value="{{ old('subcategory_name') }}" name="subcategory_name" class="form-control @error('subcategory_name') is-invalid @enderror" id="subcategory_name" placeholder="SubKategori...">
                      </div>
                    </div>
                    @error('subcategory_name')
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
  