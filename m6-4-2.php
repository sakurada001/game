<!DOCTYPE html>

<html lang="ja">
    
<head>
    <meta charset="UTF-8">
    <title>数あてゲーム</title>
      <style>
    .fuwafuwa {
      animation: fuwafuwa 3s ease-in-out infinite alternate;
      background: url(./SUNSHIN.png) no-repeat center center / 60px auto;
      display: inline-block;
      transition: 1.5s ease-in-out;
      width: 25px;
      height: 120px;
      margin-top: 15px;
    }

    @keyframes fuwafuwa {
      0% {
        transform: translate(0, 0) rotate(-7deg);
      }
      50% {
        transform: translate(0, -7px) rotate(0deg);
      }
      100% {
        transform: translate(0, 0) rotate(7deg);
      }
    }
  </style>
</head>
<body>
     
    <h4>ルール説明:このゲームは、４桁の数字を当てるゲームです！(2941,0123など)</h4>
    <h4>おしい：使ってる数字も位置もあってる、すこし：使ってる数字はあってるけど答えが違う</h4>
    <h4>例：答えが「1234」の時入力が「1324」場合は、おしい2、すこし2になります！</h4>
    <h4>ヒントを使いたいときは、ローマ字を入力してね</h4>
    <h4>行動するごとにドリンクを消費します。()の個数ドリンクを消費するよ！初期ドリンク７０個！</h5>
    <h6>(条件を満たすとがドリンク増えるかも。。？)</h6>
    <h4>注意点：同じ数字は使わない、１０００の位に０になっている可能性がある、半角入力推奨！</h4>
   
    <form action=""method="post">
        <input type="text"name="num" placeholder="回答" span style="font-size:150%;text-align:center;color: teal;" >
        <input type="text"name="hint" placeholder="ヒント" span style="font-size:150%;text-align:center;color: teal;">
        <input type="submit"name="submit" placeholder="送信" span style="font-size:100%;color: teal;">
        <!--  <input type="submit"name="re" placeholder="リ" span style="font-size:150%;color: teal;"> -->
    </form>
    
