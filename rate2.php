<?php
session_start();
?>

<html>
<head>
<title>rate2</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>

<!-- 增加 and 減少 button -->
<form action= "rate5.php" method="post" name="form2" >
<input  name="add" type="submit" value="增加">


<input name="cost" type="hidden" value="<?php echo $_POST["cost"]; ?>" >
<input name="rate" type="hidden" value="<?php echo $_POST["rate"]; ?>" >
<input name="m" type="hidden" value="<?php echo $_POST["m"]; ?>" >
<input name="day" type="hidden" value="<?php echo $_POST["day"]; ?>" >
</form>

<?php
$_SESSION["item"]=0;
?>

<?php
/*
將輸入值帶入"利息計算函數“做計算，得到每日利息”
     利息計算(){
         終值= 借款金額 ＊ pow（(1+利率),借款期數）
         利息= 終值-借款金額
         每日利息 = 利息/預計還款天數
         return 每日利息;
     }
*/

global $fv;

function intByDay($cost, $rate, $m, $day){
    global $fv;
    $fv = $cost * pow((1+$rate), $m);
    $interest = $fv - $cost;
    $intByDay = $interest/$day;
    $_SESSION["fv"] = $fv;
    return $intByDay;
    
}


$_SESSION["intByDay"] = intByDay($_POST["cost"], $_POST["rate"]/100, $_POST["m"], $_POST["day"]);

if($_POST["cost"]!=""){
	$_SESSION["history"][] = array("cost" => $_POST["cost"], "rate" => $_POST["rate"], "m" => $_POST["m"], "day" => $_POST["day"], "fv"=>$_SESSION["fv"], "intByDay"=>$_SESSION["intByDay"]);
}
?>


<!-- 將計算結果的每日利息顯示出來  -->
借款：<?php echo $_POST["cost"]; ?>元<br>
利率：<?php echo $_POST["rate"]; ?>%<br>
期數：<?php echo $_POST["m"]; ?> <br>
還款天數：<?php echo $_POST["day"]; ?>天<br>
總欠款： <?php echo $_SESSION["fv"]; ?>元<br>
每日利息： <?php echo $_SESSION["intByDay"]; ?>元 <p>



</body>
</html>

