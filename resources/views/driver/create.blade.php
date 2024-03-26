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
						<h6 class="mb-0 text-uppercase">Form Driver</h6>
						<hr/>
						<div class="card border-top border-0 border-4 border-info">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="card-title d-flex align-items-center">
										<div><i class="bx bxs-user me-1 font-22 text-info"></i>
										</div>
										<h5 class="mb-0 text-info">Data Driver</h5>
									</div>
									<hr/>
                  <form action="{{ route('driver.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    
                    <div class="row mb-3">
                      <label for="user_name" class="col-sm-3 col-form-label">User Name</label>
                      <div class="col-sm-9">
                        <input type="text" value="{{ old('user_name') }}" name="user_name" class="form-control @error('user_name') is-invalid @enderror" id="user_name" placeholder="UserName...">
                      </div>
                    </div>
                    @error('user_name')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="row mb-3">
                      <label for="name" class="col-sm-3 col-form-label">Name</label>
                      <div class="col-sm-9">
                        <input type="text" value="{{ old('name') }}" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nama Driver...">
                      </div>
                    </div>

                    @error('name')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="row mb-3">
                      <label for="password" class="col-sm-3 col-form-label">Password</label>
                      <div class="col-sm-9">
                        <input type="password" value="{{ old('password') }}" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="">
                      </div>
                    </div>

                    @error('password')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    
                    <div class="row mb-3">
                      <label for="phone" class="col-sm-3 col-form-label">Phone</label>
                      <div class="col-sm-9">
                        <input type="text"
                         oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                         value="{{ old('phone') }}" pattern="[0-9]+" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Nomor HP driver...">
                      </div>
                    </div>

                    @error('phone')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="row mb-3">
                      <label for="dob" class="col-sm-3 col-form-label">Day Of Birth</label>
                      <div class="col-sm-9">
                        <input type="date"  value="{{ old('dob', '1998-01-01') }}"  
                        
                        name="dob" class="form-control @error('dob') is-invalid @enderror" id="dob" placeholder="Tanggal Lahir...">
                      </div>
                    </div>

                    @error('dob')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="row mb-3">
                      <label for="gender" class="col-sm-3 col-form-label">Gender</label>
                      <div class="col-sm-9">
                        {{-- <input type="date" value="{{ old('gender') }}" pattern="[0-9]+" name="gender" class="form-control @error('gender') is-invalid @enderror" id="gender" placeholder="Tanggal Lahir..."> --}}
                        <select name="gender" class="form-select mb-3" aria-label="Default select example">
                          <option selected disabled>Choose gender</option>
                          <option value="L">Laki-laki</option>
                          <option value="P">Perempuan</option>
                        </select>
                      </div>
                    </div>

                    @error('gender')
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
  