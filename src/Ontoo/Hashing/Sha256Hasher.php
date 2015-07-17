<?php

namespace Ontoo\Hashing;

class Sha256Hasher extends BaseHasher implements HasherInterface
{

    /**
     * Salt Length
     *
     * @var int
     */
    public $saltLength = 16;

    /**
     * Hash string.
     *
     * @param string $string
     *
     * @return string
     */
    public function hash($string)
    {
        // Create salt
        $salt = $this->createSalt();

        return $salt . hash('sha256', $salt . $string);
    }

    /**
     * Check string against hashed string.
     *
     * @param string $string
     * @param string $hashedString
     *
     * @return bool
     */
    public function checkhash($string, $hashedString)
    {
        $salt = substr($hashedString, 0, $this->saltLength);

        return $this->slowEquals(($salt . hash('sha256', $salt . $string)), $hashedString);
    }

    /**
     * Create a random string for a salt.
     *
     * @return string
     */
    public function createSalt()
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $this->saltLength);
    }

}
