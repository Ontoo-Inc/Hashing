<?php

namespace Ontoo\Hashing;

abstract class BaseHasher
{

    /**
     * Compares two strings $a and $b in length-constant time.
     *
     * @param  string $a
     * @param  string $b
     *
     * @return boolean
     */
    final protected function slowEquals($a, $b)
    {
        $diff = strlen($a) ^ strlen($b);

        for ($i = 0; $i < strlen($a) && $i < strlen($b); $i++) {
            $diff |= ord($a[$i]) ^ ord($b[$i]);
        }

        return $diff === 0;
    }

}
