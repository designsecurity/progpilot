/* vim: set shiftwidth=2 tabstop=2 noexpandtab textwidth=80 wrap : */
"use strict";

module.exports = walker;

function walker(astNode, functionTable, offset) {
	function stop() { throw stop; }
	var recurse = function (astNode) {
		if (!astNode || typeof astNode !== 'object' || !astNode.type) {
			return astNode;
		}

		// range based recursion: only recurse when the astNode is in range
		if (offset !== undefined && astNode.range &&
		    (astNode.range[0] > offset || astNode.range[1] < offset)) {
			return astNode;
		}

		var fn = functionTable[astNode.type] || functionTable.default || checkProps;
		return fn(astNode, recurse, stop);
	};
	var ret;
	try {
		ret = recurse(astNode);
	} catch (e) {
		if (e !== stop)
			throw e;
	}
	return ret;
}

function checkProps(node, recurse) {
	var mapped = {};
	Object.keys(node).forEach(function (key) {
		var prop = node[key];
		var ret = prop;
		if (Array.isArray(prop)) {
			ret = prop.map(recurse);
		} else {
			ret = recurse(prop);
		}

		mapped[key] = ret;
	});
	return mapped;
}

walker.checkProps = checkProps;
