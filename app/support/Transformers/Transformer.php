<?php namespace Support\Transformers;

abstract class Transformer {

	/**
	 *	Map a transformation over a collection of items
	 *
	 *	@param $users
	 *	@return array
	 */
	public function transformCollection(array $items)
	{
		return array_map([$this, 'transform'], $items);
	}

	/**
	 * Required method that transforms a single item
	 * @param $item 
	 * @return array
	 */
	public abstract function transform($item);
}