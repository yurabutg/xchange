<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

class UtilityComponent extends Component
{


    /**
     *
     * @param type $length
     * @return type
     *
     * This generates a random string with a specified length
     */
    public function getRandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-><!?_=&%$£€;.,';
        $token = '';

        if (!is_null($length)) {
            while (strlen($token) <= $length)
            {
                $randstring = '';
                for ($i = 0; $i < $length; $i++) {
                    $randstring .= $characters[rand(0, strlen($characters) - 1)];
                }
                $randstring = substr($randstring, 0, $length);
                $token .= sha1(md5($randstring));
            }

            if (strlen($token) > $length)
            {
                $token = substr($token, 0, $length);
            }
        }
        return $token;
    }
}

