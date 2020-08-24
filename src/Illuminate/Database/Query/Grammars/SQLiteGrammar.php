<?php

namespace Vmartins\LaravelExtends\Illuminate\Database\Query\Grammars;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Expression;

class SQLiteGrammar extends \Illuminate\Database\Query\Grammars\SQLiteGrammar
{
    use Grammar;

    /**
     * Compile a "select date" clause.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array  $select
     * @return string
     */
    protected function selectDate(Builder $query, $select)
    {
        return $this->dateBasedSelect('%Y-%m-%d', $query, $select);
    }

    /**
     * Compile a "select year" clause.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array  $select
     * @return string
     */
    protected function selectYear(Builder $query, $select)
    {
        return $this->dateBasedSelect('%Y', $query, $select);
    }

    /**
     * Compile a "select month" clause.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array  $select
     * @return string
     */
    protected function selectMonth(Builder $query, $select)
    {
        return $this->dateBasedSelect('%m', $query, $select);
    }

    /**
     * Compile a "select day" clause.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array  $select
     * @return string
     */
    protected function selectDay(Builder $query, $select)
    {
        return $this->dateBasedSelect('%d', $query, $select);
    }

    /**
     * Compile a "select time" clause.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array  $select
     * @return string
     */
    protected function selectTime(Builder $query, $select)
    {
        return $this->dateBasedSelect('%H:%M:%S', $query, $select);
    }

    /**
     * Compile a date based select clause.
     *
     * @param  string  $type
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array  $select
     * @return string
     */
    protected function dateBasedSelect($type, Builder $query, $select)
    {
        $sql = "strftime('{$type}', {$this->wrap($select['column'])})";

        if (collect($select)->has(['as'])) {
            $sql .= ' as '.$this->wrap($select['as']);
        }

        return new Expression($sql);
    }    

    /**
     * Compile a "group by date" clause.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array  $group
     * @return string
     */
    protected function groupByDate(Builder $query, $group)
    {
        return $this->dateBasedGroupBy('%Y-%m-%d', $query, $group);
    }

    /**
     * Compile a "group by year" clause.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array  $group
     * @return string
     */
    protected function groupByYear(Builder $query, $group)
    {
        return $this->dateBasedGroupBy('%Y', $query, $group);
    }

    /**
     * Compile a "group by month" clause.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array  $group
     * @return string
     */
    protected function groupByMonth(Builder $query, $group)
    {
        return $this->dateBasedGroupBy('%m', $query, $group);
    }

    /**
     * Compile a "group by day" clause.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array  $group
     * @return string
     */
    protected function groupByDay(Builder $query, $group)
    {
        return $this->dateBasedGroupBy('%d', $query, $group);
    }

    /**
     * Compile a "group by time" clause.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array  $group
     * @return string
     */
    protected function groupByTime(Builder $query, $group)
    {
        return $this->dateBasedGroupBy('%H:%M:%S', $query, $group);
    }

    /**
     * Compile a date based group by clause.
     *
     * @param  string  $type
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array  $group
     * @return string
     */
    protected function dateBasedGroupBy($type, Builder $query, $group)
    {
        return "strftime('{$type}', {$this->wrap($group['column'])})";
    }    

    /**
     * Compile a "order by date" clause.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array  $order
     * @return string
     */
    protected function orderByDate(Builder $query, $order)
    {
        return $this->dateBasedOrderBy('%Y-%m-%d', $query, $order);
    }

    /**
     * Compile a "order by year" clause.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array  $order
     * @return string
     */
    protected function orderByYear(Builder $query, $order)
    {
        return $this->dateBasedOrderBy('%Y', $query, $order);
    }

    /**
     * Compile a "order by month" clause.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array  $order
     * @return string
     */
    protected function orderByMonth(Builder $query, $order)
    {
        return $this->dateBasedOrderBy('%m', $query, $order);
    }

    /**
     * Compile a "order by day" clause.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array  $order
     * @return string
     */
    protected function orderByDay(Builder $query, $order)
    {
        return $this->dateBasedOrderBy('%d', $query, $order);
    }

    /**
     * Compile a "order by time" clause.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array  $order
     * @return string
     */
    protected function orderByTime(Builder $query, $order)
    {
        return $this->dateBasedOrderBy('%H:%M:%S', $query, $order);
    }

    /**
     * Compile a date based order by clause.
     *
     * @param  string  $type
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array  $order
     * @return string
     */
    protected function dateBasedOrderBy($type, Builder $query, $order)
    {
        return "strftime('{$type}', {$this->wrap($order['column'])}) ".$order['direction'];
    }   
}