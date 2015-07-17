<?php

namespace Ontoo\Hashing;

interface HasherInterface
{

    /**
     * Hash a string.
     *
     * @param string $string
     *
     * @return string
     */
    public function hash($string);

    /**
     * Hash string against hashed string.
     *
     * @param string $string
     * @param string $hashedString
     *
     * @return bool
     */
    public function checkhash($string, $hashedString);

}
