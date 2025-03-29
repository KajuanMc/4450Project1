<?php
function drawTrapezoid($top, $bottom, $symbol){
    for($row = $top-1; $row<$bottom; $row++){
        for($x=0;$x<$row+1;$x++){
            echo $symbol;   
        }
        echo "<br>";
    }
}

function showMessage(){
    echo "Hello World";
    echo "<br>";
}

function showImage($weather){
    echo "It is ".$weather."! <br>";
    if($weather == "Freezing"){
        //url of picture
        $image = "/img/Freezing.jpg";
    }elseif($weather == "Cold"){
        $image = "/img/Cold.jpg";
    }
    elseif($weather == "Warm"){
        $image = "/img/Warm.jpg";
    }else{
        $image = "/img/Hot.jpg";
    }
echo "<img src='".$image."' width='500px'>";
}

function test_input($data){
    $data = trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}

?>