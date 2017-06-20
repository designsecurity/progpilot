<?php

/*
 * This file is part of PHP-CFG, a Control flow graph implementation for PHP
 *
 * @copyright 2015 Anthony Ferrara. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */

namespace PHPCfg;

abstract class Op {

	protected $attributes = [];
	protected $writeVariables = [];

	public function __construct(array $attributes = []) {
		$this->attributes = $attributes;
	}

	public function getType() {
		return strtr(substr(rtrim(get_class($this), '_'), strlen(__CLASS__) + 1), '\\', '_');
	}

	public function getColumn() {
		return $this->getAttribute('startLine', -1);
	}

	public function getLine() {
		return $this->getAttribute('startLine', -1);
	}

	public function getFile() {
		return $this->getAttribute("filename", "unknown");
	}

	public function &getAttribute($key, $default = null) {
		if (!$this->hasAttribute($key)) {
			return $default;
		}
		return $this->attributes[$key];
	}

	public function setAttribute($key, &$value) {
		$this->attributes[$key] = $value;
	}

	public function hasAttribute($key) {
		return array_key_exists($key, $this->attributes);
	}

	public function getAttributes() {
		return $this->attributes;
	}

	abstract public function getVariableNames();

	abstract public function getSubBlocks();

	public function isWriteVariable($name) {
		return in_array($name, $this->writeVariables);
	}

	protected function addReadRef($op) {
		if (is_array($op)) {
			$new = [];
			foreach ($op as $key => $o) {
				$new[$key] = $this->addReadRef($o);
			}
			return $new;
		} elseif (!$op instanceof Operand) {
			return $op;
		}
		return $op->addUsage($this);
	}

	protected function addWriteRef($op) {
		if (is_array($op)) {
			$new = [];
			foreach ($op as $key => $o) {
				$new[$key] = $this->addWriteRef($o);
			}
			return $new;
		} elseif (!$op instanceof Operand) {
			return $op;
		}
		return $op->addWriteOp($this);
	}

}
