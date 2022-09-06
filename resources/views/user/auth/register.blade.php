
<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com/">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="pages-sign-up.html" />

	<title>Sign Up | AdminKit Demo</title>

	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&amp;display=swap" rel="stylesheet">


	<link class="js-stylesheet" href="{{asset('/admin/assets')}}/css/light.css" rel="stylesheet">

	<!-- END SETTINGS -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-120946860-10"></script>

</head>


<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
	<main class="d-flex w-100 h-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Get started</h1>
							<p class="lead">
								Start creating the best possible user experience for you customers.
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<form action="{{ route('user.register') }}" method="post">
                                        @csrf
										<div class="mb-3">
											<label class="form-label">Name</label>
											<input name="name" class="form-control form-control-lg" type="text" name="name" placeholder="Enter your name" />
                                            <span class="text-danger">{{$errors->has('name') ? $errors->first('name') : '' }}</span>
										</div>
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input name="email" class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email" />
                                            <span class="text-danger">{{$errors->has('email') ? $errors->first('email') : '' }}</span>
                                        </div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input name="password" class="form-control form-control-lg" type="password" name="password" placeholder="Enter password" />
                                            <span class="text-danger">{{$errors->has('password') ? $errors->first('password') : '' }}</span>
									
                                        </div>
										<div class="text-center mt-3">
											<button type="submit" class="btn btn-lg btn-primary">Sign up</button>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="{{asset('/admin/assets')}}/js/app.js"></script>


@if (Session::has('message'))
    <script>
         window.notyf.open({
					type :"default",
					message : "{{ Session::get('message') }}",
					duration : 5000,
					ripple : true,
					dismissible : true,
					position: {
						x: 'right',
						y: 'top'
					}
				});
    </script>
@elseif(Session::has('error'))
    <script>
         window.notyf.open({
					type :"danger",
					message : "{{ Session::get('error') }}",
					duration : 5000,
					ripple : true,
					dismissible : true,
					position: {
						x: "right",
						y: "top",
					}
				});
    </script>
@endif

</body>


<!-- Mirrored from demo.adminkit.io/pages-sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 21 Jul 2022 16:16:39 GMT -->
</html>