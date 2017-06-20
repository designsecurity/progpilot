var statement_1 = require("./statement");
function parseBlockStatement(blockStatement, currentNode, context) {

	var data_start = { 
		"start_line" : blockStatement.loc.start.line,
		"end_line" : blockStatement.loc.end.line,
		"start_column" : blockStatement.loc.start.column,
		"end_column" : blockStatement.loc.end.column
	};

	var start_block_node = context.createNode().appendTo(currentNode, "start_node", data_start);

	var block = statement_1.parseStatements(blockStatement.body, start_block_node, context);

	var last_statement = blockStatement.body[blockStatement.body.length - 1];

	var data_end = { 
		"start_line" : last_statement.loc.start.line,
		"end_line" : last_statement.loc.end.line,
		"start_column" : last_statement.loc.start.column,
		"end_column" : last_statement.loc.end.column
	};

	var end_block_node = context.createNode().appendTo(block.normal, "end_node", data_end);

	return { normal: end_block_node };

	//return statement_1.parseStatements(blockStatement.body, currentNode, context);
}
exports.parseBlockStatement = parseBlockStatement;
