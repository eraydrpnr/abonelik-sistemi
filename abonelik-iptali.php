<?php

// Hata ayıklama
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Gerekli dosyaları yükleme
require_once "phpmailer/src/PHPMailer.php";
require_once "phpmailer/src/SMTP.php";
require_once "phpmailer/src/Exception.php";
require_once "phpmailer/language/phpmailer.lang-tr.php";

// Veritabanı bağlantısı
$db_host = "doldur";
$db_user = "doldur";
$db_pass = "doldur";
$db_name = "doldur";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
  die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}

	// Formdan verileri al
$email = $_POST['email'];

// E-posta adresini veritabanına ekle
$table_name = "epostalar"; // E-postaların bulunduğu tablo adı

// E-postanın tabloda olup olmadığını kontrol et
$query = "SELECT * FROM $table_name WHERE email='$email'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
  // E-posta tabloda var, sil
  $query = "DELETE FROM $table_name WHERE email='$email'";
  $result = mysqli_query($conn, $query);
  
  if (!$result) {
    die("E-posta silinirken bir hata oluştu: " . mysqli_error($conn));
  }
  
  echo "<p>Abonelikten Başarı ile Ayrıldınız Gittiğinize Üzüldük:</p> " . $email . '<meta http-equiv="refresh" content="3; url=https://secim2023.eraydrpnr.com">';
	// Teşekkür e-postası gönder
$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug  = 0;
$mail->SMTPAuth   = true;
$mail->SMTPSecure = "ssl";
$mail->Host       = "doldur";
$mail->Port       = 465; // Bunu değiştirmen gerekebilir ! (E-posta sağlayıcınız ile iletişime geçin. Gmail ise dokunmayın)
$mail->Username   = "e-postanı gir"; // Gönderen e-posta adresi
$mail->Password   = "e-postanın şifresi"; // Gönderen e-posta adresinin şifresi

// E-posta ayarları
$mail->CharSet = "utf-8";
$mail->ContentType = "text/html; charset=utf-8";
$mail->SetFrom("e-posta", "Başlık"); // Gönderen bilgileri
$mail->AddAddress($email); // Alıcının e-posta adresi
$mail->Subject = "Gittiğine Üzüldüm :( Bu Son Mail"; // E-posta konusu
$mail->Body    = "Aboneliğiniz başarı ile sonlandırılmıştır."; // E-posta içeriği

if(!$mail->Send()) {
  die("E-posta gönderilemedi. Hata: " . $mail->ErrorInfo);
}
} else {
  // E-posta tabloda yok, hata mesajı göster
  die("Daha Önce Abone Olunmamış " . $email . '<meta http-equiv="refresh" content="3; url=https://secim2023.eraydrpnr.com">');
}

?>