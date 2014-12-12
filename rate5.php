<?php
session_start();
?>

<html>
<head>
<title>rate5</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>

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
?>



<!-- 增加 and 減少 button -->
<form action= "rate5.php" method="post" name="form2" >
<input  name="add" type="submit" value="增加"><p>

<input name="return" type="hidden" value="<?php echo $_POST["return"]; ?>" >
<input name="rate1" type="hidden" value="<?php echo $_POST["rate1"]; ?>" >
<input name="m1" type="hidden" value="<?php echo $_POST["m1"]; ?>" >
<input name="day1" type="hidden" value="<?php echo $_POST["day1"]; ?>" >
</form>




<?php
/* 計算增加及減少 */
if ( $_POST["add"] == "增加"){


?>


歸還：<?php echo $_POST["return"]; ?>元<br>
尚欠：<?php echo $_SESSION["left"]; ?><br>
利率：<?php echo $_POST["rate1"]; ?>%<br>
期數：<?php echo $_POST["m1"]; ?> <br>
還款天數：<?php echo $_POST["day1"]; ?>天<br>
總欠款： <?php echo $_SESSION["fv"]; ?>元<br>
每日利息： <?php echo $_SESSION["intByDay"]; ?>元 <p>


<!--
建立form介面，內容包含
   a. 還款金額
   b. 利率
   c. 還款期數
   d. 預計還款天數
   e. 計算鈕
-->
<form action="rate5.php" method="post" name="form3" >
歸還：<input name="return" type="text" value="">元<br>
利率：<input name="rate1" type="text" value="" >%<br>
期間：<input name="m1" type="text" value="" ><br>
還款天數：<input name="day1" type="text" value="" >天<p>
<input  name="submit1" type="submit" value="計算"><p>

<input name="cost" type="hidden" value="<?php echo $_POST["cost"]; ?>" >
<input name="rate" type="hidden" value="<?php echo $_POST["rate"]; ?>" >
<input name="m" type="hidden" value="<?php echo $_POST["m"]; ?>" >
<input name="day" type="hidden" value="<?php echo $_POST["day"]; ?>" >

</form>

<?php }else{  ?>
  
<?php
//剩餘 = 終職 - 歸還金額
$_SESSION["left"] = $_SESSION["fv"] - $_POST["return"];
//帶入複利工式
$_SESSION["intByDay"] = intByDay($_SESSION["left"], $_POST["rate1"]/100, $_POST["m1"], $_POST["day1"]);
if($_POST["return"]!=""){
	$_SESSION["history"][] = array("cost" => $_POST["return"], "rate" => $_POST["rate1"], "m" => $_POST["m1"], "day" => $_POST["day1"], "fv"=>$_SESSION["fv"], "intByDay"=>$_SESSION["intByDay"]);
}
?>


<!--顯示歸還後計算結果-->
歸還：<?php echo $_POST["return"]; ?>元<br>
尚欠：<?php echo $_SESSION["left"]; ?><br>
利率：<?php echo $_POST["rate1"]; ?>%<br>
期數：<?php echo $_POST["m1"]; ?> <br>
還款天數：<?php echo $_POST["day1"]; ?>天<br>
總欠款： <?php echo $_SESSION["fv"]; ?>元<br>
每日利息： <?php echo $_SESSION["intByDay"]; ?>元 <p>



<!--if ( $_POST["add"] == "增加"){ -->
<?php  }  ?>



<p>
<p>	
<?php
	
	foreach($_SESSION["history"] as $value){
		echo "-------------------<br>";		
		echo "歸還：".$value["cost"]."<br>";
		echo "利率：".$value["rate"]."<br>";
		echo "期數：".$value["m"]."<br>";
		echo "還款天數：".$value["day"]."<br>";
		echo "總欠款：".$value["fv"]."<br>";
		echo "每日利息：".$value["intByDay"]."<br><br><br>";
			
	}
?>
</body>
</html>

