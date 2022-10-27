<?php
require_once './vendor/autoload.php';
include './application/third_party/mailer/src/Exception.php';
include './application/third_party/mailer/src/PHPMailer.php';
include './application/third_party/mailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Pheanstalk\Pheanstalk;

function UpdateSendStatus($mailPayload) {
    echo $mailPayload->SendResult . PHP_EOL;
    if (!$mailPayload->SendResult) {
        echo $mailPayload->ErrorInfo . PHP_EOL;
    }
}

$WATCHTUBE = "smailer";
$queue = Pheanstalk::create('127.0.0.1'); // OR IP Address of Server running beanstalkd

$PIDFILE = __DIR__ . "/worker-emmail-smailer.pid";

touch($PIDFILE);

echo "Worker " . __FILE__ . " have started. To exit, delete pid file  " .  $PIDFILE . PHP_EOL;

while (file_exists($PIDFILE)) {
    while ($job = $queue->watch($WATCHTUBE)->ignore('default')->reserve(15)) {
        try {
            $mailPayload = json_decode($job->getData(), false);
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->CharSet  = "utf-8";
            $mail->Host = $mailPayload->Host;
            $mail->SMTPAuth = $mailPayload->SMTPAuth;
            $mail->Username = $mailPayload->Username;
            $mail->Password = $mailPayload->Password;
            $mail->SMTPSecure = $mailPayload->SMTPSecure;
            $mail->Port = $mailPayload->Port;

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->setFrom($mailPayload->FromEmail, $mailPayload->FromName);

            foreach (explode(',', $mailPayload->To) as $to) {
                $mail->addAddress($to);
            }
            
            $mail->isHTML($mailPayload->isHTML);
            $mail->Subject = $mailPayload->Subject;
            $mail->Body = $mailPayload->Body;
            $mailPayload->SendResult = $mail->send();
            if (!$mailPayload->SendResult) {
                $mailPayload->ErrorInfo = $mail->ErrorInfo;
            }

            $mailPayload->SendTimestamp = time();
            $mail->smtpClose();

            
            if (function_exists($mailPayload->Callback)) {
                call_user_func($mailPayload->Callback, $mailPayload);
            }
            
            $queue->delete($job);
        } catch (Exception $e) {
            $jobData = $job->getData();
            $queue->delete($job);
            var_dump($e);
            
            $queue->putInTube($WATCHTUBE, $jobData);
            exit();
        }
        if(!file_exists($PIDFILE)){
            exit();
        }
    }
}
?>