<?php
//$start_time = Time.now;
    
    session_start();
    
    if(isset($_SESSION['ans'])) {
        $ans = $_SESSION['ans'];
    }else{
        $numbers = [0,1,2,3,4,5,6,7,8,9];
        shuffle($numbers);
        $ans = array_slice($numbers, 0, 4);
        $_SESSION['ans'] = $ans;
       // $ans = $_SESSION['ans'];
    }
    //echo "正解は$ans";
    if(isset($_SESSION['oshi'])) {
        $oshi = $_SESSION['oshi'];
    }else {
        $oshi = 0;
        $_SESSION['oshi'] = $oshi;
       // $oshi= $_SESSION['oshi'];
    }
    if(isset($_SESSION['sukoshi'])) {
        $sukoshi = $_SESSION['sukoshi'];
    }else {
        $sukoshi = 0;
        $_SESSION['sukoshi'] = $sukoshi;
      //  $sukoshi= $_SESSION['sukoshi'];
    }
    if(isset($_SESSION['score'])) {
        $score = $_SESSION['score'];
    }else {
        $score = 70;
        $_SESSION['score'] = $score;
       // $score= $_SESSION['score'];
    }
    if(isset($_SESSION['f_zorome'])) {
        $f_zorome = $_SESSION['f_zorome'];
    }else {
        $f_zorome = true;
        $_SESSION['f_zorome'] = $f_zorome;
      //  $f_zorome= $_SESSION['f_zorome'];
    }
    if(isset($_SESSION['log'])) {
        $log = $_SESSION['log'];
    }else {
        $log=[];
        $_SESSION['log'] = $log;
      //  $log= $_SESSION['log'];
    }

    if(isset($_SESSION['fa'])) {
        $fa = $_SESSION['fa'];
    }else {
        $fa = true;
        $_SESSION['fa'] = $fa;
       // $fa= $_SESSION['fa'];
    }
    if(isset($_SESSION['fb'])) {
        $fb = $_SESSION['fb'];
    }else {
        $fb= true;
        $_SESSION['fb'] = $fb;
     //   $fb= $_SESSION['fb'];
    }
    if(isset($_SESSION['hint'])) {
        $hint= $_SESSION['hint'];
    }else {
        $hint='';
        $_SESSION['hint'] = $hint;
        //$hint= $_SESSION['hint'];
    }
     if(isset($_SESSION['hin'])) {
        $hin = $_SESSION['hin'];
    }else {
        $hin='';
        $_SESSION['hin'] = $hin;
        //$hin= $_SESSION['hin'];
    }
    if(isset($_SESSION['show'])) {
        $show = $_SESSION['show'];
    }else {
        $show=false;
        $_SESSION['show'] = $show;
    }
    if(empty($_POST["name"])) {
        $name = $_SESSION['name'];
    }else {
        $name=$_POST["name"];
        $_SESSION['name'] = $name;   
    }//$show=false;
    $sucuse = true;
 if($show==true){
        $score=70;
        $oshi = 0;
        $sukoshi = 0;
        $f_zorome = true;
        $fa= true;
        $fb= true;
        $log=[];
        $numbers = [0,1,2,3,4,5,6,7,8,9];
        shuffle($numbers);
        $ans = array_slice($numbers, 0, 4);
        $show=false;
    }
    $anss=implode('',$ans);
    $narray2 = []; 
    if (!empty($_POST["hint"])) {
    $hint=$_POST['hint'];
    }
  // echo$name; 
    //echo$anss;
 // echo$hint;
  // echo"現在のスコア：$score<br>";
    if ($score>=10){
    echo "４桁の数を入力をしてください(10)";
    if ($fa or $fb) {
        echo "ヒント";
}    
    if($fa){
        echo "a 偶数・奇数を聞く(5)";
}
     if ($fb){
        echo "b 各桁の合計を聞く(15)";
} 
    
    if($fa && $hint=="a" && $score>4) {
        echo"ヒントを使います";
        if ($ans[3]%2==0){
            $hin="偶数の４桁だよ";
            echo "偶数の４桁だよ";
             array_push($log,"<br>".$hin);
        }else{
            $hin="奇数の４桁だよ";
            print"<br>奇数の４桁だよ";
            array_push($log,"<br>".$hin);
        }
            $score-= 5;
            $fa = false;
    }    
    if($fb && $hint=="b" && $score>14) { 
        echo"ヒントを使います";
        $sum = 0;
        for ($i = 0; $i < 4; $i++ ){
             $sum += $ans[$i];
        }
        $hin="各桁の合計は$sum";    
        echo "各桁の合計は$sum";
        array_push($log,"<br>".$hin);
        $score-=15;
        $fb = false;
    }
    
        
    if(!empty($_POST['num']) ) {        
        $num = $_POST['num'];
        $num = trim($num);
        
       // $hint = ['hint'];
        $sukoshi = 0;
        $oshi = 0;
        switch($num){
            case $score<9;
            echo"スコアがたりません";
            break;

            case $score>9;
            $narray = str_split($num);
            $narray2 =array_unique($narray);
            //is_numericは使えない
            //相談
            if (count($narray)!= 4 or count($narray2) != 4 or ctype_digit($num)==FALSE){ 
                echo "<br>ルールを守っていません";
                $sucuse = false;
                break;
            }
                $score-=10;
                for($i = 0; $i < 4; $i++ ){
                    if ($ans[$i] == $narray[$i]){
                    $oshi+= 1;
                    }
                }
                echo "おしい $oshi ";
            
            foreach($ans as $ansn){
                if (in_array($ansn, $narray)){
                $sukoshi+= 1;
                }
            }
                
            $sukoshi-=  $oshi ;
            if($sukoshi<0){
                $sukoshi=0;
            }
            echo "すこし $sukoshi  残りスコア$score";
                //$score-=10;
            if ($oshi == $sukoshi and $f_zorome){
                echo"ゾロ目だね！おめでとう！スコア+15";
                $score+=15;
                $f_zorome=false;
                }
            }
            if ( $sucuse==true ){
//       var_dump("<br>".$num.$oshi.$sukoshi.$hin);
             array_push($log,"<br>"."&emsp;"."&emsp;".$num." ,"."&emsp;"."&emsp;"."&emsp;"."&emsp;".$oshi.","."&emsp;"."&emsp;".$sukoshi.",".$hin);
            }
        }
    }
      
    $filename="2.csv";
    $logg=implode('',$log);
        if ($oshi==4){
        $show=true;

        echo"正解！スコアは$score";
        $str=[$name.",".$score.",".date("Y/m/d H:i:s").",".$_SERVER['REMOTE_ADDR']];
        $fp=fopen($filename,"a");

        fputcsv($fp, $str);

        fclose($fp);
        }
        
        if($score<10){
        $score=0;
        $show=true;                 // $numm = implode($num);
        echo" <br>不正解！正解は$anss";
        $str=[$name.",".$score.",".date("Y/m/d H:i:s").",".$_SERVER['REMOTE_ADDR']];
        $fp=fopen($filename,"a");

        fputcsv($fp, $str);

        fclose($fp);
        

        }

$_SESSION['ans'] = $ans;
$_SESSION['score'] = $score; 
$_SESSION['oshi'] = $oshi;
$_SESSION['sukoshi'] = $sukoshi;
$_SESSION['f_zorome'] = $f_zorome;
$_SESSION['log'] = $log; 
$hin='';
$num='';
$hint='';
$_SESSION['hin'] = $hin; 
$_SESSION['hint'] = $hint;
$_SESSION['fa'] = $fa;
$_SESSION['fb'] = $fb;
$_SESSION['show'] = $show;
$_SESSION['name'] = $name;
$coment =['<br>入力した数字','おしい','すこし'];
$coments=implode('',$coment);
$fuwafuwa='<div class="fuwafuwa"></div>';
echo'<br>';
for ($i = 0; $i < $score; $i++ ){
        echo$fuwafuwa;;
    }

echo$coments;
echo$logg;
//echo"現在のスコア：$score<br>";
 ?>

<html>
  <!--<div class="fuwafuwa"></div><div class="fuwafuwa"></div> -->
  <?php if ($show): ?>
     <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>

    <script>
      confetti({
        particleCount: 100,
        spread: 70,
        origin: { y: 0.6 }
      });
    </script>
    <a href="https://tech-base.net/tb-270162/m6/log.php" target="_blank">
  <img src="ccrog.png" alt="リスタート">
</a>
    <!--<audio controls autoplay src="~"></audio>-->
     <?php endif; ?>
</html>
 





  


