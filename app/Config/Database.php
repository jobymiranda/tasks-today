<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
    /**
     * Directory containing migrations and seeders.
     */
    public string $filesPath = APPPATH
        . 'Database'
        . DIRECTORY_SEPARATOR;

    /**
     * Default database connection group.
     */
    public string $defaultGroup = 'default';

    /**
     * Main application database connection.
     *
     * Local values are replaced by settings in .env.
     * Hosted values are replaced by Render environment variables.
     *
     * @var array<string, mixed>
     */
    public array $default = [
        'DSN'          => '',
        'hostname'     => 'localhost',
        'username'     => 'root',
        'password'     => '',
        'database'     => 'tasks_today_db',
        'DBDriver'     => 'MySQLi',
        'DBPrefix'     => '',
        'pConnect'     => false,
        'DBDebug'      => true,
        'charset'      => 'utf8mb4',
        'DBCollat'     => 'utf8mb4_general_ci',
        'swapPre'      => '',
        'encrypt'      => false,
        'compress'     => false,
        'strictOn'     => false,
        'failover'     => [],
        'port'         => 3306,
        'numberNative' => false,
        'foundRows'    => false,
        'dateFormat'   => [
            'date'     => 'Y-m-d',
            'datetime' => 'Y-m-d H:i:s',
            'time'     => 'H:i:s',
        ],
    ];

    /**
     * Database connection used by automated tests.
     *
     * @var array<string, mixed>
     */
    public array $tests = [
        'DSN'         => '',
        'hostname'    => '127.0.0.1',
        'username'    => '',
        'password'    => '',
        'database'    => ':memory:',
        'DBDriver'    => 'SQLite3',
        'DBPrefix'    => 'db_',
        'pConnect'    => false,
        'DBDebug'     => true,
        'charset'     => 'utf8',
        'DBCollat'    => '',
        'swapPre'     => '',
        'encrypt'     => false,
        'compress'    => false,
        'strictOn'    => true,
        'failover'    => [],
        'port'        => 3306,
        'foreignKeys' => true,
        'busyTimeout' => 1000,
        'synchronous' => null,
        'dateFormat'  => [
            'date'     => 'Y-m-d',
            'datetime' => 'Y-m-d H:i:s',
            'time'     => 'H:i:s',
        ],
    ];

    /**
     * Apply environment settings and decode hosted SSL configuration.
     */
    public function __construct()
    {
        parent::__construct();

        /*
         * Render supplies the MySQL SSL settings as a JSON string:
         *
         * {"ssl_verify":true,"ssl_ca":"/etc/secrets/ca.pem"}
         *
         * CodeIgniter's MySQLi connection expects this setting to be
         * an array, so it must be decoded before connecting.
         */
        if (is_string($this->default['encrypt'])) {
            $sslConfiguration = json_decode(
                $this->default['encrypt'],
                true
            );

            if (is_array($sslConfiguration)) {
                $this->default['encrypt'] = $sslConfiguration;
            }
        }

        /*
         * Protect the normal application database while automated
         * tests are running.
         */
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}