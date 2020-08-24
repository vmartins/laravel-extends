<?php

namespace Vmartins\LaravelExtends\Illuminate\Database;

use Vmartins\LaravelExtends\Illuminate\Database\Query\Builder;
use Vmartins\LaravelExtends\Illuminate\Database\Query\Grammars\PostgresGrammar;

class PostgresConnection extends \Illuminate\Database\PostgresConnection
{
    /**
     * Get the default query grammar instance.
     *
     * @return \Vmartins\LaravelExtends\Illuminate\Database\Query\Grammars\PostgresGrammar
     */
    protected function getDefaultQueryGrammar()
    {
        return $this->withTablePrefix(new PostgresGrammar);
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