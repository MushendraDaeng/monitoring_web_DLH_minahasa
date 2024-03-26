@extends('partials.layouts')


@section('content')
    <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Export Data Laporan Berlangganan</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Export Data Laporan Berlangganan</li>
							</ol>
						</nav>
					</div>
					
				</div>
				<!--end breadcrumb-->
				<div style="display: flex; justify-content: space-between">
					<h6 class="mb-0 text-uppercase">Export data Laporan Berlangganan</h6>
					
					{{-- <div class="col">
						<button btype="button" class="btn btn-success px-5" onclick="round_success_custom_notif()"><i class="bx bx-check-circle mr-1"></i> Success</button>
					</div> --}}
				</div>
				<hr/>
				<div class="card">
					<div class="card-body">
						
						<div class="accordion accordion-flush" id="accordionFlushExample">
							<div class="accordion-item">
								<h2 class="accordion-header" id="flush-headingOne">
									<button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
									Filter Export
									</button>
								</h2>
										<div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
											<div class="accordion-body">
												<div class="basic-form">
														
																<div class="form-group row mb-3">
																		<label class="col-sm-2 col-form-label">Jangka Waktu </label>
																		<div class="col-sm-10">
																				<select onchange="onChangeJangkaWaktu(this.value)" class="form-control form-control" id="jangkaWaktu" name="jangka_waktu">
																						<option selected disabled>~Pilih Jangka Waktu~</option>
																						<option value="triwulan">Triwulan</option>
																						<option value="perbulan">Perbulan</option>
																						<option value="pertahun">Pertahun</option>
																						<option value="rentangWaktu">Rentang Waktu</option>
																				</select>
																		</div>
																		
																		@error('nama')
																				<div class="alert alert-danger">{{ $message }}</div>
																		@enderror
																</div>
																<div class="form-group row mb-3" id="triwulan" style="display: none;">
																		<label class="col-sm-2 col-form-label">Triwulan </label>
																		<div class="col-sm-10"  style="display: hidden">
																				<select id="inpTriwulan" class="form-control form-control" name="triwulan">
																						<option selected disabled>~Pilih Triwulan~</option>
																						<option value="triwulan1">Triwulan I</option>
																						<option value="triwulan2">Triwulan II</option>
																						<option value="triwulan3">Triwulan III</option>
																						<option value="triwulan4">Triwulan IV</option>
																				</select>
																		</div>
																		
																		@error('nama')
																				<div class="alert alert-danger">{{ $message }}</div>
																		@enderror
																</div>
																<div class="form-group row mb-3" id="perbulan" style="display: none;">
																		<label class="col-sm-2 col-form-label">Bulan </label>
																		<div class="col-sm-10"  style="display: hidden">
																				<select id="inpBulan" class="form-control form-control" name="perbulan">
																						<option value="" selected disabled>~Pilih Bulan~</option>

																						@foreach ($listMonth as $item)
																								<option value="{{ $item->date }}">{{ $item->month }}</option>
																						@endforeach
																				</select>
																		</div>
																		
																		@error('nama')
																				<div class="alert alert-danger">{{ $message }}</div>
																		@enderror
																</div>

																<div class="form-group row mb-3" id="pertahun" style="display: none;">
																		<label class="col-sm-2 col-form-label">Pertahun </label>
																		<div class="col-sm-10"  style="display: ">
																				<select id="inpTahun" class="form-control form-control" name="pertahun" id="">
																						<option value="" selected disabled>~Pilih Tahun~</option>
																						@for ($i = date('Y'); $i > 2015; $i--)
																								<option value="{{ $i }}">{{ $i }}</option>
																						@endfor
																				</select>
																		</div>
																		
																		@error('nama')
																				<div class="alert alert-danger">{{ $message }}</div>
																		@enderror
																</div>

																<div class="form-group row mb-3" id="perrentangwaktu" style="display:none;">
																		<label class="col-sm-2 col-form-label">Rentang Waktu </label>
																		<div class="col-sm-10"  style="display: ">
																				<div class="input-group input-group mb-2">
																						
																								<span class="input-group-text">Tanggal Mulai</span>
																						
																						<input  class="form-control" name="start" type=date id=start required>
																				</div>
																				<div class="input-group input-group">
																						{{-- <div class="input-group"> --}}
																								<span class="input-group-text">Tanggal Berakhir</span>
																						{{-- </div> --}}
																						<input class="form-control" name="end" type=date id=end required>
																				</div>
																		</div>
																		
																		@error('nama')
																				<div class="alert alert-danger">{{ $message }}</div>
																		@enderror
																</div>


																
																<div class="form-group row mb-3">
																		<div class="col-sm-10">
																				<button type="submit" class="btn btn-primary btn-submit">Filter</button>
																		</div>
																</div>

												</div>
											</div>
										</div>
							</div>
							
							
						</div>
					</div>
				</div>
			</div>
		</div>
