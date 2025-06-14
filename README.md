# Su Takip Sistemi

Bu proje, kullanıcıların günlük su tüketimlerini kaydedip takip edebilecekleri basit bir web uygulamasıdır. PHP ve MySQL kullanılarak geliştirilmiştir. Bootstrap ile responsive tasarım yapılmıştır.

---

## Proje Amacı

Günlük su tüketimini takip ederek, kullanıcıların daha sağlıklı yaşam alışkanlıkları edinmelerine yardımcı olmak. Kullanıcılar, tarih bazında su tüketimlerini ekleyip, mevcut kayıtlarını görüntüleyebilir, düzenleyebilir veya silebilirler.

---

## Dosya Yapısı

/su-takip
│
├─ config.php # Veritabanı bağlantı ayarları
├─ index.php # Giriş sayfası
├─ register.php # Kayıt olma sayfası
├─ dashboard.php # Kullanıcı paneli, su tüketimi kayıtları
├─ edit.php # Kayıt düzenleme sayfası
├─ delete.php # Kayıt silme işlemi
├─ logout.php # Oturumu sonlandırma
├─ assets/ # Proje görselleri
│ ├─ veri_alimi.png
│ └─ kontrol_ekleme.png
└─ README.md # Proje açıklaması dosyası

---

## Kullanılan Teknolojiler

- PHP 8+
- MySQL
- Bootstrap 5
- PDO ile güvenli veritabanı bağlantısı

---

## Ekran Görüntüleri

### 1. Veri Alımı Ekran Görüntüsü (`images/veri_alimi.png`)  
Kullanıcıların günlük su tüketim miktarlarını eklediği ve tarih seçimiyle veri girişinin yapıldığı ekran.

### 2. Kontrol ve Ekleme Ekran Görüntüsü (`images/kontrol_ekleme.png`)  
Mevcut su tüketimi kayıtlarının listelendiği, düzenleme ve silme işlemlerinin yapıldığı kontrol paneli.

---

## Canlı Demo ve Tanıtım Videosu

Projeyi nasıl kullanacağınızı ve kurulum detaylarını bu videodan izleyebilirsiniz:  
[Su Takip Sistemi Tanıtım Videosu](https://www.youtube.com/watch?v=U3s-9tmUG70)

---

## Kurulum

1. Projeyi klonlayın veya ZIP olarak indirin.
2. Veritabanı oluşturup `config.php` dosyasını kendi bilgilerinizle güncelleyin.
3. Apache ve MySQL servislerini başlatın (örn. XAMPP).
4. Proje klasörünü web sunucusuna taşıyın.
5. Tarayıcıdan `index.php` sayfasını açarak kullanmaya başlayabilirsiniz.

---













