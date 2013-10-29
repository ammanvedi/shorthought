
<?php
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