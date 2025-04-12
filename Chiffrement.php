<?php
// Fonction de chiffrement César (décalage de 3)
function caesar_cipher($text, $shift = 3) {
    $result = '';
    foreach (str_split($text) as $char) {
        $ascii = ord($char);
        if ($ascii >= 32 && $ascii <= 126) { // Limite aux caractères imprimables
            $new_ascii = (($ascii - 32 + $shift) % 95) + 32;
            $result .= chr($new_ascii);
        } else {
            $result .= $char; // Conserver les caractères non imprimables
        }
    }
    return $result;
}

// Fonction de déchiffrement (décalage inverse)
function caesar_decipher($text, $shift = 3) {
    return caesar_cipher($text, 95 - $shift); // Décalage inverse pour déchiffrer
}
?>