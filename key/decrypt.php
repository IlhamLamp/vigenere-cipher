<?php

// decrypt
function decipher($src, $key, $is_encode)
{
    $key = strtolower($key);
    $src = strtolower($src);
    $dest = '';

    /* strip out non-letters */
    for ($i = 0; $i <= strlen($src); $i++) {
        $char = substr($src, $i, 1);
        if (ctype_lower($char)) {
            $dest .= $char;
        }
    }

    for ($i = 0; $i <= strlen($dest); $i++) {
        $char = substr($dest, $i, 1);
        if (!ctype_lower($char)) {
            continue;
        }
        $dest = substr_replace(
            $dest,
            chr(
                ord('a') +
                    ($is_encode
                        ? ord($char) - ord('a') + ord($key[$i % strlen($key)]) - ord('a')
                        : ord($char) - ord($key[$i % strlen($key)]) + 26
                    ) % 26
            ),
            $i,
            1
        );
    }

    return $dest;
}
