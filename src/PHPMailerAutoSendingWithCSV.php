<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'Exception.php';
    require 'PHPMailer.php';
    require 'SMTP.php';
   
    $times = 0;
   
    set_time_limit(0); //PHP最長執行時間無限
   
    echo "<h3>PHPMailer Auto Sending System</h3>";
   
    $CSVfp = fopen("list.csv", "r");
    if($CSVfp !== FALSE) {
	print "<PRE>";
    while(! feof($CSVfp)) {
	$data = fgetcsv($CSVfp, 2000, ",");
	//echo "INSERT INTO list (`name`, `email`, `number`) VALUES ('" . $data[0] . "', '" . $data[1] . "', '" . $data[2] . "');\r\n\n";
	
    $mail= new PHPMailer();                             
    $mail->SMTPDebug = 0;                          //0 Disable ,2 Open
    $mail->IsSMTP();                               //設定使用SMTP方式寄信
    $mail->SMTPAuth = true;                        //設定SMTP需要驗證
    $mail->SMTPSecure = "ssl";                     // Gmail的SMTP主機需要使用SSL連線
    $mail->Host = "smtp.gmail.com";                //Gamil的SMTP主機
    $mail->Port = 465;                             //Gamil的SMTP主機的埠號(Gmail為465)。
    $mail->CharSet = "utf-8";                      //郵件編碼
    $mail->Username = "frank19960219@gmail.com";   //Gamil帳號
    $mail->Password = "gbnkzwujlkthgsbf";          //Gmail密碼
    $mail->From = "XXXXX@gmail.com";               //寄件者信箱
    $mail->FromName = "KUAS-高雄科技大學期刊系統"; //寄件者姓名
    $mail->Subject ="KUAS". $data[1];                //郵件標題
	
    $mail->Body = "Dear:" . $data[1] . "(" . $data[0] . ")，您好：<br />
	<br />
	回應內容:" . $data[3].$data[4]; //郵件內容
	
    //$mail->addAttachment('KUAS.JPG'); //附件，改以新的檔名寄出
    $mail->IsHTML(true);                         //郵件內容為html
    $mail->AddBCC("$data[2]");               //收件者郵件及名稱
	
if(!$mail->Send()){
        echo "<b>*User:</b>".$data[1]."<b>-Error:</b>" . $mail->ErrorInfo."<br /><br />";
    }
	else{
        echo "<b>User:</b>".$data[1]."<b>-Send Secess!</b><br />";
        echo "Time is:" . $times++ . "<br />\n";
	}
    
	}
}
fclose($CSVfp);
	
	$times=0;
	
?>
