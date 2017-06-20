<?php

/*
 * This file is part of PHP-CFG, a Control flow graph implementation for PHP
 *
 * @copyright 2015 Anthony Ferrara. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */

namespace PHPCfg\Op\Expr;

use PHPCfg\Op\Expr;
use PhpCfg\Operand;

class Include_ extends Expr {
	const TYPE_INCLUDE = 1;
	const TYPE_INCLUDE_OPNCE = 2;
	const TYPE_REQUIRE = 3;
	const TYPE_REQUIRE_ONCE = 4;

	public $type;
	public $expr;

	public $included;

	public function __construct(Operand $expr, $type, array $attributes = []) {
		parent::__construct($attributes);
		$this->expr = $this->addReadRef($expr);
		$this->type = $type;
	}

	public function getVariableNames() {
		return ["expr", "result"];
	}


	public function getSubBlocks() {
		return ["included"];
	}
}
