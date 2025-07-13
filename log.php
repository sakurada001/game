 <!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ユーザーページ</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="m6-4-2.php"method="post">
        <input type="text"name="name" placeholder="名前"  style="font-size:150%;color: teal;text-align:center;" >
        <input type="submit"name="submit" placeholder="送信"  style="font-size:100%;color: teal;">
    </form>
  <div class="cc-fall">
  <div class="cc-1"></div>
  <div class="cc-2"></div>
  <div class="cc-3"></div>
  <div class="cc-4"></div>
  <div class="cc-5"></div>
  <div class="cc-6"></div>
  </div>
</body>
<?php
$csv=file("2.csv");
$csv = array_reverse($csv);
$a=true;
$csv_array = array();
$score_array = array();
foreach ($csv as $line) {
 $csv_array[] = explode(',', $line);
}
//var_dump($csv_array);
foreach($csv_array as $rank){
    $score_array[] = $rank[1];
   
    }

$score_array= max($score_array);
//$score_array=implode('',$score_array);
//echo $score_array;

foreach($csv_array as $rank) {
    $csv_array[] = $rank[1];
   // $max= max($array);
  //  echo$csv_array;
    echo '名前：'.$rank[0]."&emsp;".'スコア：'.$rank[1]."&emsp;".'日付：'.$rank[2];
    if($score_array==$rank[1]){
        echo "&emsp;"."優勝だよ！";
        
    }
echo "<br>";
        

}

 ?>
