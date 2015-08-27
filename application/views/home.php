<!DOCTYPE html>

<html lang='en'>
    <head>
        <meta charset="utf-8">
        <title>Friends</title>
           <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="../../assets/css/style.css">
    </head>
    <body>
        <div class="container">
            <div style="float: right"><a href="/users/log_off">Log off</a></div>
        	<h3>Hello, <?= $this->session->userdata('user_data')['name'] ?>!</h3>
        	<h5>Here is the list of your friends:</h5>
        	<table class="table table-striped table-bordered friends">
        		<thead>
        			<tr>
        				<th>Alias</th>
        				<th>Action</th>
        			</tr>
        		</thead>
        		<tbody>
<?php 
			if($fri_data)
			{
				foreach($fri_data as $friend)
				{
 ?>
        			<tr>
        				<td><?= $friend['name'] ?></td>
        				<td><a href="/users/profile/<?= $friend['id'] ?>">View Profile</a> <a href="/users/delete_friend/<?= $this->session->userdata('user_id') ?>/<?= $friend['id'] ?>">Remove as Friend</a></td>
        			</tr>
<?php 
				}
			}
			else {
?>
					<tr>
						<td colspan='2'><h5>You don't have friends yet</h5></td>
					</tr>
<?php
				}	
 ?>
        		</tbody>	
        	</table>
        	<br><br><br>
        	<h5>Other Users not on your friend's list:</h5>
        	<table class="table table-striped table-bordered unfriends">
        		<thead>
        			<tr>
        				<th>Alias</th>
        				<th>Action</th>
        			</tr>
        		</thead>
        		<tbody>
<?php 
				foreach($defri_data as $defriend)
				{
 ?>
        		  <form action="/users/add_friend/<?= $this->session->userdata('user_id') ?>/<?= $defriend['id'] ?>" method="post">
        			<tr>
        				<td><a href="/users/profile/<?= $defriend['id'] ?>"><?= $defriend['name'] ?></a></td>
        				<td><input type="submit" value="Add as Friends"></td>
        			</tr>
        		  </form>
<?php 
				}
 ?>
        		</tbody>
        	</table>
        </div>
    </body>
</html>