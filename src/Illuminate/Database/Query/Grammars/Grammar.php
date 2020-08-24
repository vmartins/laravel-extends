<?php

namespace Vmartins\LaravelExtends\Illuminate\Database\Query\Grammars;

use Illuminate\Support\Arr;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Expression;

trait Grammar
{
    /**
     * Compile a "select date" clause.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array  $select
     * @return string
     */
    protected function selectDate(Builder $query, $select)
    {
        return $this->dateBasedSelect('date', $query, $select);
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
        return $this->dateBasedSelect('year', $query, $select);
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
        return $this->dateBasedSelect('month', $query, $select);
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
        return $this->dateBasedSelect('day', $query, $select);
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
        return $this->dateBasedSelect('time', $query, $select);
    }

    /**
     * Compile a date based seect clause.
     *
     * @param  string  $type
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array  $select
     * @return string
     */
    protected function dateBasedSelect($type, Builder $query, $select)
    {
        $sql = $type.'('.$this->wrap($select['column']).')';

        if (collect($select)->has(['as'])) {
            $sql .= ' as '.$this->wrap($select['as']);
        }

        return new Expression($sql);
    }

    /**
     * Compile a select query into SQL.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @return string
     */
    public function compileSelect(Builder $query)
    {
        if (is_null($query->columns)) {
            return parent::compileSelect($query);
        }

        $columns = collect($query->columns)->map(function ($select) use ($query) {
            if (!collect($select)->has(['type'])) {
                return $select;
            }

            return $this->{"select{$select['type']}"}($query, $select);
        })->all();

        $query->columns = $columns;
        return parent::compileSelect($query);
    }

    /**
     * Compile a basic group by clause.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array  $group
     * @return string
     */
    protected function groupByBasic(Builder $query, $group)
    {
        return $this->columnize([$group]);
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
        return $this->dateBasedGroupBy('date', $query, $group);
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
        return $this->dateBasedGroupBy('year', $query, $group);
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
        return $this->dateBasedGroupBy('month', $query, $group);
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
        return $this->dateBasedGroupBy('day', $query, $group);
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
        return $this->dateBasedGroupBy('time', $query, $group);
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
        return $type.'('.$this->wrap($group['column']).')';
    }

    /**
     * Compile the "group by" portions of the query.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array  $groups
     * @return string
     */
    protected function compileGroups(Builder $query, $groups)
    {
        $sql = collect($groups)->map(function ($group) use ($query) {
            if (!collect($group)->has(['type'])) {
                $group['type'] = 'Basic';
            }

            return $this->{"groupBy{$group['type']}"}($query, $group);
        })->all();
        
        return 'group by '.implode(', ', $sql);
    }

    /**
     * Compile a basic order by clause.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array  $order
     * @return string
     */
    protected function orderByBasic(Builder $query, $order)
    {
        return $order['sql'] ?? $this->wrap($order['column']).' '.$order['direction'];
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
        return $this->dateBasedOrderBy('date', $query, $order);
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
        return $this->dateBasedOrderBy('year', $query, $order);
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
        return $this->dateBasedOrderBy('month', $query, $order);
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
        return $this->dateBasedOrderBy('day', $query, $order);
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
        return $this->dateBasedOrderBy('time', $query, $order);
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
        return $order['sql'] ?? $type.'('.$this->wrap($order['column']).') '.$order['direction'];
    }

    /**
     * Compile the query orders to an array.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array  $orders
     * @return array
     */
    protected function compileOrdersToArray(Builder $query, $orders)
    {
        return array_map(function ($order) use ($query) {
            if (!collect($order)->has(['type'])) {
                $order['type'] = 'Basic';
            }

            return $this->{"orderBy{$order['type']}"}($query, $order);
        }, $orders);
    }
}