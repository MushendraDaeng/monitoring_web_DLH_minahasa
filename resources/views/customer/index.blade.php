@extends('partials.layouts')


@section('content')
    <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Customers</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Customers</li>
							</ol>
						</nav>
					</div>
					
				</div>
				<!--end breadcrumb-->
				<div style="display: flex; justify-content: space-between">
					<h6 class="mb-0 text-uppercase">Datatable Customers</h6>
					<div class="">
						<a href="{{ route('customer.create') }}" class="btn btn-success px-2" style="justify-content: space-between ">
							<i class="bx bx-folder-plus me-1"></i>
							Tambah Data
						</a>
						<button type="button" class="btn btn-primary px-2" data-bs-toggle="modal" data-bs-target="#exampleLargeModal">
							<i class="fadeIn animated bx bx-import"></i>
							Import Data
						</button>
						<div class="col">
						<!-- Modal -->
						<div class="modal fade" id="exampleLargeModal" data-bs-backdrop='static' tabindex="-1" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Import Data Customer (.csv)</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<form id="importForm" data-type="post" data-action="{{ route('import.customer') }}" action="" method="POST" enctype="multipart/form-data" >
											@csrf
											<div class="input-group col-lg-12">
												<div class="mb-3">
													<label class="form-label">File data customer:</label>
													<input id="fileCSV" type="file" name="fileCSV" accept=".csv,.xlsx" class="form-control">
												</div>
											</div>
										
										
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
										<button id="btnImport" type="submit" style="display: flex;align-items: center; justify-content:space-between"  class="btn btn-primary">
											Import
											<div id="spinner"  class="spinner-grow" style="display:none; width: 1rem; height: 1rem;" role="status"> <span class="visually-hidden">
												Loading...</span>
											</div>
										</button>
									</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					

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
										<th>Nama</th>
										<th>Kategori</th>
										<th>Alamat</th>
										<th>Tarif</th>
										<th>Status</th>
										<th>Lat-Long</th>
							
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
											<td>{{ $item->name }}</td>
											<td>
												Kategori : {{ $item->kategori }} <br>
												Sub	: {{ $item->sub_kategori }}
											</td>
											<td>
												Kecamatan : {{ $item->urban_village }} <br>
												Kelurahan	: {{ $item->sub_district }}
											</td>
											<td>
												{{ $item->tarif }}
											</td>
											<td>
												{{ $item->status }}
											</td>
											<td>
												{{ $item->latitude }} <br>
												{{ $item->longitude}}
											</td>
											
											<td>
												<form action="{{ route('customer.destroy', $item->id) }}" method="post">
													@csrf
													@method('delete')
													<a id="berkasId" href="{{ route('customer.show', $item->id) }}" class="btn btn-primary">
														<i class="bx bx bx-detail me-0"></i>
													</a>
													<a id="berkasId" href="{{ route('customer.edit', $item->id) }}" class="btn btn-warning">
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
											<td colspan="8"> Data tidak ada</td>
										</tr>
									@endforelse
									
								</tbody>
								<tfoot>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Kategori</th>
										<th>Alamat</th>
										<th>Tarif</th>
										<th>Status</th>
										<th>Lat-Long</th>
							
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
			  $(document).ready(function(){
        // $('#modal').modal('hide')
        // const form = document.getElementById('modal-tambah-data');
        var form = '#importForm';

            $(form).on('submit', function(event){
                event.preventDefault();
                // spinner.style.display = 'block';
                
								let spinner = document.getElementById('spinner');
								let textBtn = document.getElementById('btnImport');
								spinner.style.display = 'block';
                var url = $(this).attr('data-action');
                let type = $(this).attr('data-type');
                let form = new FormData(this)
                console.log('GETATTRIBUTE', ...form, spinner,textBtn);

                if (type == 'post') {
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: form,
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success:function(response)
                        {
														spinner.style.display = 'none';

                            console.log('RESPONSE ', response.message);
                            round_success_custom_notif('Import Data Berhasil');
														setTimeout(() => {
                              location.reload()
														}, 1500);
                        },
                        error: function(response) {

														textBtn.innerText('Import Error');
                            $('#button-simpan').removeClass('button--loading')
                            console.log('RESPONSE ERROR', response.responseJSON);
                            const errorMessage = response.responseJSON;
                            if(errorMessage.error){
                                for (const erMsg in errorMessage.errors) {
                                    console.log('OBJ', errorMessage.errors[erMsg][0])
                                    const element = document.getElementById(`val-${erMsg}-error`);
                                    element.style.display = "block";
                                    element.innerText = `${errorMessage.errors[erMsg][0]}`
                                    element.classList.add("mystyle");
                                    
                                }
                            }
                        }
                    });
                }
                
                
            });
        });
		</script>

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