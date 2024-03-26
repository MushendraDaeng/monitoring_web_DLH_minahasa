@extends('partials.layouts')


@section('content')
    <div class="page-wrapper">
			<div class="page-content">

				<div class="row">
					<div class="col-12 col-lg-12 col-xl-6">
						<div class="row row-cols-1 row-cols-lg-2">
							<div class="col">
									<div class="card radius-10 overflow-hidden">
										<div class="card-body">
											<div class="font-35 text-warning"><i class='bx bx-group'></i></div>
											<h3 class="mb-0 mt-0">{{ $customer }}</h3>
											<p class="mb-0">Customer</p>
										</div>
										<div id="emp-nps" style="padding-bottom: 5%"></div>
									</div>
							</div>
							<div class="col">
								<div class="card radius-10 overflow-hidden">
									<div class="card-body">
										<div class="font-35 text-primary"><i class='bx bx-bus'></i></div>
										<h3 class="mb-0 mt-0">{{ $truck }}</h3>
										<p class="mb-0 mt-1">Truck</p>
									</div>
									<div id="trucks" style="padding-bottom: 5%"></div>
									</div>
							</div>
						</div>
				
						<div class="row row-cols-1 row-cols-lg-2">
							
							<div class="col">
								<div class="card radius-10 overflow-hidden">
									<div class="card-body">
										<div class="font-35 text-success"><i class='bx bxs-face'></i></div>
										<h3 class="mb-0 mt-0">{{ $driver }}</h3>
										<p class="mb-1">Driver</p>
									</div>
									<div id="drivers" style="padding-bottom: 5%"></div>
									</div>
							</div>

							<div class="col">
								<div class="card radius-10 overflow-hidden">
									<div class="card-body">
										<div class="font-35 text-danger"><i class='lni lni-road'></i></div>
										<h3 class="mb-0 mt-0">{{ $route }}</h3>
										<p class="mb-0 mt-1">Rute</p>
									</div>
									<div id="routes" style="padding-bottom: 5%"></div>
								</div>
							</div>
						</div>
			 
					</div>
			 
						<div class="col-12 col-lg-12 col-xl-6">
							<div class="card radius-10">
								<div class="card-body">
									<div id="laporan-berlangganan"></div>
								</div>
							</div>
							<div class="card radius-10">
								<div class="card-body">
									<div id="users-status"></div>
								</div>
							</div>
						</div>
			 
				  </div><!--end row-->
			   
				  {{-- <div class="row">
						<div class="col-12 col-lg-8 col-xl-8">
							<div class="card radius-10 overflow-hidden">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<h6 class="mb-0">Recruitment Costs</h6>
										</div>
										<div class="font-22 ms-auto"><i class='bx bx-dots-horizontal-rounded'></i>
									</div>
									</div>
										<div class="chart-container">
										<div id="recruitment-cost"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-12 col-lg-4 col-xl-4">
								<div class="card radius-10">
									<div class="card-body">
										<div class="d-flex align-items-center">
											<div>
												<h6 class="mb-0">Applications By Source</h6>
											</div>
											<div class="font-22 ms-auto"><i class='bx bx-dots-horizontal-rounded'></i>
											</div>
										</div>
										<div class="chart-container d-flex align-items-center justify-content-center mt-3">
											<div id="application-by-source"></div>
										</div>
									</div>
							</div>
						</div>
					</div> --}}
					
					<!--end row-->
			   
				  {{-- <div class="row">
						<div class="col-12 col-lg-4 col-xl-4">
							<div class="card radius-10">
							<div class="card-body">
								<div class="d-flex align-items-center">
								<div class="">
								<h3 class="mt-3 mb-0">54</h3>
									<p class="mb-0">Screening Calls</p>
								</div>
								<div class="card-content dash-array-chart-box ms-auto">
									<div id="screening-calls"></div>
								</div>
								</div>
							</div>
							</div>
							<div class="card radius-10">
							<div class="card-body">
								<div class="d-flex align-items-center">
								<div class="">
								<h3 class="mt-3 mb-0">82</h3>
									<p class="mb-0">Assignments</p>
								</div>
								<div class="card-content dash-array-chart-box ms-auto">
									<div id="assignments"></div>
								</div>
								</div>
							</div>
							</div>
							<div class="card radius-10">
							<div class="card-body">
								<div class="d-flex align-items-center">
								<div class="">
								<h3 class="mt-3 mb-0">92</h3>
									<p class="mb-0">Interviews</p>
								</div>
								<div class="card-content dash-array-chart-box ms-auto">
									<div id="interviews"></div>
								</div>
								</div>
							</div>
							</div>
						</div>
						<div class="col-12 col-lg-4 col-xl-4">
							<div class="card radius-10">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<h6 class="mb-0">Vacancies Status</h6>
									</div>
									<div class="font-22 ms-auto"><i class='bx bx-dots-horizontal-rounded'></i>
									</div>
								</div>
								<div class="text-center chart-container-9 d-flex align-items-center justify-content-center">
								<div id="vacancies-status"></div>
								</div>
							</div>
							<div class="card-footer bg-transparent border-top">
							<div class="row align-items-center text-center">
								<div class="col border-end">
								<h4 class="mb-0">452</h4>
								<small class="extra-small-font">Filled Vacancies</small>
							</div>
								<div class="col">
								<h4 class="mb-0">680</h4>
								<small class="extra-small-font">Total Vacancies</small>
							</div>
							</div>
							</div>
							</div>
						</div>
					
				  </div><!--end row--> --}}

			</div>
		</div>
