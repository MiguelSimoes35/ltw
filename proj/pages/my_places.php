<?php
    
    include_once('../includes/session.php');
    include_once('../database/functions.php');

    // username
    $user =  $_SESSION['username'];

    // gets array of reservations
    $places = get_places($user);

    // loops through users places
    for($i = 0; $i < count($places); $i++){
        
        $id = $places[$i]['id'];
    

        echo $places[$i]['title'];
        echo "          ";

        echo $places[$i]['price_day'];
        echo "          ";

        echo $places[$i]['address'];
        echo "          ";

        echo $places[$i]['capacity'];
        echo "";

        echo "<br>";
        
    }
    
?>
<head>
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <div id="places">
        <button id="add-place"><a href="./add_place.php">Add a Place!</button>
    </div>

</body>