<?php 
session_start();
include("includes/connection.php");
include("functions/functions.php");
if(!isset($_SESSION['user_email']))
{
	header("location:index.php");
}
else
{


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
				<div id="user_timeline" >
					<div id="user_details">
						<?php
					$user=$_SESSION['user_email'];
                    $get_user="select * from users where user_email='$user'";
                    $run_user=mysqli_query($con,$get_user);
                    $row=mysqli_fetch_array($run_user);
                    $user_id=$row['user_id'];
                    $user_name=$row['user_name'];
                    $user_image=$row['user_image'];
                    $user_country=$row['user_country'];
                    $register_date=$row['register_date'];

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
                      <p><img src='image/message.png' height=32px width=32px><a href='my_messages.php?u_id=$user_id'><strong>Messages($count_msg)</strong></a></p>
                      <p><img src='image/edit.png' height=32px width=32px><a href='my_posts.php?u_id=$user_id'><strong>Posts( $posts)</strong></a></p>
                      <p><img src='image/post.png' height=32px width=32px><a href='edit_profile.php?u_id=$user_id'><strong>Edit Account</strong></a></p>
                      <p><img src='image/logout.png' height=32px width=32px><a href='logout.php'><strong>Logout</strong></a></p>

                    ";
                        ?>
					</div>
				</div>
				<!--user timeline ends-->
				<!--Content timeline starts-->
				<div id="content_timeline">
					
						<img src="image/hand.jpg" width=100% height=220 >

					<div id="about">
						<div id="about1">
							<h2>About us</h2>
                         <p><a href="about.html">About</a></p>
                         <p><a href="about.html">Why knowIT</a></p>
                         <p><a href="about.html">Terms & Condition</a></p>
                          <br></br>
                         <h2>Contact us</h2>
                         <p>
                           Phone_No:+91-9582976197,
                           +91-9438919826</p>
                          <p> E-mail: class@knowIT.com
                           </p>
                           <br></br>
                         <h2>Share with</h2>
                         <p><img src="image/blog.png" width=15px height=20px>   Subcribe to blog</p>
                         <p><img src="image/google.png" width=20px height=23px>  Search on google</p>
                         <p><img src="image/wa.png" width=20px height=20px>   WhatApp</p>
                         <p><img src="image/tweet.png" width=25px height=25px>Follow on twitter</p>
                         <p><img src="image/fb.png" width=22px height=20px>  Facebook</p>

						</div>
					</div>	

				<div id="msg">
					
						<h2>See your messages : <span style='color:slategray;'></span></h2><br>
                       <p align="center"><a href ="my_messages.php?inbox">Inbox</a> ||
                       <a href="my_messages.php?sent">Sent Items</a>
                       </p>
                      <?php 
		if(isset($_GET['sent'])){
		include("send.php");
		}
		?> 
                        
                       <?php
                           if(isset($_GET['inbox'])){
                           
                       ?>

                        <table width='500' align="center">
                        	<tr><th>Sender</th>
                        		<th>Subject</th>
                        		<th>Date</th>
                        		<th>View</th>
                        	</tr>
                        	 <?php
                      $select="select * from messages where receiver='$user_id'  ORDER BY 1 DESC";
                      $run=mysqli_query($con,$select);
                      $count_msg=mysqli_num_rows($run);
                      while($row=mysqli_fetch_array($run))
                      {
                      $msg_id=$row['msg_id'];
                      $msg_sender=$row['sender'];
                      $msg_receiver=$row['receiver'];
                      $msg_sub=$row['msg_sub'];
                      $msg_topic=$row['msg_topic'];
                      $msg_date=$row['msg_date'];
                       
                       $select_sender="select * from users where user_id='$msg_sender'";
                       $run_sender=mysqli_query($con,$select_sender);
                       $row_sender=mysqli_fetch_array($run_sender);
                       $sender_name=$row_sender['user_name'];
                       ?>
                        	<tr><td><?php echo $sender_name; ?></td>
                        		<td><?php echo $msg_sub; ?></a></td>
                        		<td><?php echo $msg_date; ?></td>
                        		<td><form action="my_messages.php?inbox&msg_id=<?php echo $msg_id;?>" method="post" id="f"><input type="submit" name="view" value="View"></form></td>
                        		</tr>
                        	<?php } ?>
                        </table>
                        <?php
                        if (isset($_GET['msg_id']))
                        {
                        	$get_id=$_GET['msg_id'];
                        	$select_msg="select * from messages where msg_id='$get_id'";
                        	$run_msg=mysqli_query($con,$select_msg);
                        	$row_msg=mysqli_fetch_array($run_msg);
                        	$msg_sub=$row_msg['msg_sub'];
                        	$msg_topic=$row_msg['msg_topic'];
                        	$update_read="update messages set status='read' where msg_id='$get_id' ";
                          $run_unread=mysqli_query($con,$update_read);

                        	echo"<center><br><hr>
                        	<h2 align='center'>$msg_sub</h2><br>
                        	<p align='center'><b>Message:</b>$msg_topic</p>
                        	
                               <form action='' method='post'>
                               <textarea  cols ='30' rows='2' name='reply'></textarea><br>
                               <input type='submit' name='msg_reply' value='Reply to this'/>
                               </form>
                               </center>"; }

                                if (isset($_POST['msg_reply']))
                                {
                                  $user_reply=$_POST['reply'];
                                  $update="update  messages set reply=' $user_reply' where msg_id='$get_id'";
                                  $run_update=mysqli_query($con,$update);
                                  if($run_update)
                                  {
                                  	echo"<h2 align='center'>Message was replied</h2>";
                                  }

                                }
                            }

                        ?>
					</div>

                 </div>
				<!--Content timeline ends-->
			</div>
			<!--Content area ends-->
		
	</div>
	<!--Container ends-->

</body>
</html>
<?php } ?>