<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'Exception.php';
    require 'PHPMailer.php';
    require 'SMTP.php';
	
    $C_name=$_POST['C_name'];
    $C_email=$_POST['C_email'];
    $C_tel=$_POST['C_tel'];
    $C_message=$_POST['C_message'];
   
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
    $mail->Subject ="期刊系統通知";                //郵件標題
	
    $mail->Body = "親愛的作者 ".$C_name."(".$C_email.")，您好：<br />
	<br />
	電話:".$C_tel."<br />
	回應內容:".$C_message; //郵件內容
	
    $mail->addAttachment('KUAS.JPG'); //附件，改以新的檔名寄出
    $mail->IsHTML(true);                         //郵件內容為html
    $mail->AddAddress("$C_email");               //收件者郵件及名稱
    if(!$mail->Send()){
        echo "Error: " . $mail->ErrorInfo;
    }else{
        echo "<b>感謝您的留言，您的建議是我們前進的動力!</b>";
    }
    
?>