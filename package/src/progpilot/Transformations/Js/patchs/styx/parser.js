var stack_1 = require("../collections/stack");
var idGenerator_1 = require("../util/idGenerator");
var index_1 = require("./passes/index");
var AstPreprocessing = require("./preprocessing/functionExpressionRewriter");
var statement_1 = require("./statements/statement");
var flow_1 = require("../flow");
function parse(program, options)
{
    var context = createParsingContext();
    var rewrittenProgram = AstPreprocessing.rewriteFunctionExpressions(program);
    var parsedProgram = parseProgram(rewrittenProgram, context);
    var functionFlowGraphs = parsedProgram.functions.map(function (func) {
        return func.flowGraph; });
    var flowGraphs = [parsedProgram.flowGraph].concat(functionFlowGraphs);
    index_1.runOptimizationPasses(flowGraphs, options);
    return parsedProgram;
}
exports.parse = parse;
function parseProgram(program, context)
{
    var entryNode = context.createNode(flow_1.NodeType.Entry);
    var successExitNode = context.createNode(flow_1.NodeType.SuccessExit);
    var errorExitNode = context.createNode(flow_1.NodeType.ErrorExit);
    var programFlowGraph = {
        entry: entryNode,
        successExit: successExitNode,
        errorExit: errorExitNode,
        nodes: [],
        edges: []
    };
    context.currentFlowGraph = programFlowGraph;


    var data_start = {
        "start_line" : program.loc.start.line,
        "end_line" : program.loc.end.line,
        "start_column" : program.loc.start.column,
        "end_column" : program.loc.end.column
    };

    var start_block_node = context.createNode().appendTo(entryNode, "start_node", data_start);

    var completion = statement_1.parseStatements(program.body, start_block_node, context);

    var last_statement = program.body[program.body.length - 1];

    var data_end = {
        "start_line" : last_statement.loc.start.line,
        "end_line" : last_statement.loc.end.line,
        "start_column" : last_statement.loc.start.column,
        "end_column" : last_statement.loc.end.column
    };

    var end_block_node = context.createNode().appendTo(completion.normal, "end_node", data_end);


    if (completion.normal) {
        successExitNode.appendEpsilonEdgeTo(end_block_node);
    }
    return {
        flowGraph: programFlowGraph,
        functions: context.functions
    };
}
function createParsingContext()
{
    var nodeIdGenerator = idGenerator_1.default.create();
    var functionIdGenerator = idGenerator_1.default.create();
    var variableNameIdGenerator = idGenerator_1.default.create();
    return {
        functions: [],
        currentFlowGraph: null,
        enclosingStatements: stack_1.Stack.create(),
        createTemporaryLocalVariableName: function (name) {
            var id = variableNameIdGenerator.generateId();
            return "$$" + name + id;
        },
        createNode: function (type) {
            if (type === void 0) {
                type = flow_1.NodeType.Normal; }
            var id = nodeIdGenerator.generateId();
            return new flow_1.FlowNode(id, type);
        },
        createFunctionId: function () {
              return functionIdGenerator.generateId();
        }
    };
}
