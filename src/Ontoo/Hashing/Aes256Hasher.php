<?php

namespace Ontoo\Hashing;

/**
 * Class Aes256Hasher
 *
 * @package Ontoo\Hashing
 */
class Aes256Hasher extends BaseHasher implements HasherInterface
{
    /**
     * @var int
     */
    protected $blocksize = 32;

    /**
     * Hash a string.
     *
     * @param string $string
     * @param null $key
     * @param null $iv
     *
     * @return string
     */
    public function hash($string, $key = null, $iv = null)
    {
        $pad = $this->blocksize - (strlen($string) % $this->blocksize);

        return trim(bin2hex(openssl_encrypt($string . str_repeat(chr($pad), $pad), "AES-256-CBC", $key, OPENSSL_RAW_DATA|OPENSSL_ZERO_PADDING, $iv)));
    }

    /**
     * Hash string against hashed string.
     *
     * @param string $string
     * @param string $hashedString
     * @param null $key
     * @param null $iv
     *
     * @return bool
     */
    public function checkhash($string, $hashedString, $key = null, $iv = null)
    {
        $length = 256 - $this->blocksize * 3;

        return $this->slowEquals(substr($this->hash($string, $key, $iv), 0, $length), substr($hashedString, 0, $length));
    }
}
