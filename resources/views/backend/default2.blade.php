<!doctype html>

<!--<html lang="en" class="color-sidebar sidebarcolor7 color-header headercolor8" >-->
 <html lang="en" class="color-sidebar sidebarcolor4 color-header headercolor5">

<head>
	@include('layout.parts._head')
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			@include('layout.parts._sidebar')
		</div>
		<!--end sidebar wrapper -->
		<!--start header -->
		<header>
			@include('layout.parts._topnav')
		</header>
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				@yield('content')
			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		
	
		<footer class="page-footer">
			<p class="mb-0">
			&nbsp;
			</p>
		</footer>
	</div>
	<!--end wrapper-->
	<!--start switcher-->
	<div class="switcher-wrapper">
	
	</div>
	<!--end switcher-->
	<div class="modal fade modal-form-password" tabindex="-1" id="ubahPassword" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_label">Form Tambah KRS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form-horizontal form-label-left" id="formPassword" method="post">
                <div class="modal-body">                
                    @csrf
                                      
                    <div id="error-validation"></div>
                    <div class="row">                       
                        <div class="col-12">
                            <label for="inputEmailAddress" class="form-label"><b>Password</b></label>
                            <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bx-notepad' ></i></span>
                                <input type="password" class="form-control border-start-0" id="password" name="password" placeholder="Masukkan Password" />
                            </div>
                            <label for="password" generated="true" class="error"></label>
                            <label id="validationError"></label>
                        </div>
						
                    </div>
					<div class="row">                       
                        <div class="col-12">
                            <label for="inputEmailAddress" class="form-label"><b>Konfirmasi Password</b></label>
                            <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bx-notepad' ></i></span>
                                <input type="password" class="form-control border-start-0" id="password_confirm" name="password_confirm" placeholder="Masukkan Konfirmasi Password" />
                            </div>
                            <label for="password_confirm" generated="true" class="error"></label>
                            <label id="validationError"></label>
                        </div>
						
                    </div>
                    
                </div>
                <div class="modal-footer">                    
                    <button type="button" id="btn_ubahPassword" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
	@include('layout.parts._scripts')
</body>

</html>
