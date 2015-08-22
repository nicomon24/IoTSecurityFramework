<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>OAuth HTTP Proxy</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Le styles -->
		<link href="http://mobdev.ce.unipr.it/2013/css/bootstrap.min.css" rel="stylesheet"/>
		<link href="http://mobdev.ce.unipr.it/2013/css/bootstrap-responsive.css" rel="stylesheet"/>
		
		<style>
			body {
				padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
			}
			.well hr{
				border-top: 1px solid #bbbbbb;
				border-bottom: 1px solid #dddddd;
			}
		</style>
		<link href="http://mobdev.ce.unipr.it/2013/css/bootstrap-responsive.css" rel="stylesheet">

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="../assets/js/html5shiv.js"></script>
		<![endif]-->

		<!-- Fav and touch icons -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
		<link rel="shortcut icon" href="../assets/ico/favicon.png">
		
	</head>

	<body>

		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="brand" href="<?= site_url(); ?>/oaslogon">OAuth HTTP Proxy</a>
					<div class="nav-collapse collapse">
						<ul class="nav">
							<li>
                				<a href="<?= site_url(); ?>/oaslogon">Home</a>
            				</li>
						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</div>
		</div>
		<div class="container"></div>
		<div class="container">			
			<style>
				p.lead{
					margin-bottom: 20px;
				}
				img.icon{
					width: 32px;
				}
			</style>
			
			<span class="lead"><?php echo $heading; ?></span><br/>
			<?php echo $message; ?>
			
			<hr/>
		
			<footer>
				<p>&copy; 2013 - Universit&agrave; degli Studi di Parma</p>
			</footer>
			
        </div>
		<!-- /container -->
		
		<!-- Le javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="http://mobdev.ce.unipr.it/2013/js/jquery.js"></script>
		<script src="http://mobdev.ce.unipr.it/2013/js/bootstrap-transition.js"></script>
		<script src="http://mobdev.ce.unipr.it/2013/js/bootstrap-alert.js"></script>
		<script src="http://mobdev.ce.unipr.it/2013/js/bootstrap-modal.js"></script>
		<script src="http://mobdev.ce.unipr.it/2013/js/bootstrap-dropdown.js"></script>
		<script src="http://mobdev.ce.unipr.it/2013/js/bootstrap-scrollspy.js"></script>
		<script src="http://mobdev.ce.unipr.it/2013/js/bootstrap-tab.js"></script>
		<script src="http://mobdev.ce.unipr.it/2013/js/bootstrap-tooltip.js"></script>
		<script src="http://mobdev.ce.unipr.it/2013/js/bootstrap-popover.js"></script>
		<script src="http://mobdev.ce.unipr.it/2013/js/bootstrap-button.js"></script>
		<script src="http://mobdev.ce.unipr.it/2013/js/bootstrap-collapse.js"></script>
		<script src="http://mobdev.ce.unipr.it/2013/js/bootstrap-carousel.js"></script>
		<script src="http://mobdev.ce.unipr.it/2013/js/bootstrap-typeahead.js"></script>

	</body>
</html>
