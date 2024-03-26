@extends('partials.layouts')

@section('content')
    <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Laporan Berlangganan</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Form Edit Laporan Berlangganan</li>
							</ol>
						</nav>
					</div>
					
				</div>
				<!--end breadcrumb-->
				
				<!--end row-->
				<div class="row">
					<div class="col-xl-10 mx-auto">
						<h6 class="mb-0 text-uppercase">Form Edit Laporan Berlangganan</h6>
						<hr/>
						<div class="card border-top border-0 border-4 border-info">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="card-title d-flex align-items-center">
										<div><i class="bx bxs-user me-1 font-22 text-info"></i>
										</div>
										<h5 class="mb-0 text-info">Berkas Laporan Berlangganan</h5>
									</div>
									<hr/>
                  <form action="{{ route('subscription_report.update', $data->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row mb-3">
                      <label for="customer_id" class="col-sm-3 col-form-label">Pelanggan</label>
                      <div class="col-sm-9">
                         <select name="customer_id" class="form-select mb-3" aria-label="Default select example">
                          <option selected disabled>Pilih Pelanggan</option>
                          @foreach ($customer as $c)
                            <option @if(old('customer_id') == $c->id) selected @elseif ($data->customer_id == $c->id) selected @endif value="{{ $c->id }}">{{ $c->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    @error('customer_id')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

										<div class="row mb-3">
                      <label for="total_payment" class="col-sm-3 col-form-label">Total Pembayaran</label>
                      <div class="col-sm-9">
                        <input type="text"
                         oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                         value="{{ old('total_payment', $data->total_payment) }}"  name="total_payment" class="form-control @error('total_payment') is-invalid @enderror" id="total_payment" placeholder="Total Pembayaran...">
                      </div>
                    </div>

                    @error('total_payment')
                          <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="row mb-3">
                      <label for="payment_date" class="col-sm-3 col-form-label">Tanggal Pembayaran</label>
                      <div class="col-sm-9">
                        <input type="date"
                         value="{{ old('payment_date', $data->payment_date) }}"  name="payment_date" class="form-control @error('payment_date') is-invalid @enderror" id="payment_date" placeholder="Tanggal Pembayaran...">
                      </div>
                    </div>

                    @error('payment_date')
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
  