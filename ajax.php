<?PHP
    if (isset($_POST['send_email'])) {
        require('class.phpmailer.php');
        require('class.smtp.php');
        $name = $_POST['name'];
        $email = $_POST['email'];
        //$phone = $_POST['phone'];
        $message = $_POST['message'];
        $subject = '[FEEDBACK FROM ProjectImmaculate]';
        //$body = $message.'<br/><br/>Name: '.$name.'<br/>Email: '.$email.'<br/>Phone: '.$phone;
        $body = 'Name: '.$name.'<br/>Email: '.$email.'<br/>Message: '.$message;
        $mail = new PHPMailer;
        $mail->CharSet = 'UTF-8';
        $mail->IsSMTP ();
        $mail->SMTPDebug = 0;
        $mail->SMTPSecure='';
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.qq.com';
        $mail->Port = '25';
        $mail->Username = '2757144278@qq.com';
        $mail->Password = '1q2w3e4r';
        //$mail->Host = 'smtp.gmail.com';
        //$mail->Port = '465';
        //$mail->Username = 'hardyrong1006@gmail.com';
        //$mail->Password = '!Q@W#E$R%T';
        //$mail->Host = 'mail.lifespring.com.hk';
        //$mail->Port = '26';
        //$mail->Username = 'system@lifespring.com.hk';
        //$mail->Password = '2201sys##';
        mb_internal_encoding ('UTF-8');
        $mail->Subject = mb_encode_mimeheader ($subject, 'UTF-8');
        $mail->From = '2757144278@qq.com';
        //$mail->From = 'mail.lifespring.com.hk';
        $mail->FromName = $_POST['name'];
        $isHTML = true;
        if (!$isHTML) {
            $mail->isHTML (false);
            $mail->Body = $body;
        }
        else {
            $mail->AltBody = 'To view the message, please use an HTML compatible email viewer.';
            $mail->MsgHTML ($body);
        }
        $mail->AddAddress ('immaculate_co@foxmail.com', 'immaculate_co');
        $message = ($mail->Send() ? true : $mail->ErrorInfo);
        if (true === $message) {
            $ret['msg'] = '您的消息已發送';
        }
        else {
            $ret['msg'] = '消息發送失敗 (錯誤代碼: '.$message.')';
        }
        echo json_encode($ret);
    }
?>