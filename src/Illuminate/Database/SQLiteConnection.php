<?php

namespace Vmartins\LaravelExtends\Illuminate\Database;

use Vmartins\LaravelExtends\Illuminate\Database\Query\Builder;
use Vmartins\LaravelExtends\Illuminate\Database\Query\Grammars\SQLiteGrammar;

class SQLiteConnection extends \Illuminate\Database\SQLiteConnection
{
    /**
     * Get the default query grammar instance.
     *
     * @return \Vmartins\LaravelExtends\Illuminate\Database\Query\Grammars\SQLiteGrammar
     */
    protected function getDefaultQueryGrammar()
    {
        return $this->withTablePrefix(new SQLiteGrammar);
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