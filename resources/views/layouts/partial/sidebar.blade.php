<div class="sidebar">
	<nav class="mt-2">
		<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
{{-- 			<li class="nav-item has-treeview menu-open">
				<a href="#" class="nav-link active">
					<i class="nav-icon fas fa-tachometer-alt"></i>
					<p>
						Starter Pages
						<i class="right fas fa-angle-left"></i>
					</p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item">
						<a href="#" class="nav-link active">
							<i class="far fa-circle nav-icon"></i>
							<p>Active Page</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link">
							<i class="far fa-circle nav-icon"></i>
							<p>Inactive Page</p>
						</a>
					</li>
				</ul>
			</li> --}}
			<li class="nav-item">
				<a href="{{ url('/') }}" class="nav-link">
					<i class="nav-icon fa fa-tachometer-alt"></i>
					<p>
						Dashboard
					</p>
				</a>
			</li>
			<li class="nav-item has-treeview">
				<a href="#" class="nav-link">
					<i class="nav-icon fas fa-database"></i>
					<p>
						Data Master
						<i class="right fas fa-angle-left"></i>
					</p>
				</a>
				<ul class="nav nav-treeview" style="display: none;">
					<li class="nav-item">
						<a href="" class="nav-link">
							<p>Jabatan</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="" class="nav-link">
							<p>Kantor/Cabang</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="" class="nav-link">
							<p>Jenis Pelanggaran</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="" class="nav-link">
							<p>Persus</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="" class="nav-link">
							<p>Indikator Penilaian</p>
						</a>
					</li>
				</ul>
			</li>
{{-- 			<li class="nav-item">
				<a href="{{ action('MataKuliahController@index') }}" class="nav-link">
					<i class="nav-icon fa fa-book"></i>
					<p>
						Kurikulum
						<span class="right badge badge-danger">New</span>
					</p>
				</a>
			</li>	 --}}
			<li class="nav-item">
				<a href="" class="nav-link">
					<i class="nav-icon fa fa-calendar"></i>
					<p>
						Data Pegawai
						{{-- <span class="right badge badge-danger">New</span> --}}
					</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="" class="nav-link">
					<i class="nav-icon fa fa-calendar"></i>
					<p>
						Proses Resmi
						{{-- <span class="right badge badge-danger">New</span> --}}
					</p>
				</a>
			</li>	
			<li class="nav-item">
				<a href="" class="nav-link">
					<i class="nav-icon fa fa-calendar"></i>
					<p>
						Verifikasi Tugas
						{{-- <span class="right badge badge-danger">New</span> --}}
					</p>
				</a>
			</li>	
			<li class="nav-item">
				<a href="" class="nav-link">
					<i class="nav-icon fa fa-calendar"></i>
					<p>
						Penilaian Pegawai
						{{-- <span class="right badge badge-danger">New</span> --}}
					</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="" class="nav-link">
					<i class="nav-icon fa fa-calendar"></i>
					<p>
						Laporan Pegawai
						{{-- <span class="right badge badge-danger">New</span> --}}
					</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="" class="nav-link">
					<i class="nav-icon fa fa-calendar"></i>
					<p>
						User
						{{-- <span class="right badge badge-danger">New</span> --}}
					</p>
				</a>
			</li>


		</ul>
	</nav>
	<!-- /.sidebar-menu -->
</div>
