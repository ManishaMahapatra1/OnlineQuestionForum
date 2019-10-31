<?php 
session_start();
include("includes/connection.php");
include("functions/functions.php");

if(!isset($_SESSION['user_email'])){
	
	header("location: index.php"); 
}
else {
?>
<!DOCTYPE html> 
<html>
	<head>
		<title>Welcome User!</title> 
	<link rel="stylesheet" href="styles/home_style.css" media="all"/>
	</head> 
	
<body>
	<!--Container starts--> 
	<div class="container">
		<!--Header Wrapper Starts-->
		<div id="head_wrap">
			<!--Header Starts-->
			<div id="logo">
				<img src="image/logo.png" width=190 height=40>
			</div>

			<div id="header">
				<ul id="menu">
					
            <li><a href="home.php"><img src="image/home.png" height='28' width='36'></a></li>
			<li>
			<a href="members.php"><img src="image/mp.png" height='29' width='41'></a>	
			</li>
					
					<strong>Topics:</strong> 
					<?php 
					
					$get_topics = "select * from topics"; 
					$run_topics = mysqli_query($con,$get_topics);
					
					while($row=mysqli_fetch_array($run_topics)){
						
						$topic_id = $row['topic_id'];
						$topic_title = $row['topic_title'];
					
					echo "<li><a href='topic.php?topic=$topic_id'>$topic_title</a></li>";
					}
					
					?>
				</ul>
				<form method="get" action="results.php" id="form1">
					<input type="text" name="user_query" placeholder="Search a topic"/> 
					<input type="submit" name="search" value="Search"/>
				</form>
			</div>
			<!--Header ends-->
		</div><br class="hh">
		<!--Header Wrapper ends-->
			<!--Content area starts-->
			<div class="content">
				<!--user timeline starts-->
				<div id="user_timeline">
					<div id="user_details">
					<?php 
					$user = $_SESSION['user_email'];
					$get_user = "select * from users where user_email='$user'"; 
					$run_user = mysqli_query($con,$get_user);
					$row=mysqli_fetch_array($run_user);
					
					$user_id = $row['user_id']; 
					$user_name = $row['user_name'];
					$user_country = $row['user_country'];
					$user_image = $row['user_image'];
					$register_date = $row['register_date'];
					$last_login = $row['last_login'];
					
					//getting the number of unread messages 
					//$sel_msg = "select * from messages where receiver='$user_id' AND status='unread' ORDER by 1 DESC"; 
					//$run_msg = mysqli_query($con,$sel_msg);		
		
					//$count_msg = mysqli_num_rows($run_msg);
					$user_posts="select * from posts where user_id='$user_id'";
                    $run_posts=mysqli_query($con,$user_posts);
                    $posts=mysqli_num_rows ( $run_posts);
                    $select="select * from messages where receiver='$user_id' AND status='unread' ORDER BY 1 DESC";
                      $run=mysqli_query($con,$select);
                      $count_msg=mysqli_num_rows($run);
					
					
					echo "
					  <p><img src='user/user_image/$user_image' width='160' height='160'/></p>
                      <p><font size=4px><strong>Name:</strong></font> <font color='darkslategray'>$user_name</font></p>
                      <p><font size=4px><strong>Country:</strong></font> <font color='darkslategray'>$user_country</font></p>
                      <p><font size=4px><strong>Member Since:</font></strong> <font color='darkslategray'>$register_date</font></p>
                      <br>
                      <p><img src='image/message.png' height=32px width=32px><a href='my_messages.php?inbox&u_id=$user_id'><strong>Messages($count_msg)</strong></a></p>
                      <p><img src='image/edit.png' height=32px width=32px><a href='my_posts.php?u_id=$user_id'><strong>Posts($posts)</strong></a></p>
                      <p><img src='image/post.png' height=32px width=32px><a href='edit_profile.php?u_id=$user_id'><strong>Edit Account</strong></a></p>
                      <p><img src='image/logout.png' height=32px width=32px><a href='logout.php'><strong>Logout</strong></a></p>

					";
					?>
					</div>
				</div>
				<!--user timeline ends-->
				<!--Content timeline starts-->
				<div id="content_timeline">
					
					<h2>All Registered Users on this Site:</h2><br/>
					
					<?php
					$user_com = $_SESSION['user_email']; 
					$get_members = "select * from users where user_email !='$user_com'"; 
					$run_members = mysqli_query($con,$get_members);
					
					while($row=mysqli_fetch_array($run_members)){
					
					$user_id = $row['user_id']; 
					$user_name = $row['user_name'];
					$user_image = $row['user_image'];
					$user_country=$row['user_country'];
					
					echo "
					<table><tr><td align='center'>
					<p><a href='user_profile.php?u_id=$user_id'>
					<img src='user/user_image/$user_image' width='50' height='50' title='$user_name'/></td>
					<td ><h3><a href='user_profile.php?u_id=$user_id' text decoration='none'>$user_name</a></h3>
					<h5><a href='user_profile.php?u_id=$user_id' text decoration='none'>$user_country</a></h5> 
					</a></p></td></tr></table>
						
					";
					}
		
					?>
				</div>
				<!--Content timeline ends-->
			</div>
			<!--Content area ends-->
		
	</div>
	<!--Container ends-->

</body>
</html>
<?php } ?>