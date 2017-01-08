<html><head>
                                <meta charset="utf-8">
                                <meta content="width=device-width, initial-scale=1" name="viewport">
                                <title>Workshop admin</title>
                                <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
                                <script type="text/javascript" charset="utf-8" src="http://designshack.net/tutorialexamples/modal-login-jquery/js/jquery.leanModal.min.js"></script>

                                <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js" type="text/javascript"></script>
                            <link href="resources/views/css/styles.css" rel="stylesheet">
                            <link href="resources/views/css/admin.css" rel="stylesheet">
                            </head>
                            <body>
                            <div class="container">
	<div class="row">
<a style="display:none;" href="#loginmodal" class="loginbtn flatbtn" rel="leanModal" id="modaltrigger">Login</a>
		<section class="content">
			<h1>Images uploade by users</h1>
			<div class="col-md-12 col-md-offset-0">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="pull-right">

						</div>
						<div class="table-container">
							<table class="table table-filter">
								<tbody id="listing">


								</tbody>
							</table>
						</div>

            <nav>
              <p id="page_index" class="text-center"></P>
              <ul class="pager">
                <li><a id="prev"  href="javascript:void(0);">Previous</a></li>
                <li><a id="next" href="javascript:void(0)">Next</a></li>
              </ul>
            </nav>
					</div>
				</div>

			</div>
		</section>

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
<script src="resources/views/js/admin.js"></script>

                        </body></html>
