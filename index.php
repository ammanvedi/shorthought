<html>
<head>
<link rel="stylesheet" type="text/css" href="ststyle.css">
<link href='http://fonts.googleapis.com/css?family=Rochester' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Alex+Brush' rel='stylesheet' type='text/css'>
<Title>shorthought</Title>

</head>
<body>
<h1>shorthought<span class="dot">.</span></h1>

<div class="searchbar">
<form method="post" action="index.php" enctype="multipart/form-data" >

		  <input class="thoughtbar" type="text" name="thought" id="thought" placeholder="thought..."/>
	      <input class="name" type="text" name="name" id="name" placeholder="name"/>
	      <input class="location" type="text" name="location" id="location" placeholder="location"/>
	      <input class="share" type="submit" name="submit" value="Share!" />

</form>
</div>


<?php
date_default_timezone_set('GMT');
    // DB connection info
    //TODO: Update the values for $host, $user, $pwd, and $db
    //using the values you retrieved earlier from the portal.
    $host = "sql4.freemysqlhosting.net";
    $user = "sql421061";
    $pwd = "gQ3%uN4*";
    $db = "sql421061";
    // Connect to database.
    try {
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch(Exception $e){
        die(var_dump($e));
    }
    // Insert registration info
    if(!empty($_POST)) {
    try {
        $name = $_POST['name'];
        $location = $_POST['location'];
        $created = date("F j, Y, g:i a");
        $thought = $_POST['thought'];
        // Insert data
        $sql_insert = "INSERT INTO thoughts (author, location, created, thought) 
                   VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql_insert);
        $stmt->bindValue(1, $name);
        $stmt->bindValue(2, $location);
        $stmt->bindValue(3, $created);
        $stmt->bindValue(4, $thought);
        $stmt->execute();
    }
    catch(Exception $e) {
        die(var_dump($e));
    }
    echo "<h3>sent!</h3>";
    }
    // Retrieve data
    $sql_select = "SELECT * FROM thoughts ORDER BY rand() LIMIT 1;";
    $stmt = $conn->query($sql_select);
    $registrants = $stmt->fetchAll(); 
    if(count($registrants) > 0) {

        foreach($registrants as $registrant) {
        	echo "<div class=\"thought\"><span class=\"quotemark\"> \" </span>".$registrant['thought']."<span class=\"quotemark\"> \"</span> - ".$registrant['author']."</div>";
         
            echo "<div class=\"details\">from ".$registrant['location']."<br/> on ".$registrant['created']."</div>";
            
            
        }
        
    } else {
        echo "<h3>Need More Statuses, DB empty</h3>";
    }
?>

<a href="https://github.com/ammanvedi/shorthought"><div class="gitlink">view source on github<img src="res/git.png" width="30" height="30" /></div></a>


</body>
</html>