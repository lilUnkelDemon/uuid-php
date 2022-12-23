<?php
function php_UUID($name_space, $string) {
    $n_hex = str_replace(array('-','{','}'), '', $name_space); // Getting hexadecimal components of namespace
    $binary_str = ''; // Binary Value

	//Namespace UUID to bits conversion
    for($i = 0; $i < strlen($n_hex); $i+=2) {
      $binary_str .= chr(hexdec($n_hex[$i].$n_hex[$i+1]));
    }
    //hash value
    $hashing = md5($binary_str . $string);

    return sprintf('%08s-%04s-%04x-%04x-%12s',
      // 32 bits for the time low
      substr($hashing, 0, 8),
      // 16 bits for the time mid
      substr($hashing, 8, 4),
      // 16 bits for the time hi,
      (hexdec(substr($hashing, 12, 4)) & 0x0fff) | 0x3000,
      // 8 bits and 16 bits for the clk_seq_hi_res,
      // 8 bits for the clk_seq_low,
      (hexdec(substr($hashing, 16, 4)) & 0x3fff) | 0x8000,
      // 48 bits for the node
      substr($hashing, 20, 12)
    );
  }


?>
