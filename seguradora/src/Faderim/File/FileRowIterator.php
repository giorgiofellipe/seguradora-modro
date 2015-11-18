<?php

namespace Faderim\File;

/**
 * Description of FileRowIterator
 *
 * @author Ricardo Schroeder
 */
class FileRowIterator implements \Iterator, \ArrayAccess
{

    protected $resource;
    protected $current;
    protected $line = 0;
    protected $cache = null;

    public function __construct($file)
    {
        $this->resource = fopen($file, 'r');
    }

    public function current()
    {
        return $this->current;
    }

    public function key()
    {
        return $this->line;
    }

    public function next()
    {
        ++$this->line;
        $this->current = $this->getLine();
    }

    protected function getLine()
    {
        $linha = fgets($this->resource);
        return $linha;
    }

    public function rewind()
    {
        rewind($this->resource);
        $this->line = -1;
        $this->next();
    }

    public function valid()
    {
        return $this->current !== false;
    }

    public function getArray()
    {
        $lines = Array();
        foreach ($this as $key => $row) {
            $lines[$key] = $row;
        }
        return $lines;
    }

    public function offsetExists($offset)
    {
        if (isset($this->cache[$offset])) {
            return true;
        } else {
            foreach ($this as $key => $row) {
                if (!isset($this->cache[$key])) {
                    $this->cache[$key] = $row;
                    if ($key === $offset) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    public function offsetGet($offset)
    {
        if ($this->offsetExists($offset)) {
            return $this->cache[$offset];
        }
        return null;
    }

    public function offsetSet($offset, $value)
    {
        throw new \Exception('ReadOnly! Set not implemented');
    }

    public function offsetUnset($offset)
    {
        throw new \Exception('ReadOnly! Unset not implemented');
    }

}
