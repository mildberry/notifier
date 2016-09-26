<?php

namespace Mildberry\Notifier;

/**
 * @author Egor Zyuskin <e.zyuskin@mildberry.com>
 */
class NotifyCollection implements \IteratorAggregate  , \ArrayAccess , \Countable
{
    /**
     * @var Notify[]
     */
    protected $notifies = [];

    /**
     * Push an item onto the end of the collection.
     *
     * @param  Notify $item
     * @return $this
     */
    public function push(Notify $item)
    {
        $this->offsetSet(null, $item);

        return $this;
    }

    /**
     * Determine if an item exists at an offset.
     *
     * @param  mixed  $key
     * @return bool
     */
    public function offsetExists($key)
    {
        return array_key_exists($key, $this->notifies);
    }

    /**
     * Get an item at a given offset.
     *
     * @param  mixed  $key
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->notifies[$key];
    }

    /**
     * Set the item at a given offset.
     *
     * @param  mixed  $key
     * @param  mixed  $value
     * @return void
     */
    public function offsetSet($key, $value)
    {
        if (is_null($key)) {
            $this->notifies[] = $value;
        } else {
            $this->notifies[$key] = $value;
        }
    }

    /**
     * Unset the item at a given offset.
     *
     * @param  string  $key
     * @return void
     */
    public function offsetUnset($key)
    {
        unset($this->notifies[$key]);
    }

    /**
     * Count the number of items in the collection.
     *
     * @return int
     */
    public function count()
    {
        return count($this->notifies);
    }

    /**
     * Get an iterator for the items.
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->notifies);
    }

    /**
     * @return Notify[]
     */
    public function getNotifies()
    {
        return $this->notifies;
    }
}