@endsection

@push('addons-script')
		{{-- <script src="{{ asset ('../rukada/vertical/assets/js/dashboard-human-resources.js') }}"></script> --}}
		
		<script>
			console.log('CUST_PERBLN', {!! json_encode($customerPerBulan) !!});
		
		

		var data = {!! json_encode($customerPerBulan) !!}
    // chart 9

    var options1 = {
						chart: {
								type: "area",
								height: 110,
								sparkline: {
										enabled: true,
								},
						},
						
						dataLabels: {
								enabled: false,
						},
						fill: {
								type: "gradient",
								gradient: {
										shade: "light",
										//gradientToColors: [ '#00c8ff'],
										shadeIntensity: 1,
										type: "vertical",
										opacityFrom: 0.7,
										opacityTo: 0.2,
										stops: [0, 100, 100, 100],
								},
						},
						colors: ["#fb6340"],
						series: [
								{
										name:"Total",
										data: data.map((v) => v.value ),
								},
						],
						xaxis: {
								type: "month",
								categories: data.map((v) => v.month),
						},
						yaxis: {
								axisBorder: {
										show: false,
								},
								axisTicks: {
										show: false,
								},
								labels: {
										show: false,
										formatter: function (val) {
												return parseInt(val);
										},
								},
						},
						stroke: {
								width: 2.5,
								curve: "smooth",
								dashArray: [0],
						},
						tooltip: {
								theme: "dark",
								fixed: {
										enabled: false,
								},
								x: {
										format: "dd/MM/yy HH:mm",
								},
						},
		};
		new ApexCharts(document.querySelector("#emp-nps"), options1).render();

		var data = {!! json_encode($truckPerBulan) !!}
		var options1 = {
						chart: {
								type: "area",
								height: 110,
								sparkline: {
										enabled: true,
								},
						},
						
						dataLabels: {
								enabled: false,
						},
						fill: {
								type: "gradient",
								gradient: {
										shade: "light",
										//gradientToColors: [ '#00c8ff'],
										shadeIntensity: 1,
										type: "vertical",
										opacityFrom: 0.7,
										opacityTo: 0.2,
										stops: [0, 100, 100, 100],
								},
						},
						colors: ["#0072ff"],
						series: [
								{
										name:"Total",
										data: data.map((v) => v.value ),
								},
						],
						xaxis: {
								type: "month",
								categories: data.map((v) => v.month),
						},
						yaxis: {
								axisBorder: {
										show: false,
								},
								axisTicks: {
										show: false,
								},
								labels: {
										show: false,
										formatter: function (val) {
												return parseInt(val);
										},
								},
						},
						stroke: {
								width: 2.5,
								curve: "smooth",
								dashArray: [0],
						},
						tooltip: {
								theme: "dark",
								fixed: {
										enabled: false,
								},
								x: {
										format: "dd/MM/yy HH:mm",
								},
						},
		};
		
		
		new ApexCharts(
        document.querySelector("#trucks"),
        options1
    ).render();
		// console.log('Data', data);

		var data = {!! json_encode($driverPerBulan) !!}
		var options1 = {
						chart: {
								type: "area",
								height: 110,
								sparkline: {
										enabled: true,
								},
						},
						
						dataLabels: {
								enabled: false,
						},
						fill: {
								type: "gradient",
								gradient: {
										shade: "light",
										//gradientToColors: [ '#00c8ff'],
										shadeIntensity: 1,
										type: "vertical",
										opacityFrom: 0.7,
										opacityTo: 0.2,
										stops: [0, 100, 100, 100],
								},
						},
						colors: ["#2dce89"],
						series: [
								{
										name:"Total",
										data: data.map((v) => v.value ),
								},
						],
						xaxis: {
								type: "month",
								categories: data.map((v) => v.month),
						},
						yaxis: {
								axisBorder: {
										show: false,
								},
								axisTicks: {
										show: false,
								},
								labels: {
										show: false,
										formatter: function (val) {
												return parseInt(val);
										},
								},
						},
						stroke: {
								width: 2.5,
								curve: "smooth",
								dashArray: [0],
						},
						tooltip: {
								theme: "dark",
								fixed: {
										enabled: false,
								},
								x: {
										format: "dd/MM/yy HH:mm",
								},
						},
				};

		new ApexCharts(
        document.querySelector("#drivers"),
        options1
    ).render();

		var data = {!! json_encode($routePerBulan) !!}
		var options1 = {
						chart: {
								type: "area",
								height: 110,
								sparkline: {
										enabled: true,
								},
						},
						
						dataLabels: {
								enabled: false,
						},
						fill: {
								type: "gradient",
								gradient: {
										shade: "light",
										//gradientToColors: [ '#00c8ff'],
										shadeIntensity: 1,
										type: "vertical",
										opacityFrom: 0.7,
										opacityTo: 0.2,
										stops: [0, 100, 100, 100],
								},
						},
						colors: ["#f5365c"],
						series: [
								{
										name:"Total",
										data: data.map((v) => v.value ),
								},
						],
						xaxis: {
								type: "month",
								categories: data.map((v) => v.month),
						},
						yaxis: {
								axisBorder: {
										show: false,
								},
								axisTicks: {
										show: false,
								},
								labels: {
										show: false,
										formatter: function (val) {
												return parseInt(val);
										},
								},
						},
						stroke: {
								width: 2.5,
								curve: "smooth",
								dashArray: [0],
						},
						tooltip: {
								theme: "dark",
								fixed: {
										enabled: false,
								},
								x: {
										format: "dd/MM/yy HH:mm",
								},
						},
				};

		new ApexCharts(
        document.querySelector("#routes"),
        options1
    ).render();

		var data = {!! json_encode($laporanBerlanggananPerBulan) !!}
		let rupiahFormat = Intl.NumberFormat('id-ID');
		console.log('DATA', data);
		var options = {
        chart: {
            height: 310,
            type: "bar",
            toolbar: {
                show: false,
            },
        },
        plotOptions: {
            bar: {
                columnWidth: "50%",
                endingShape: "rounded",
                dataLabels: {
                    position: "top", // top, center, bottom
                },
            },
        },
        dataLabels: {
            enabled: false,
            formatter: function (val) {
                return parseInt(val);
            },
            offsetY: -20,
            style: {
                fontSize: "14px",
                colors: ["#304758"],
            },
        },
        stroke: {
            width: 0,
        },
        series: [
            {
                name: "Total",
                data: data.map((v) => v.value),
            },
        ],
        xaxis: {
            categories: data.map((v) => v.month),
            position: "bottom",
            labels: {
                offsetY: 0,
            },
            axisBorder: {
                show: true,
            },
            axisTicks: {
                show: true,
            },
        },
        tooltip: {
            enabled: true,
            theme: "dark",
        },
        grid: {
            show: true,
            borderColor: "rgba(66, 59, 116, 0.15)",
        },
        fill: {
            type: "gradient",
            gradient: {
                shade: "dark",
                gradientToColors: ["#08a50e"],
                shadeIntensity: 1,
                type: "vertical",
                inverseColors: false,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100, 100, 100],
            },
        },
        colors: ["#cddc35"],
        yaxis: {
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
            labels: {
                show: false,
                formatter: function (val) {
                    return `Rp.${rupiahFormat.format(parseInt(val))  }`;
                },
            },
        },
        title: {
            text: "Laporan Berlangganan tiap bulan, {{ date("Y") }}",
            floating: true,
            offsetY: 0,
            align: "center",
            style: {
                fontSize: "15px",
                color: "#444",
            },
        },
        responsive: [
            {
                breakpoint: 480,
                options: {
                    chart: {
                        height: 310,
                    },
                    legend: {
                        position: "bottom",
                    },
                    title: {
                        text: "Monthly Application Submitions, 2018",
                        floating: true,
                        offsetY: 0,
                        align: "center",
                        style: {
                            fontSize: "13px",
                            color: "#444",
                        },
                    },
                },
            },
        ],
    };

    var chart = new ApexCharts(
        document.querySelector("#laporan-berlangganan"),
        options
    ).render();


		var data = {!! json_encode($totalPerBulanBerlangganan) !!}
		var data1 = {!! json_encode($totalPerBulanTidakBerlangganan) !!}

		console.log('DATA', data, 'DATA1', data1)

		var options = {
		series: [{
			name: 'Berlangganan',
			data: data.map((v) => v.total)
		}, {
			name: 'Berhenti Berlangganan',
			data: data1.map((v) => v.total)
		}],
		chart: {
			foreColor: '#9ba7b2',
			type: 'bar',
			height: 360
		},
		plotOptions: {
			bar: {
				horizontal: false,
				columnWidth: '55%',
				endingShape: 'rounded'
			},
		},
		dataLabels: {
			enabled: false
		},
		stroke: {
			show: true,
			width: 2,
			colors: ['transparent']
		},
		title: {
			text: 'Total Berlangganan & Berhenti berlangganan',
			align: 'left',
			style: {
				fontSize: '14px'
			}
		},
		colors: ["#23bd7b", '#5e72e4', '#f5365c'],
		xaxis: {
			categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul",'Ags', 'Sept', 'Okt', 'Nov', 'Des'],
		},
		// yaxis: {
		// 	title: {
		// 		text: ''
		// 	}
		// },
		fill: {
			opacity: 1
		},
		tooltip: {
			y: {
				formatter: function (val) {
					return val 
				}
			}
		}
	};
	var chart = new ApexCharts(document.querySelector("#users-status"), options).render();
	// chart.render();

		// var options = {
    //     chart: {
		// 			foreColor: '#9ba7b2',
		// 			height: 360,
		// 			type: 'line',
		// 			zoom: {
		// 				enabled: false
		// 			},
		// 			dropShadow: {
		// 				enabled: true,
		// 				top: 3,
		// 				left: 2,
		// 				blur: 4,
		// 				opacity: 0.1,
		// 			}
		// 		},
    //     plotOptions: {
    //         bar: {
    //             columnWidth: "10%",
    //             endingShape: "rounded",
    //             dataLabels: {
    //                 position: "top", // top, center, bottom
    //             },
    //         },
    //     },
    //     dataLabels: {
    //         enabled: false,
    //     },
    //     stroke: {
    //         width: 5,
    //         curve: "smooth",
    //     },
    //     series: [
    //         {
    //             name: "Berlangganan",
    //             data: data.map((v) => v.value),
    //         },
    //         {
    //             name: "Berhenti Berlangganan",
    //             data: data1.map((v) => v.value),
    //         },
    //     ],

    //     xaxis: {
    //         type: "month",
    //         categories: data.map((v) => v.month),
    //     },
    //     yaxis: {
    //         axisBorder: {
    //             show: false,
    //         },
    //         axisTicks: {
    //             show: false,
    //         },
    //         labels: {
    //             show: false,
    //             formatter: function (val) {
    //                 return parseInt(val);
    //             },
    //         },
    //     },
    //     // fill: {
    //     //     type: "gradient",
    //     //     gradient: {
    //     //         shade: "light",
    //     //         gradientToColors: ["#e100ff", "#00c8ff"],
    //     //         shadeIntensity: 1,
    //     //         type: "vertical",
    //     //         opacityFrom: 1,
    //     //         opacityTo: 1,
    //     //         stops: [0, 80, 100],
    //     //     },
    //     // },
    //     colors: ["#ff6258", "#0072ff"],
    //     legend: {
    //         show: !0,
    //         position: "top",
    //         horizontalAlign: "left",
    //         offsetX: -20,
    //         fontSize: "12px",
    //         markers: {
    //             radius: 50,
    //             width: 10,
    //             height: 10,
    //         },
    //     },
    //     grid: {
    //         show: true,
    //         borderColor: "rgba(66, 59, 116, 0.12)",
    //     },
    //     tooltip: {
    //         theme: "dark",
    //         x: {
    //             format: "dd/MM/yy HH:mm",
    //         },
    //     },
    //     responsive: [
    //         {
    //             breakpoint: 480,
    //             options: {
    //                 chart: {
    //                     height: 300,
    //                 },
    //                 legend: {
    //                     offsetX: -20,
    //                     fontSize: "12px",
    //                 },
    //             },
    //         },
    //     ],
    // };

    // var chart = new ApexCharts(
    //     document.querySelector("#users-status"),
    //     options
    // ).render();

		</script>

		<script>
			let existNotif = '{{ Session::has('success') }}'
			let msgSuccesNotif = '{{ Session::get('success') }}';
			let msgDeleteNotif = '{{ Session::get('deleted') }}';
			let existDeleteNotif = '{{ Session::has('deleted') }}'


			// let comp = document.getElementById("page-wrapper");
			// console.log('comp', msgSuccesNotif);

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