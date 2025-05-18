<?php

$cevaplar = array("A", "C", "B", "C", "A", "B", "B", "A", "B", "A");

$sorular = array(
    "Türkiye'nin başkenti neresidir?",
    "İstanbul hangi kıtada yer alır?",
    "Cumhuriyet ne zaman ilan edilmiştir?",
    "Türkiye'nin en uzun nehri hangisidir?",
    "Türkiye'nin yüzölçümü en büyük ili?",
    "Boğaziçi Köprüsü hangi şehirdedir?",
    "Türkiye'nin en yüksek dağı?",
    "İzmir hangi bölgemizdedir?",
    "Atatürk'ün doğum yılı?",
    "TBMM ne zaman açıldı?"
);

$secenekler = array(
    array("A) Ankara", "B) İstanbul", "C) İzmir", "D) Bursa"),
    array("A) Asya", "B) Avrupa", "C) İkisi", "D) Afrika"),
    array("A) 1920", "B) 1923", "C) 1938", "D) 1919"),
    array("A) Fırat", "B) Dicle", "C) Kızılırmak", "D) Meriç"),
    array("A) Konya", "B) Ankara", "C) Erzurum", "D) Sivas"),
    array("A) Ankara", "B) İstanbul", "C) İzmir", "D) Adana"),
    array("A) Kaçkar", "B) Ağrı", "C) Erciyes", "D) Uludağ"),
    array("A) Ege", "B) Akdeniz", "C) Marmara", "D) İç Anadolu"),
    array("A) 1880", "B) 1881", "C) 1882", "D) 1883"),
    array("A) 1920", "B) 1921", "C) 1922", "D) 1923")
);


function harfNotu($puan) {
    if ($puan >= 90) {
        return "AA";
    } else if ($puan >= 85) {
        return "BA";
    } else if ($puan >= 80) {
        return "BB";
    } else if ($puan >= 75) {
        return "CB";
    } else if ($puan >= 70) {
        return "CC";
    } else if ($puan >= 65) {
        return "DC";
    } else if ($puan >= 60) {
        return "DD";
    } else if ($puan >= 50) {
        return "FD";
    } else {
        return "FF";
    }
}


$soruSayisi = 0;
foreach ($sorular as $soru) {
    $soruSayisi = $soruSayisi + 1;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $okulNo = htmlspecialchars($_POST["okulNo"]);
    $ad = htmlspecialchars($_POST["ad"]);
    $soyad = htmlspecialchars($_POST["soyad"]);

    $dogru = 0;
    $yanlis = 0;

    for ($i = 0; $i < $soruSayisi; $i = $i + 1) {
        if (isset($_POST["cevap".$i])) {
            $secilen = $_POST["cevap".$i];
            $dogruCevap = $cevaplar[$i];

            if ($secilen == $dogruCevap) {
                $dogru = $dogru + 1;
            } else {
                $yanlis = $yanlis + 1;
            }
        } else {
            $yanlis = $yanlis + 1;
        }
    }

   
    $puan = (int)(($dogru * 100) / $soruSayisi);
    $harf = harfNotu($puan);

    echo "<h2>Test Sonucu</h2>";
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><td><b>Okul No</b></td><td><b>Ad</b></td><td><b>Soyad</b></td><td><b>Doğru</b></td><td><b>Yanlış</b></td><td><b>Puan</b></td><td><b>Harf Notu</b></td></tr>";
    echo "<tr>";
    echo "<td>".$okulNo."</td>";
    echo "<td>".$ad."</td>";
    echo "<td>".$soyad."</td>";
    echo "<td>".$dogru."</td>";
    echo "<td>".$yanlis."</td>";
    echo "<td>".$puan."</td>";
    echo "<td>".$harf."</td>";
    echo "</tr>";
    echo "</table>";
    echo "<br><h3>BAŞARILAR!</h3>";

} else {
    echo "<h2>Çoktan Seçmeli Test</h2>";
    echo "<form method='post'>";
    echo "Okul No: <input type='text' name='okulNo' required><br><br>";
    echo "Ad: <input type='text' name='ad' required><br><br>";
    echo "Soyad: <input type='text' name='soyad' required><br><br>";

    for ($i = 0; $i < $soruSayisi; $i = $i + 1) {
        echo "<b>".($i+1).". ".$sorular[$i]."</b><br>";
        $seceneklerBuSoru = $secenekler[$i];

        foreach ($seceneklerBuSoru as $secenek) {
            $harf = $secenek[0];  
            echo "<input type='radio' name='cevap".$i."' value='".$harf."' required> ".$secenek."<br>";
        }
        echo "<br>";
    }

    echo "<button type='submit'>Gönder</button>";
    echo "</form>";
}
?>
