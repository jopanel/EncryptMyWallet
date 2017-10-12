<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Encryption_model extends CI_Model {

        public function __construct()
        {
                parent::__construct(); 
        }

        public function encryptWallet( $key, $plaintext, $meta = '' ) { 
        	$originalkey = $key;
			$key = hash_pbkdf2( 'sha256', $key, '', 10000, 0, true ); 
			$meta = serialize($meta); 
			$mac_key = hash_hmac( 'sha256', 'mac', $key, true );
			$enc_key = hash_hmac( 'sha256', 'enc', $key, true );
			$enc_key = substr( $enc_key, 0, 32 ); 
			$temp = $nonce = ( 16 > 0 ? mcrypt_create_iv( 16 ) : "" );
			$temp .= hash_hmac( 'sha256', $plaintext, $mac_key, true );
			$temp .= hash_hmac( 'sha256', $meta, $mac_key, true );
			$mac = hash_hmac( 'sha256', $temp, $mac_key, true );
			$siv = substr( $mac, 0, 16 ); 
			$enc = mcrypt_encrypt( 'rijndael-128', $enc_key, $plaintext, 'ctr', $siv );
			$testKey = base64_encode( $siv . $nonce . $enc );
			if ($this->decryptWallet($originalkey, $testKey) !== $plaintext) { return null; }
			return base64_encode( $siv . $nonce . $enc );
		}

		public function decryptWallet( $key, $ciphertext, $meta = '' ) { 
			$key = hash_pbkdf2( 'sha256', $key, '', 10000, 0, true ); 
			$meta = serialize($meta); 
			$mac_key = hash_hmac( 'sha256', 'mac', $key, true );
			$enc_key = hash_hmac( 'sha256', 'enc', $key, true );
			$enc_key = substr( $enc_key, 0, 32 ); 
			$enc = base64_decode( $ciphertext );
			$siv = substr( $enc, 0, 16 );
			$nonce = substr( $enc, 16, 16 );
			$enc = substr( $enc, 16 + 16 ); 
			$plaintext = mcrypt_decrypt( 'rijndael-128', $enc_key, $enc, 'ctr', $siv ); 
			$temp = $nonce;
			$temp .= hash_hmac( 'sha256', $plaintext, $mac_key, true );
			$temp .= hash_hmac( 'sha256', $meta, $mac_key, true );
			$mac = hash_hmac( 'sha256', $temp, $mac_key, true );
			if ( $siv !== substr( $mac, 0, 16 ) ) return null;
			return $plaintext;
		}

 }