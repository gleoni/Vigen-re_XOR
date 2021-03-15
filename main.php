<?php
for ($i=0; $i<256; ++$i) {
  echo "$i  ".date('h-i-s')."\n";
  for ($j=0; $j<256; ++$j) {
    Encrypt_Vigenere_XOR('cipher.txt','msg.txt',[$i,$j]);
  }
}

function Encrypt_Vigenere_XOR($in_file, $out_file, $key) {
	// $in_file = nome del file in input
	// $out_file = nome del file in output
	// $key = byte fra 0 e 255
	
	// apertura file in lettura
	$in = fopen($in_file, 'r');
	// apertura file in scrittura
	$out = fopen($out_file, 'a');
  // indice della chiave
  $n = 0;
  /*************/
  fwrite($out, "\n*** $key[0] - $key[1] ***\n");
	// lettura primo carattere e trasformazione in byte ord()
	$byte = ord(fread($in, 1));
	// se il file non è finito
	while (! feof($in)) {
		// XOR
		$byte = $byte ^ $key[$n];
    // incremento indice chiave
        $n = ++$n % count($key);
		// scrittura nel file il byte cifrato trasformato in carattere chr()
		fwrite($out, chr($byte));
				// lettura carattere successivo
		$byte = ord(fread($in, 1));
	}
}
?>