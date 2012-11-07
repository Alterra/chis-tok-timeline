<html>
<head>
	<!-- Page Title -->
	<title>Timeline</title>
	<!-- CSS -->
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="stylesheets/styles.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="stylesheets/jquery.sliding-menu.css" type="text/css" media="screen" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
	<script type="text/javascript" src="javascripts/jquery.sliding-menu.js"></script>
	<script type="text/javascript">
	jQuery(function(){
	  jQuery('#HorizontalSlidingMenu .SlidingMenu').slidingMenu();
	  jQuery('#VerticalSlidingMenu .SlidingMenu').slidingMenu({ initialOpacity: 0.5 });
	});
	</script>
</head>
<body>
	<center>
	<div id="wrapper">
		<div id="header">
		<img src="images/timeline.png">
		</div>
		<div id="HorizontalSlidingMenu">
			<ul class="SlidingMenu Horizontal">
			  <center>
			  <li><a href="index.php?page=1">Home</a></li>
			  <li><a href="index.php?page=2">Add Content</a></li>
			  <li><a href="index.php?page=3">Delete Content</a></li>
			  </center>
			</ul>
			<div class="ClearFix">
			</div>
		</div>
		<div id="container">
   		<?php        
		/*
		* Author: Aditya Jain
		* Design & Concept: Joni Siiriainen
		*/
		
		//Connect to the mysql server
		include 'include/connect.php';	
		//Obtain the variable 'page' from the URL.
		$page = @$_GET['page'];                                                                         		
		
		//Main Pages
		if ($page==''||$page=='1')                                                                      		
		{     
		//Logic of time is stupid hence, only two tables for a descending bc and an ascending bc, jesus christ... literally.
		$query = mysql_query("select * from `timeline` order by `year` asc");                           		
		$query2 = mysql_query("select * from `timeline_bc` order by `year` desc");   
			//While LOOP. Lol igcse cst.
			while ($row2 = mysql_fetch_assoc($query2))                                                  		
			{                                                                                           		
			$year = $row2['year'];                                                                      		
			$suffix = $row2['suffix'];                                                                  		
			$invention = $row2['invention'];                                                            		
			$desc = $row2['desc'];                                                                      		
			echo "<h2>$year&nbsp;$suffix</h2>";                                                         		
			echo "<h3>$invention</h3>";                                                                 		
			echo "<p>$desc</p>";                                                                        		
			echo "<br><br>";                                                                            	
			}                                                                                           	
			while ($row = mysql_fetch_assoc($query))                                                    	
			{                                                                                           	
			$year = $row['year'];                                                                       	
			$suffix = $row['suffix'];                                                                   	
			$invention = $row['invention'];                                                             	
			$desc = $row['desc'];                                                                       	
			echo "<h2>$year&nbsp;$suffix</h2>";                                                         	
			echo "<h3>$invention</h3>";                                                                 	
			echo "<p>$desc</p>";                                                                        	
			echo "<br><br>";                                                                            	
			}                                                                                           	
		}                                                                                               	
		
		//Add Content Page
		if ($page=='2')
		{
		//Todo: Wysiwyg HTML editor form. This is stupid, considering it's for non-html knowing ppl =/
		echo 
		"<form action='index.php?page=2' method='post'>
		Year: <br><input type='text' name='year'><br>
		BC/AD:<br>
		<select name='suffix'>
			<option name='BC'>BC</option>
			<option name='AD'>AD</option>
		</select><br>
		Invention: <br><input type='text' name='invention'><br>
		Description: <br><textarea name='desc' id='new-body' class='minLength maxLength ta reg' validatorprops='{minLength:2,maxLength:4999}'></textarea><br>
		<input type='submit' name='submit'><br>
		</form>";
		$year = mysql_real_escape_string(@$_POST['year']);
		$suffix = mysql_real_escape_string(@$_POST['suffix']);
		$invention = mysql_real_escape_string(@$_POST['invention']);
		$desc = mysql_real_escape_string(@$_POST['desc']);
		$submit = mysql_real_escape_string(@$_POST['submit']);
			if ($submit)
			{
				//Todo: Automatic redirection.
				if ($suffix=='BC')
				{
				$query = "insert into `timeline_bc` (`year`,`suffix`,`invention`,`desc`) values ('$year','BC','$invention','$desc')";
				mysql_query($query) or die (mysql_error());
				echo "$invention added for the time $year BC";
				}
				if ($suffix=='AD')
				{
				$query2 = "insert into `timeline` (`year`,`suffix`,`invention`,`desc`) values ('$year','AD','$invention','$desc')";
				mysql_query($query2) or die (mysql_error());
				echo "$invention added for the time $year AD";
				}
				if ($suffix!='AD'||$suffix!='BC')
				{
				echo "What are you trying to do?!";
				}
			}
		}
		
		//Delete Content
		//ToDo: People restrictions probably could do this easily from a login system for non-morons.
		if ($page=='3')
		{
		echo "<div>";
		$sql = "SELECT `id`, `year`,`suffix`,`invention` FROM `timeline` ORDER BY `year` asc";
		$sql2 = "SELECT `id`, `year`,`suffix`,`invention` FROM `timeline_bc` ORDER BY `year` desc";
		$res = mysql_query($sql) or die (mysql_error());
		$res2 = mysql_query($sql2) or die (mysql_error());
			
			while ($row2 = mysql_fetch_assoc($res2))
			{
			$year = $row2['year'];
			$suffix = $row2['suffix'];
			$invention = $row2['invention'];
			$id = $row2['id'];
			echo "$year $suffix || $invention - <a href=index.php?page=3&id2=$id>Delete</a><br>";
			}
			while($row = mysql_fetch_assoc($res))
			{
			$year = $row['year'];
			$suffix = $row['suffix'];
			$invention = $row['invention'];
			$id = $row['id'];
			echo "$year $suffix || $invention - <a href=index.php?page=3&id=$id>Delete</a><br>";
			}
			if (isset($_REQUEST['id']))
			{
			$id = (int)$_REQUEST['id'];
			$sql = "DELETE FROM `timeline` WHERE `id` =$id";
			mysql_query($sql) or die (mysql_error());
			echo "<br>Invention Deleted Click <a href='index.php?page=1'>Here</a> To Return";
			}
			if (isset($_REQUEST['id2']))
			{
			$id = (int)$_REQUEST['id2'];
			$sql = "DELETE FROM `timeline_bc` WHERE `id` =$id";
			mysql_query($sql) or die (mysql_error());
			echo "<br>Invention Deleted Click <a href='index.php?page=1'>Here</a> To Return";
			}
		}
		?>
		</div>
		<hr>
		<div id="footer">
		Written By Aditya Jain. Design &amp; Concept By Joni Siiriainen © 2012 All Rights Reserved.
		</div>
	</div>
	</center>
</body>
</html>