<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset="utf-8">
        <title>Registration/Login</title>
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="../../assets/css/style.css">
  <script>
  $(function() {
    $( "#datepicker" ).datepicker({
      showOn: "button",
      buttonImage: "https://omdeling.info/inc/dhtmlxSuite/imgs/calendar_dis.gif",
      buttonImageOnly: true,
      buttonText: "Select date"
    });
  });
  </script>
    </head>
    <body>
        <div class="container">
        	<br>
        	<div class="jumbotron reg">
        		<h2>Register</h2>
        		<form action="/users/register" method="post">
	        		<table>
	        			<tr>
	        				<td>Name:</td>
	        				<td><input type="text" name="name"></td>
	        			</tr>
	        			<tr>
	        				<td>Alias:</td>
	        				<td><input type="text" name="alias"></td>
	        			</tr>
	        			<tr>
	        				<td>Email Address:</td>
	        				<td><input type="text" name="email"></td>
	        			</tr>
	        			<tr>
	        				<td>Password:</td>
	        				<td><input type="password" name="password"></td>
	        			</tr>
	        			<tr>
	        				<td>Comfirm Password:</td>
	        				<td><input type="password" name="com_password"></td>
	        			</tr>
	        			<tr>
	        				<td>Date of Birth:</td>
	        				<td>
	        					<input type="text" id="datepicker" name="dob"> 
	        				</td>
	        			</tr>
	        			<tr>
	        				<td colspan="2" style="text-align:right"><input type="submit" value="Register"></td>
	        			</tr>
	        		</table>
        		</form>
        		<div style="color:red;"><?= $this->session->flashdata('reg_errors'); ?> </div>
        	</div>
        	<div class="jumbotron log">
        		<h2>Log In</h2>
        		<form action="/users/log_in" method="post">
	        		<table>
	        			<tr>
	        				<td>Email:</td>
	        				<td><input type="text" name="email"></td>
	        			</tr>
	        			<tr>
	        				<td>Password:</td>
	        				<td><input type="password" name="password"></td>
	        			</tr>
	        			<tr>
	        				<td></td>
	        				<td style="text-align:right"><input type="submit" value="Login"></td>
	        			</tr>
	        		</table>
        		</form>
        		<div style="color:red;"><?= $this->session->flashdata('errors'); ?> </div>
        	</div>
        </div>
    </body>
</html>