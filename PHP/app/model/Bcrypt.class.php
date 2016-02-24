<?php
    class Bcrypt {
        private static $_workFactor = 12;
        private static $_identifier = '2y';
        private static $_validIdentifiers = array ('2a', '2x', '2y');

        public static function hashPassword($password, $workFactor = 0) {
            if (version_compare(PHP_VERSION, '5.3') < 0) {
                throw new Exception('Bcrypt nécessite une version de PHP 5.3 ou supérieure.');
            }

            $salt = self::_genSalt($workFactor);
            return crypt($password, $salt);
        }

        public static function checkPassword($password, $storedHash) {
            if (version_compare(PHP_VERSION, '5.3') < 0) {
                throw new Exception('Bcrypt nécessite une version de PHP 5.3 ou supérieure.');
            }

            self::_validateIdentifier($storedHash);
            $checkHash = crypt($password, $storedHash);

            return ($checkHash === $storedHash);
        }

        private static function _genSalt($workFactor) {
            if ($workFactor < 4 || $workFactor > 31) {
                $workFactor = self::$_workFactor;
            }

            $input = self::_getRandomBytes();
            $salt = '$' . self::$_identifier . '$';

            $salt .= str_pad($workFactor, 2, '0', STR_PAD_LEFT);
            $salt .= '$';

            $salt .= substr(strtr(base64_encode($input), '+', '.'), 0, 22);

            return $salt;
        }

        private static function _getRandomBytes() {
            if (!function_exists('openssl_random_pseudo_bytes')) {
                throw new Exception('Format de cryptage non supporté.');
            }

            return openssl_random_pseudo_bytes(16);
        }

        private static function _validateIdentifier($hash) {
            if (!in_array(substr($hash, 1, 2), self::$_validIdentifiers)) {
                throw new Exception('Format de cryptage non supporté.');
            }
        }
    }
?>