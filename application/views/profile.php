<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset="utf-8">
        <title><?= $user_data['name']; ?></title>
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="../../assets/css/style.css">
    </head>
    <body>
        <div class="container">
            <br><br>
            <div style="float: right"><a href="/users/log_off">Log off</a></div>
        	<div style="float: right"><a href="/users/home">Home</a></div>
        	<div class="jumbotron">
        		<h2><?= $user_data['name']; ?>'s Profile</h2>
        		<table>
        			<tr>
        				<td>Name:</td>
        				<td><?= $user_data['name']; ?></td>
        			</tr>
        			<tr>
        				<td>Alias:</td>
        				<td><?= $user_data['alias']; ?></td>
        			</tr>
        			<tr>
        				<td>Email Address:</td>
        				<td><?= $user_data['email']; ?></td>
        			</tr>
        		</table>
        	</div>
        </div>
    </body>
</html>