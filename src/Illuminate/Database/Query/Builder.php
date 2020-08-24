<?php

namespace Vmartins\LaravelExtends\Illuminate\Database\Query;

use Illuminate\Support\Arr;
use InvalidArgumentException;

class Builder extends \Illuminate\Database\Query\Builder
{
    /**
     * Compile a "select date" clause.
     *
     * @param  string  $columns
     * @return $this
     */
    public function selectDate(...$columns)
    {
        return $this->addDateBasedSelect('Date', $columns);
    }

    /**
     * Compile a "select year" clause.
     *
     * @param  string  $columns
     * @return $this
     */
    public function selectYear(...$columns)
    {
        return $this->addDateBasedSelect('Year', $columns);
    }

    /**
     * Compile a "select month" clause.
     *
     * @param  string  $columns
     * @return $this
     */
    public function selectMonth(...$columns)
    {
        return $this->addDateBasedSelect('Month', $columns);
    }

    /**
     * Compile a "select day" clause.
     *
     * @param  string  $columns
     * @return $this
     */
    public function selectDay(...$columns)
    {
        return $this->addDateBasedSelect('Day', $columns);
    }

    /**
     * Compile a "select time" clause.
     *
     * @param  string  $columns
     * @return $this
     */
    public function selectTime(...$columns)
    {
        return $this->addDateBasedSelect('Time', $columns);
    }

    /**
     * Add a date based (year, month, day, time) statement to the query.
     *
     * @param  string  $type
     * @param  string  $columns
     * @return $this
     */
    protected function addDateBasedSelect($type, $columns)
    {
        $select = [];
        foreach ($columns as $column) {
            $select = array_merge(
                (array) $select,
                Arr::wrap($column)
            );
        }

        foreach ($select as $as => $column) {
            if (is_string($as)) {
                $this->columns[] = compact('column', 'type', 'as');
            } else {
                $this->columns[] = compact('column', 'type');
            }
        }

        return $this;
    }

    /**
     * Add a count statement to the query.
     *
     * @param  string  $as
     * @return $this
     */
    public function selectCount($column = '*', $as = 'count')
    {
        $this->selectRaw(
            'count('.$column.') as '.$this->grammar->wrap($as), []
        );

        return $this;
    }

    /**
     * Compile a "group by date" clause.
     *
     * @param  string  $columns
     * @return $this
     */
    public function groupByDate(...$columns)
    {
        return $this->addDateBasedGroupBy('Date', $columns);
    }
    
    /**
     * Compile a "group by year" clause.
     *
     * @param  string  $columns
     * @return $this
     */
    public function groupByYear(...$columns)
    {
        return $this->addDateBasedGroupBy('Year', $columns);
    }
    
    /**
     * Compile a "group by month" clause.
     *
     * @param  string  $columns
     * @return $this
     */
    public function groupByMonth(...$columns)
    {
        return $this->addDateBasedGroupBy('Month', $columns);
    }

    /**
     * Compile a "group by day" clause.
     *
     * @param  string  $columns
     * @return $this
     */
    public function groupByDay(...$columns)
    {
        return $this->addDateBasedGroupBy('Day', $columns);
    }

    /**
     * Compile a "group by time" clause.
     *
     * @param  string  $columns
     * @return $this
     */
    public function groupByTime(...$columns)
    {
        return $this->addDateBasedGroupBy('Time', $columns);
    }

    /**
     * Add a date based (year, month, day, time) statement to the query.
     *
     * @param  string  $type
     * @param  string  $columns
     * @return $this
     */
    protected function addDateBasedGroupBy($type, $columns)
    {
        $groups = [];
        foreach ($columns as $column) {
            $groups = array_merge(
                (array) $groups,
                Arr::wrap($column)
            );
        }

        foreach ($groups as $column) {
            $this->groups[] = compact('column', 'type');
        }

        return $this;
    }

    /**
     * Compile a "order by date" clause.
     *
     * @param  string  $columns
     * @param  string  $direction
     * @return $this
     */
    public function orderByDate($columns, $direction = 'asc')
    {
        return $this->addDateBasedOrderBy('Date', $columns, $direction);
    }

    /**
     * Compile a "order by year" clause.
     *
     * @param  string  $columns
     * @param  string  $direction
     * @return $this
     */
    public function orderByYear($columns, $direction = 'asc')
    {
        return $this->addDateBasedOrderBy('Year', $columns, $direction);
    }

    /**
     * Compile a "order by month" clause.
     *
     * @param  string  $columns
     * @param  string  $direction
     * @return $this
     */
    public function orderByMonth($columns, $direction = 'asc')
    {
        return $this->addDateBasedOrderBy('Month', $columns, $direction);
    }

    /**
     * Compile a "order by day" clause.
     *
     * @param  string  $columns
     * @param  string  $direction
     * @return $this
     */
    public function orderByDay($columns, $direction = 'asc')
    {
        return $this->addDateBasedOrderBy('Day', $columns, $direction);
    }

    /**
     * Compile a "order by time" clause.
     *
     * @param  string  $columns
     * @param  string  $direction
     * @return $this
     */
    public function orderByTime($columns, $direction = 'asc')
    {
        return $this->addDateBasedOrderBy('Time', $columns, $direction);
    }

    /**
     * Add a date based (year, month, day, time) statement to the query.
     *
     * @param  string  $type
     * @param  string  $column
     * @param  string  $direction
     * @return $this
     *
     * @throws \InvalidArgumentException
     */
    public function addDateBasedOrderBy($type, $column, $direction = 'asc')
    {
        $direction = strtolower($direction);

        if (! in_array($direction, ['asc', 'desc'], true)) {
            throw new InvalidArgumentException('Order direction must be "asc" or "desc".');
        }

        $this->{$this->unions ? 'unionOrders' : 'orders'}[] = [
            'column' => $column,
            'direction' => $direction,
            'type' => $type,
        ];

        return $this;
    }
}