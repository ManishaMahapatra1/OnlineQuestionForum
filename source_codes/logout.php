
 <!DOCTYPE html>
 <html>
 <head>
 	<title> </title>
 </head>
 <body>
<script type="text/javascript">
confirm("Hello, how are you?");
</script>
</body>
</html>
<?php
session_start();
session_destroy();
header("location:index.php" );
?>




