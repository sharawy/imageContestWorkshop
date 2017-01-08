<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Workshop</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="resources/views/css/bootstrap.min.css" rel="stylesheet">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="http://designshack.net/tutorialexamples/modal-login-jquery/js/jquery.leanModal.min.js"></script>
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="resources/views/css/styles.css" rel="stylesheet">
	</head>
	<body>
<div class="container">
  <div class="row">
<div class="row">

	<div class="col-md-6">
	<a class="btn btn-info" rel="leanModal" href="#uploadmodal">Upload image</a>
  <a class="btn "  href="topusers">Top users</a>
	<a class="btn "  href="admin">Admin</a>
</div>
<div class="regiter-login pull-right">
		<a href="#loginmodal" class="loginbtn flatbtn" rel="leanModal" id="modaltrigger">Login</a>
		<a href="#registermodal" class="registerbtn flatbtn" rel="leanModal" id="modaltrigger">Register</a>
<p id="welcome"></p>
</div>

</div>
		<div class="row" id="listing">


    </div>
    <hr>
		<p id="page_index" class="text-center"></P>
		<nav>
		  <ul class="pager">
		    <li><a id="prev"  href="javascript:void(0);">Previous</a></li>
		    <li><a id="next" href="javascript:void(0)">Next</a></li>
		  </ul>
		</nav>
    <hr>
  </div>
</div>

<div id="loginmodal" style="display:none;">
<a  class="modal_close" href="#"></a>

	<h1>User Login</h1>

	<form  id="loginform" name="loginform" method="post" action="#">
		<label for="email">email:</label>
		<input type="text" name="email" id="email" class="txtfield" tabindex="1">

		<label for="password">Password:</label>
		<input type="password" name="password" id="password" class="txtfield" tabindex="2">

		<div class="center"><input type="submit" name="loginbtn" id="loginbtn" class="flatbtn-blu hidemodal" value="Submit" tabindex="3"></div>
	</form>


</div>
<div id="registermodal" style="display:none;">
	<a  class="modal_close" href="#"></a>

		<h1>User Registration</h1>

		<form  id="registerForm"  name="registerForm" method="post" action="#">
			<label for="full_name">Full name:</label>
			<input type="text" name="full_name" id="full_name" class="txtfield" tabindex="1">

			<label for="password">Password:</label>
			<input type="password" name="password" id="password" class="txtfield" tabindex="2">
			<label for="password">Password confirmation:</label>
			<input type="password" name="password_confirmation" id="password_confirmation" class="txtfield" tabindex="2">
			<label for="email">Email:</label>
			<input type="text" name="email" id="email" class="txtfield" tabindex="3">
			<label for="email">Mobile:</label>
			<input type="text" name="mobile" id="mobile" class="txtfield" tabindex="4">

			<div class="center"><input type="submit" name="loginbtn" id="loginbtn" class="flatbtn-blu hidemodal" value="Log In" tabindex="3"></div>
		</form>
</div>
<div id="uploadmodal" style="display:none;">
<a  class="modal_close" href="#"></a>

	<h1>Upload Image</h1>

	<form  id="uploadform" name="uploadform" method="post" action="#">
		<label for="email">Image:</label>
		<input type="file" id="image_url" name="image_url" tabindex="1"/>
		<label for="name">Title:</label>
		<input type="text" name="name" id="name" class="txtfield" tabindex="2">
		<label for="description">Description:</label>
		<input type="text" name="description" id="description" class="txtfield" tabindex="3">
		<div class="center">
			<input type="submit" name="loginbtn" id="loginbtn" class="flatbtn-blu hidemodal" value="Submit" tabindex="3">
		</div>

	</form>


</div>


	<!-- script references -->

		<script src="resources/views/js/bootstrap.min.js"></script>
		<script src="resources/views/js/scripts.js?id=1"></script>
	</body>
</html>
