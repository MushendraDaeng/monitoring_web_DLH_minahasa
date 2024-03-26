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
								<li class="breadcrumb-item active" aria-current="page">Laporan Berlangganan</li>
							</ol>
						</nav>
					</div>
					
				</div>
				<!--end breadcrumb-->
				<div style="display: flex; justify-content: space-between">
					<h6 class="mb-0 text-uppercase">Datatable Laporan Berlangganan</h6>
					<div style=" justify-content: space-between; "	>
						<a href="{{ route('subscription_report.create') }}" class="btn btn-success px-2" >
							<i class="bx bx-folder-plus me-1"></i>
							Tambah Data
						</a>
						<a href="{{ route('subscription_report.export') }}" class="btn btn-primary px-2" >
							<i class="fadeIn animated bx bx-export"></i>
							Export Laporan
						</a>

					</div>
					{{-- <div class="col">
						<button btype="button" class="btn btn-success px-5" onclick="round_success_custom_notif()"><i class="bx bx-check-circle mr-1"></i> Success</button>
					</div> --}}
				</div>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>No</th>
										<th>Pelanggan</th>
										<th>Total Payment</th>
										<th>Tanggal Pembayaran</th>
										<th>Opsi</th>
									</tr>
								</thead>
								<tbody>
									@php
											$no = 0;
									@endphp
									@forelse ($data as $item)
										<tr>
											<td>{{ $no+=1 }}</td>
											<td>{{ $item->customer_name }}</td>
											<td>{{ $item->total_payment }}</td>
											<td>{{ $item->payment_date }}</td>
											<td>
												<form action="{{ route('subscription_report.destroy', $item->id) }}" method="post">
													@csrf
													@method('delete')
													<a id="berkasId" href="{{ route('subscription_report.edit', $item->id) }}" class="btn btn-warning">
														<i class="bx bx-edit me-0"></i>
													</a>
													{{-- <iframe height="200" width="300" src="{{asset('berkas/'.$item->berkas)}}" frameborder="0"></iframe> --}}
													<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus data ini?')">
														<i class="bx bx-trash-alt me-0"></i>
													</button>
												</form>

											</td>
										</tr>
									@empty
										<tr>
											<td colspan="7"> Data tidak ada</td>
										</tr>
									@endforelse
									
								</tbody>
								<tfoot>
									<tr>
										<th>No</th>
										<th>Rute</th>
										<th>Deskripsi</th>
										<th>Opsi</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
@endsection

@push('addons-script')
		


		<script>
			let existNotif = '{{ Session::has('success') }}'
			let msgSuccesNotif = '{{ Session::get('success') }}';
			let msgDeleteNotif = '{{ Session::get('deleted') }}';
			let existDeleteNotif = '{{ Session::has('deleted') }}'


			// let comp = document.getElementById("page-wrapper");
			console.log('comp', msgSuccesNotif);

			window.onload = function() {
				if (existNotif) {
					round_success_custom_notif(msgSuccesNotif);
					console.log('comp', msgSuccesNotif);
				}
				if(existDeleteNotif){
					round_error_noti(msgDeleteNotif)
					console.log('comp', msgDeleteNotif);
				}

			}

			
			async function round_success_custom_notif(msg) {
				await Lobibox.notify('success', {
					pauseDelayOnHover: true,
					size: 'mini',
					rounded: true,
					icon: 'bx bx-check-circle',
					delayIndicator: false,
					continueDelayOnInactiveTab: false,
					position: 'top right',
					sound:false,
					msg: msg
				});
			}

			async function round_error_noti(msg) {
				await Lobibox.notify('error', {
					pauseDelayOnHover: true,
					size: 'mini',
					rounded: true,
					sound:false,
					delayIndicator: false,
					icon: 'bx bx-x-circle',
					continueDelayOnInactiveTab: false,
					position: 'top right',
					msg: msg,
				});
			}

		</script>
@endpush