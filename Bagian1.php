<?php
    // ----------------------------- nomor 1
    $nilai = [72, 65, 73, 78, 75, 74, 90, 81, 87, 65, 55, 69, 72, 78, 79, 91, 100, 40, 67, 77, 86];
    
    function rata_rata($inputan){
        $total_nilai = 0;
        for ($a=0; $a < count($inputan); $a++) { 
            $total_nilai = $total_nilai + $inputan[$a];
        }
        echo "rata-rata : ".$total_nilai / count($inputan);
    }

    function nilai_tertinggi($inputan){
        rsort($inputan);
        echo "sortir nilai tertinggi : ";
        for ($a=0; $a < 7; $a++) { 
            echo $inputan[$a];
            if ($a < 6) {
                echo ",";
            }
        }
    }

    function nilai_terendah($inputan){
        sort($inputan);
        echo "sortir nilai terendah : ";
        for ($a=0; $a < 7; $a++) { 
            echo $inputan[$a];
            if ($a < 6) {
                echo ",";
            }
        }
    }

    rata_rata($nilai);
    echo "<br>";
    nilai_tertinggi($nilai);
    echo "<br>";
    nilai_terendah($nilai);

    // ----------------------------- nomor 2
    function hitung_huruf_kecil($inputan){
        $inputan_array = str_split(str_replace(" ", "", $inputan));
        $total = 0;
        for ($i=0; $i < count($inputan_array); $i++) { 
            if ($inputan_array[$i] == strtolower($inputan_array[$i])) {
                $total++;
            }
        }
        echo $inputan . " mengandung " . $total . " buah huruf kecil";
    }
    echo "<br><br>";
    hitung_huruf_kecil("TranSISI");


    // ----------------------------- nomor 3
    function get_ngram($inputan){
        $inputan = explode(" ", $inputan);
        $output = "";

        for ($a=0; $a < count($inputan) ; $a++) {
            $output = $output . $inputan[$a];
            if ($a < count($inputan) - 1) {
                $output = $output . ", ";
            }
        }
        echo "Unigram : " . $output;
        $output = "";

        for ($a=0; $a < count($inputan) ; $a++) {
            $output = $output . $inputan[$a];
            if ($a < count($inputan) - 1 && ($a + 1) % 2 == 0) {
                $output = $output . ", ";
            }else{
                $output = $output . " ";
            }
        }
        echo "<br>Bigram : " . $output;
        $output = "";

        for ($a=0; $a < count($inputan) ; $a++) {
            $output = $output . $inputan[$a];
            if ($a < count($inputan) - 1 && ($a + 1) % 3 == 0) {
                $output = $output . ", ";
            }else{
                $output = $output . " ";
            }
        }
        echo "<br>Trigram : " . $output;
    }

    echo "<br><br>";
    get_ngram("jakarta adalah ibukota negara republik indonesia");


    // ----------------------------- nomor 4
    function get_table(){
        echo "<table border=0>";
        for ($a=0; $a < 8; $a++) { 
            echo "<tr align='center'>";
            for ($b=1; $b <= 8; $b++) {
                if (((8 * $a) + $b) % 3 == 0 || ((8 * $a) + $b) % 4 == 0 ) {
                    echo "<td width=25px height=25px style='background-color: white; color: black;'>";
                }else{
                    echo "<td width=25px height=25px style='background-color: black; color: white;'>";
                }
                echo (8 * $a) + $b;
                echo "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    echo "<br><br>";
    get_table();


    // ----------------------------- nomor 5
    function enkripsi($inputan){
        $huruf = "A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z";
        $huruf = explode(",", $huruf);

        $inputan = str_split($inputan);
        for ($a=1; $a <= count($inputan); $a++) { 
            $index_huruf = array_search($inputan[$a - 1], $huruf) + 1;
            // get index enkripsi
            if ($a % 2 == 1) { // ganjil
                $index_huruf = $index_huruf + $a;
            } else{ //genap
                $index_huruf = $index_huruf - $a;
            }
            // direset jika melebihi/mengurangi jumlah huruf
            if ($index_huruf - 1 > count($huruf)) {
                if ($index_huruf % 26 == 0) {
                    $index_huruf = 26;
                }else {
                    $index_huruf = $index_huruf % 26;
                }
                
            }elseif ($index_huruf - 1 < 0) {
                $index_huruf = 26 + ($index_huruf);
            }

            echo $huruf[$index_huruf - 1];
        }
    }

    echo "<br>";
    enkripsi("DFHKNQ");

    
    // ----------------------------- nomor 6
    $arr = [
        ["f", "g", "h", "i"],
        ["j", "k", "p", "q"],
        ["r", "s", "t", "u"]
    ];

    function cari($arraynya, $find){
        $find = str_split($find);


        for ($j=0; $j < count($find) ; $j++) {
            for ($i=0; $i < count($arraynya) ; $i++) {
                if (in_array($find[$j], $arraynya[$i])) {
                    $hasil = "true";
                    break;
                }else {
                    $hasil = "false";
                }
                // echo $find[$j];
            }
            // echo "<br>" . $hasil;
            if ($hasil == "false") {
                break;
            }
        }
        echo $hasil;
    }

    echo "<br><br>";
    cari($arr, "agfgfp");
?>