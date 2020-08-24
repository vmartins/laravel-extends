<?php

namespace Vmartins\LaravelExtends\Illuminate\Database;

use Vmartins\LaravelExtends\Illuminate\Database\Query\Builder;
use Vmartins\LaravelExtends\Illuminate\Database\Query\Grammars\MySqlGrammar;

class MySqlConnection extends \Illuminate\Database\MySqlConnection
{
    /**
     * Get the default query grammar instance.
     *
     * @return \Vmartins\LaravelExtends\Illuminate\Database\Query\Grammars\MySqlGrammar
     */
    protected function getDefaultQueryGrammar()
    {
        return $this->withTablePrefix(new MySqlGrammar);
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