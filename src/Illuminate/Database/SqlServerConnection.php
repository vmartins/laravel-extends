<?php

namespace Vmartins\LaravelExtends\Illuminate\Database;

use Vmartins\LaravelExtends\Illuminate\Database\Query\Builder;
use Vmartins\LaravelExtends\Illuminate\Database\Query\Grammars\SqlServerGrammar;

class SqlServerConnection extends \Illuminate\Database\SqlServerConnection
{
    /**
     * Get the default query grammar instance.
     *
     * @return \Vmartins\LaravelExtends\Illuminate\Database\Query\Grammars\SqlServerGrammar
     */
    protected function getDefaultQueryGrammar()
    {
        return $this->withTablePrefix(new SqlServerGrammar);
    }

    /**
     * Get a new query builder instance.
     *
     * @return \Vmartins\LaravelExtends\Illuminate\Database\Query\Builder
     */
    public function query()
    {
        return new Builder(
            $this, $this->getQueryGrammar(), $this->getPostProcessor()
        );
    }
}