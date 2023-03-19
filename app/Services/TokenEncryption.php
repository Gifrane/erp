<?php

namespace App\Services;

use function base64_decode;
use function base64_encode;
use function config;
use function hash_equals;
use function hash_hmac;
use function openssl_cipher_iv_length;
use function openssl_decrypt;
use function openssl_encrypt;
use function openssl_random_pseudo_bytes;
use function substr;

class TokenEncryption
{
    /**
     * @param string $plaintext
     * @return string
     */
    public static function encrypt(string $plaintext): string
    {
        $key = config('app.key');

        $ivlen = openssl_cipher_iv_length($cipher = 'aes-256-cbc');
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $key, true);

        return base64_encode($iv.$hmac.$ciphertext_raw);
    }

    /**
     * @param string $ciphertext
     * @return null|string
     */
    public static function decrypt(string $ciphertext): ?string
    {
        $key = config('app.key');

        $c = base64_decode($ciphertext);
        $ivlen = openssl_cipher_iv_length($cipher = 'aes-256-cbc');
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len = 32);
        $ciphertext_raw = substr($c, $ivlen+$sha2len);

        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, true);

        if (hash_equals($hmac, $calcmac)) {
            return $original_plaintext;
        }

        return null;
    }
}