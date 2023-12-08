<?php
function caesar_encrypt($text, $shift) {
    $result = "";
    
    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        
        // Periksa apakah karakter adalah huruf alfabet (besar atau kecil) atau angka
        if (ctype_alpha($char) || is_numeric($char)) {
            if (ctype_alpha($char)) {
                $ascii_offset = (ctype_upper($char)) ? ord('A') : ord('a');
                $base = 26;
            } else {
                $ascii_offset = ord('0');
                $base = 7;
            }
            
            // Enkripsi karakter
            $encrypted_char = chr(($base + (ord($char) - $ascii_offset + $shift)) % $base + $ascii_offset);
            
            $result .= $encrypted_char;
        } else {
            // Karakter non-alfabet dan non-angka, biarkan tidak berubah
            $result .= $char;
        }
    }
    
    return $result;
}

// $username = "Admin";
// $password = "DIfacL";

// $move_one = 10;
// $move_two = 7;
// $move_three = 21;
// $move_four = 90;

// $username_encrypt = caesar_encrypt($username, $move_one) . caesar_encrypt($username, $move_two) . caesar_encrypt($username, $move_three) . caesar_encrypt($username, $move_four);
// $password_encrypt = caesar_encrypt($password, $move_one) . caesar_encrypt($password, $move_two) . caesar_encrypt($password, $move_three) . caesar_encrypt($password, $move_four) . caesar_encrypt($password, $move_three) . caesar_encrypt($password, $move_two) . caesar_encrypt($password, $move_one);

// echo $username_encrypt;
// echo "<br>";
// echo $password_encrypt;

?>
