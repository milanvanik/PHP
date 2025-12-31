<?php
echo"<h1> Hello </h1>";
$arr =["id"=>101, "name"=>"Nayan","percentage"=>89.89,"course"=>"php"];
print_r($arr);
$arr['phone'] = 7894561230;
echo "<br> <br>";

foreach ($arr as $key => $val){
    echo "$key : $val <br>";
}
?>