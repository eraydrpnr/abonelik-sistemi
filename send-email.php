<?php
header('Content-Type: text/html; charset=utf-8');

// Hata ayıklama
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Veritabanı bağlantısı
$db_host = "doldur";
$db_user = "doldur";
$db_pass = "doldur";
$db_name = "doldur";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
  die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}

$konu = $_POST['konu'];
$mesaj = $_POST['mesaj'];

// E-postaları seç
$table_name = "epostalar"; // E-postaların bulunduğu tablo adı
$query = "SELECT email FROM $table_name";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
  require_once "phpmailer/src/PHPMailer.php";
  require_once "phpmailer/src/SMTP.php";
  require_once "phpmailer/src/Exception.php";Cannot GET /%20.html
  require_once "phpmailer/language/phpmailer.lang-tr.php";

  // E-posta gönderim ayarları
  $mail = new PHPMailer\PHPMailer\PHPMailer();
  $mail->isSMTP();
  $mail->Host = "doldur";
  $mail->SMTPAuth = true;
  $mail->Username = "e-posta adresinizi girin";
  $mail->Password = "e-postanın şifresi";
  $mail->SMTPSecure = "ssl";
  $mail->Port = 465; // Bunu değiştirmen gerekebilir ! (E-posta sağlayıcınız ile iletişime geçin. Gmail ise dokunmayın)

  // E-posta içeriği
  $email_subject = $konu;
  $email_body = $mesaj;

  // Her bir e-posta adresine e-posta gönder
  while ($row = mysqli_fetch_assoc($result)) {
    $mail->IsHTML(true);
    $mail->setFrom("e-posta adresinizi girin", "Başlık");
    $mail->addAddress($row['email']);
    $email_subject = "=?utf-8?B?".base64_encode($konu)."?=";
$email_body = $mesaj;
$mail->CharSet = "UTF-8";
$mail->Subject = $email_subject;
$mail->Body = '<style> html body{ text-align: center; margin: 0px 300px ; } .mail-body{ background-color: #000; color: aliceblue; margin: 100px; padding: 50px 10px; } img{ width: 20%; border-radius: 50%; } a{ color:aliceblu; } </style>' . '<div class="mail-body"> <center> <h1> '. $konu . '</h1><p>' . $email_body . '</p><br><br> <a style="color:aliceblu;" href="#EDİTLE">EDİTLE</a><br><a href="#EDİTLE"> Abonelik İptali </a> </center>';


    if (!$mail->send()) {
      echo "E-posta gönderimi başarısız: " . $mail->ErrorInfo;
    } else {
      echo "E-posta başarıyla gönderildi: " . $row['email'] . "<br>";
    }
    $mail->clearAddresses();
  }
} else {
  echo "E-posta bulunamadı.";
}

mysqli_close($conn);
?>