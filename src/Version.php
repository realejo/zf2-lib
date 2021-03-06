<?php
/**
 * Classe para armazenar e recuperar a versão da biblioteca da Realejo
 *
 * @author     Realejo
 * @deprecated Tem que pegar do composer
 * @copyright  Copyright (c) 2011-2012 Realejo Design Ltda. (http://www.realejo.com.br)
 */

namespace Realejo;

class Version
{
    /**
     * RWLIB identificador de versão
     * @see compareVersion()
     */
    const VERSION = '1.1';

    /**
     * The latest stable version Zend Framework available
     *
     * @var string
     */
    protected static $latestVersion;

    /**
     * Compare the specified Zend Framework version string $version
     * with the current Zend_Version::VERSION of Zend Framework.
     *
     * @param  string $version A version string (e.g. "0.7.1").
     * @return int           -1 if the $version is older,
     *                           0 if they are the same,
     *                           and +1 if $version is newer.
     *
     */
    public static function compareVersion($version)
    {
        $version = strtolower($version);
        $version = preg_replace('/(\d)pr(\d?)/', '$1a$2', $version);
        return version_compare($version, strtolower(self::VERSION));
    }

    /**
     * Fetches the version of the latest stable release
     *
     * @return string
     */
    public static function getLatest()
    {
        if (null === self::$latestVersion) {
            self::$latestVersion = 'not available';

            $handle = fopen('https://raw.githubusercontent.com/realejo/library/master/version', 'r');
            if (false !== $handle) {
                self::$latestVersion = stream_get_contents($handle);
                fclose($handle);
            }
        }

        return self::$latestVersion;
    }
}
