<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<title>@yield('title' )</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    @include('admin.layouts.css')
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    @yield('css')
</head>


<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
	<div class="wrapper">
		@include('front.layouts.navbar')

		<div class="main">
			@include('front.layouts.topbar')

			<main class="content">
				<div class="container-fluid p-0">

					@yield('content')

				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a href="https://adminkit.io/" target="_blank" class="text-muted"><strong>AdminKit</strong></a> &copy;
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="#">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Terms</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>
    <script>

        function getData() {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/all-post",
                success:function (allPost){
                    console.log(allPost)
                    let rows = ''
                    $.each(allPost,function (key, value){
                        rows += '<div class="col-md-4">'
                        rows += '<div class="card" style="height: 580px">'
                        rows += '<img class="card-img-top" src="'+ value.image  + '">'
                        // rows += '<img class="card-img-top" src="'+ value.image==null ?  value.image : 'no.jpg' + '">'
                        rows += '<div class="card-header">'
                        rows += '<h5 class="card-title mb-0">'+value.title +'</h5>'
                        rows += '</div>'
                        rows += '<div class="card-body">'
                        rows += '<p class="card-text">' + value.body.replace( /(<([^>]+)>)/ig, '').substring(0,150)+ '</p>'
                        rows += '<a href="/post/' + value.id + '" class="btn btn-primary card-link">Read More</a>'
                        rows += '</div>'
                        rows += '</div>'
                        rows += '</div>'

                    })

                    $('#template').html(rows)
                }
            })
        }


        function notify(message) {
            window.notyf.open({
                type :"default",
                message : message,
                duration : 5000,
                ripple : true,
                dismissible : true,
                position: {
                    x: 'right',
                    y: 'top'
                }
            });
        }
    </script>
@yield('ajax')
@include('admin.layouts.scripts')
@yield('javascript')
</body>

</html>
