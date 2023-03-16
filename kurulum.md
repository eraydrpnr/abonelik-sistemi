
# PHP Abonelik Sistemi Özel Toplu Mail Sistemli

  

Abonelik sistemi şöyle çalışmaktadır. Abone olmak için formda e-posta doldurmalık bir alan verilir. Doldurulan e-postayı database ekler ve kullanıcıya abone olduğuna dair mail gönderir.

  

Kullanıcılara toplu olarak mail atmanız için paketin içinde basit mail uygulaması bulunmaktadır. Bu uygulama Konu ve Mesaj olarak forum sunar. Bu form’a yazdığınız konu ve mesajı database de olan tüm e-postalara gönderir.

  

# Abonelik İptali Bulunmaktadır

  

## Nasıl Çalışır

  

Abonelik iptali için iptal etmek istediğiniz e-postayı yazmanız gerekmektedir. Eğer e-posta yoksa hata mesajı gösterir.

  

**[Daha Önce Bir Yerde Kullanılan Abonelik Sistemini görmek için tıkla (Aşağıya doğru)](https://secim2023.eraydrpnr.com)**

  
  

# Kurulum

  

```sql
CREATE TABLE epostalar (

id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,

email VARCHAR(255) NOT NULL

);
```

  

db.sql dosayasını veri tabanınıza atınız.

  

 abone-ol.html içindeki gibi bir form oluşturmanız gerekiyor bu formu css ile güzelleştirebilirsiniz.
 ```html
 <form  action="eposta_ekle.php"  method="post">

E-posta Adresi: <input  type="email"  name="email"  required>

<br><br>

<input  type="submit"  value="Ekle">

</form>
```
> Aynı şekilde abonelik iptali içinde örnek sayfa verilmiştir.

 Kodlarda bazı doldurmanız gereken yerler var bunları editörünüzü ctrl+f ile `doldur` yazarak görüntüleyebilir ve gerekli yerleri doldurabilirsiniz.
> Şunları da aratın ve değiştirin : doldur , e-postanı gir , e-postanın şifresi

ve editlenmesi gereken yerleri tüm kodları inceleyerek detaylı görebilirsin.



