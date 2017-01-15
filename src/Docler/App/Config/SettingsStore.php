<?php
declare(strict_types = 1);

namespace Docler\App\Config;

use Monolog\Logger;

/**
 * Class Settings
 *
 * Returns app settings by environment
 *
 * @package Docler\App\Config
 */
final class SettingsStore
{
    /** @var string ENV_PRODUCTION */
    const ENV_PRODUCTION = 'production';

    /** @var string ENV_DEVELOPMENT */
    const ENV_DEVELOPMENT = 'development';

    /** @var string ENV_TESTING */
    const ENV_TESTING = 'testing';

    /** @var array $settings Settings by environment */
    private static $settings = [
        'development' => [
            'displayErrorDetails'    => true,

            // Allow the web server to send the content-length header
            'addContentLengthHeader' => false,

            // Renderer settings
            'twig'                   => [
                'template_path' => ROOT_DIR . '/src/Docler/TicTac/Template',
                'cache'         => false,
                'cache_path'    => ROOT_DIR . '/cache',
            ],

            // Monolog settings
            'logger'                 => [
                'name'  => 'slim-app',
                'path'  => ROOT_DIR . '/logs/dev.log',
                'level' => Logger::DEBUG,
            ],
        ],
        'production'  => [
            'displayErrorDetails' => false,

            // Renderer settings
            'twig'                => [
                'cache' => true,
            ],

            // Monolog settings
            'logger'              => [
                'path'  => ROOT_DIR . '/logs/prod.log',
                'level' => Logger::WARNING,
            ],
        ],
        'testing'     => [
            // Monolog settings
            'logger' => [
                'path' => ROOT_DIR . '/logs/test.log',
            ],
        ],
    ];

    /**
     * Returns app settings by environment
     *
     * @param string $environment
     *
     * @return array
     */
    public static function getSettings(string $environment = self::ENV_DEVELOPMENT): array
    {
        return [
            'settings' => array_replace_recursive(self::$settings['development'], self::$settings[$environment]),
        ];
    }
}