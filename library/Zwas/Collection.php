<?php
abstract class Zwas_Collection implements Iterator, ArrayAccess {
	protected $items = array();
	
	public function __construct($items = array()) {
		foreach($items as $item) {
			$this->items[]= $item;
		}
	}
	
	/**
	 * Count the number of items in the collection
	 * @return integer
	 */
	public function count() {
		return count($this->items);
	}
	/**
	 * @return array of Items
	 */
	public function toArray() {
		return $this->items;
	}
	
	/**************************************
	 * Implementation of Iterator interface
	 **************************************/
	
	/**
	 * @return void
	 */
	public function rewind() {
        reset($this->items);
    }
	/**
	 * @return mixed
	 */
    public function current() {
        return current($this->items);
    }
	/**
	 * @return mixed
	 */
    public function key() {
        return key($this->items);
    }
	/**
	 * @return void
	 */
    public function next() {
        next($this->items);
    }
	/**
	 * @return boolean
	 */
    public function valid() {
        return current($this->items) !== false ? true : false;
    }
	
	/****************************
	 * ArrayAccess implementation
	 ****************************/
	/**
	 * @param $offset
	 * @param $value
	 */
	public function offsetSet($offset, $value) {
		$this->items[$offset] = $value;
	}
	/**
	 * @param $offset
	 * @return boolean
	 */
	public function offsetExists($offset) {
		return isset($this->items[$offset]);
	}
	/**
	 * @param $offset
	 */
	public function offsetUnset($offset) {
		unset($this->items[$offset]);
	}
	/**
	 * @param $offset
	 * @return object
	 */
	public function offsetGet($offset) {
		return isset($this->items[$offset]) ? $this->items[$offset] : null;
	}
	
	/**
	 * Gimped Factory method for internal use
	 * @param array $items
	 */
	abstract protected function newCollection($items = array());
	
}