@endsection

@push('addons-script')
		<script>
        var JangkaWaktu = document.getElementById('jangkaWaktu');
        var Triwulan = document.getElementById('triwulan');
        var Perbulan = document.getElementById('perbulan');
        var Pertahun = document.getElementById('pertahun');
        var RentangWaktu = document.getElementById('perrentangwaktu');

        function onChangeJangkaWaktu(e){
            console.log('E', e);
            switch (e) {
                case 'triwulan':
                    Triwulan.style.display = "flex";
                    Perbulan.style.display = "none";
                    Pertahun.style.display = "none";
                    RentangWaktu.style.display = "none";
                    
                    break;
                case 'perbulan':
                    Perbulan.style.display = "flex";
                    Triwulan.style.display = "none";
                    Pertahun.style.display = "none";
                    RentangWaktu.style.display = "none";

                    break;
                case 'pertahun':
                    Pertahun.style.display = "flex";
                    Perbulan.style.display = "none";
                    Triwulan.style.display = "none";
                    RentangWaktu.style.display = "none";

                    break;
                case 'rentangWaktu':
                    RentangWaktu.style.display = "flex";
                    Pertahun.style.display = "none";
                    Perbulan.style.display = "none";
                    Triwulan.style.display = "none";
                    break;
                default:
                    break;
            }
        }
        var start = document.getElementById('start');
        var end = document.getElementById('end');

        start.addEventListener('change', function() {
            if (start.value)
                end.min = start.value;
        }, false);
        end.addEventLiseter('change', function() {
            if (end.value)
                start.max = end.value;
        }, false);
   </script>
	
	<script type="text/javascript">
   
			$.ajaxSetup({
					headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
			});
		
			$(".btn-submit").click(function(e){
		
					e.preventDefault();
					var valJangkaWaktu = document.getElementById('jangkaWaktu').value;

					var triwulan = $("select[name=triwulan]").val();
					var perbulan = $("select[name=perbulan]").val();
					var pertahun = $("select[name=pertahun]").val();
					var start = $("input[name=start]").val();
					var end = $("input[name=end]").val();

					switch (valJangkaWaktu) {
							case 'triwulan':
									var tipe = valJangkaWaktu;
									var value = triwulan;
									break;

							case 'perbulan':
									var tipe = valJangkaWaktu;
									var value = perbulan;
									break;
							case 'pertahun':
									var tipe = valJangkaWaktu;
									var value = pertahun;
									break;
							case 'rentangWaktu':
									var tipe = valJangkaWaktu;
									var value = `${start}=${end}`;
									// var value = {
									//     start: start,
									//     end: end
									// };
									break;
							
							default:
									break;
					}
					//  var url = `/laporan/filter/${tipe}/${value}`;
					var url = `/subscription_report/export/${tipe}/${value}`;
					$.ajax({
						type:'GET',
						url:url,
						// data:{tipe: tipe, value:value},
						// datatype: 'json',
						success: function (data, status, xhr) {// success callback function
													console.log('DATA', data);
													
													// $('p').append(data);
													var a = document.createElement("a");
													a.download = "filename.xls";
													a.href = url;
													document.body.appendChild(a);
													a.click();
													// location.href = `/subscription_report/export/${tipe}/${value}`;

									}
					});
					
					// function triggerExport(data){
					// 				var url = `/laporan/filter/${tipe}/${value}`;

					// 				// $.get(url);
					// 				$.ajax(url,   // request url
					// 						{
					// 								url: url,
					// 								method: "POST",
					// 								success: function (data, status, xhr) {// success callback function
					// 										// $('p').append(data);
					// 										// window.location.href = url;
					// 										var a = document.createElement("a");
					// 										a.download = "filename.xls";
					// 										a.href = url;
					// 										document.body.appendChild(a);
					// 										a.click();
					// 										location.href = `/transaksi_laporan/${month}`;

					// 						}
					// 				});
					// }
		
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