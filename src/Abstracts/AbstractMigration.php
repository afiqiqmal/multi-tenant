<?php

/*
 * This file is part of the hyn/multi-tenant package.
 *
 * (c) Daniël Klabbers <daniel@klabbers.email>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/hyn/multi-tenant
 *
 */

namespace Hyn\Tenancy\Abstracts;

use Hyn\Tenancy\Database\Connection;
use Illuminate\Database\Migrations\Migration;

abstract class AbstractMigration extends Migration
{
    protected $system = false;

    abstract public function up();

    abstract public function down();

    public function getConnection()
    {
        if ($this->system) {
            return $this->connectionResolver()->systemName();
        }

        return $this->connectionResolver()->tenantName();
    }

    /**
     * @return Connection
     */
    protected function connectionResolver()
    {
        return app(Connection::class);
    }
}
