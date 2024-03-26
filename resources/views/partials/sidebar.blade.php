<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="{{ asset ('../logo.png') }}" height="50px" width="50px" alt="logo icon">
					
				</div>
				<div>
					<h4 class="logo-text">Sistem DLH</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li class="{{ request()->segment(1) == 'dashboard' ? 'mm-active' : '' }}">
					<a href="/dashboard" >
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>

				<li class="{{ request()->segment(1) == 'driver' ? 'mm-active' : '' }}">
					<a href="{{ route('driver.index') }}" >
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Drivers</div>
					</a>
				</li>

				<li class="{{ request()->segment(1) == 'truck' ? 'mm-active' : '' }}">
					<a href="{{ route('truck.index') }}" >
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Trucks</div>
					</a>
				</li>

				<li class="{{ request()->segment(1) == 'customer' ? 'mm-active' : '' }}">
					<a href="{{ route('customer.index') }}" >
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Customers</div>
					</a>
				</li>
				<li class="{{ request()->segment(1) == 'subscription_report' ? 'mm-active' : '' }}">
					<a href="{{ route('subscription_report.index') }}" >
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Laporan Berlangganan</div>
					</a>
				</li>

				<li class="{{ request()->segment(1) == 'routelist' ? 'mm-active' : '' }}">
					<a href="{{ route('routelist.index') }}" >
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Rute</div>
					</a>
				</li>

				{{-- <li class="{{ request()->segment(1) == 'route-detail' ? 'mm-active' : '' }}">
					<a href="{{ route('route-detail.index') }}" >
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Detail Rute</div>
					</a>
				</li> --}}

				<li class="{{ request()->segment(1) == 'tracking' ? 'mm-active' : '' }}">
					<a href="{{ route('tracking.index') }}" >
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Tracking</div>
					</a>
				</li>
				<li class="{{ request()->segment(1) == 'visit' ? 'mm-active' : '' }}">
					<a href="{{ route('visit.index') }}" >
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Visit</div>
					</a>
				</li>
				{{-- <li class="{{ request()->segment(1) == 'setting' ? 'mm-active' : '' }}">
					<a href="{{ route('setting.index') }}" >
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Setting</div>
					</a>
				</li> --}}
				
				<li class="{{ request()->segment(1) == 'kategori' ? 'mm-active' : '' }}">
					<a href="{{ route('kategori.index') }}" >
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Kategori</div>
					</a>
				</li>

				<li class="{{ request()->segment(1) == 'sub-kategori' ? 'mm-active' : '' }}">
					<a href="{{ route('sub-kategori.index') }}" >
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Sub Kategori</div>
					</a>
				</li>

				<li class="{{ request()->segment(1) == 'user' ? 'mm-active' : '' }}">
					<a href="{{ route('user.index') }}" >
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">User</div>
					</a>
				</li>

				


				

				<li class="menu-label">Keluar Aplikasi</li>
				<li>
					<a href="{{ route('logout.post') }}" >
						<div class="parent-icon"><i class="fadeOut animated bx bx-log-out"></i>
						</div>
						<div class="menu-title">Keluar</div>
					</a>
				</li>
				{{-- <li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
					<ul>
						<li> <a href="index.html"><i class="bx bx-right-arrow-alt"></i>Default</a>
						</li>
						<li> <a href="dashboard-eCommerce.html"><i class="bx bx-right-arrow-alt"></i>eCommerce</a>
						</li>
						<li> <a href="dashboard-analytics.html"><i class="bx bx-right-arrow-alt"></i>Analytics</a>
						</li>
						<li> <a href="dashboard-digital-marketing.html"><i class="bx bx-right-arrow-alt"></i>Digital Marketing</a>
						</li>
						<li> <a href="dashboard-human-resources.html"><i class="bx bx-right-arrow-alt"></i>Human Resources</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Application</div>
					</a>
					<ul>
						<li> <a href="app-emailbox.html"><i class="bx bx-right-arrow-alt"></i>Email</a>
						</li>
						<li> <a href="app-chat-box.html"><i class="bx bx-right-arrow-alt"></i>Chat Box</a>
						</li>
						<li> <a href="app-file-manager.html"><i class="bx bx-right-arrow-alt"></i>File Manager</a>
						</li>
						<li> <a href="app-contact-list.html"><i class="bx bx-right-arrow-alt"></i>Contatcs</a>
						</li>
						<li> <a href="app-to-do.html"><i class="bx bx-right-arrow-alt"></i>Todo List</a>
						</li>
						<li> <a href="app-invoice.html"><i class="bx bx-right-arrow-alt"></i>Invoice</a>
						</li>
						<li> <a href="app-fullcalender.html"><i class="bx bx-right-arrow-alt"></i>Calendar</a>
						</li>
					</ul>
				</li>
				<li class="menu-label">Others</li>
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="bx bx-menu"></i>
						</div>
						<div class="menu-title">Menu Levels</div>
					</a>
					<ul>
						<li> <a class="has-arrow" href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Level One</a>
							<ul>
								<li> <a class="has-arrow" href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Level Two</a>
									<ul>
										<li> <a href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Level Three</a>
										</li>
									</ul>
								</li>
							</ul>
						</li>
					</ul>
				</li>
				<li>
					<a href="https://codervent.com/rukada/documentation/index.html" target="_blank">
						<div class="parent-icon"><i class="bx bx-folder"></i>
						</div>
						<div class="menu-title">Documentation</div>
					</a>
				</li>
				<li>
					<a href="https://themeforest.net/user/codervent" target="_blank">
						<div class="parent-icon"><i class="bx bx-support"></i>
						</div>
						<div class="menu-title">Support</div>
					</a>
				</li> --}}
			</ul>
			<!--end navigation-->
		</div>