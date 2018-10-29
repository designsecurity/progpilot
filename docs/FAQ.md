# FAQ

#### Which version of PHP do I need ?
The minimum version of PHP needed to run Progpilot is 7.0.25

#### Where can I find the updated security files configuration (sinks, sources, validators, sanitizers and rules) of Progpilot ?
You can find the updated security files configuration of Progpilot in [package/src/uptodate_data](../package/src/uptodate_data) folder.

#### How can I use the various representations of programs ?
Example of control flow graph and call graph of source code transformed to dot format could be found [here](https://github.com/designsecurity/progpilot/blob/master/projects/tests/graphtest.php).

#### When I use progpilot I often run out of memory ?
Static analyzers use a lot of memory but you could try to handle this with [these functions](./API.md) :
- *$obj_context->setLimitDefs($nb);* 
- *$obj_context->setLimitSize($size_bytes);* 

And by increasing the maximum memory amount for a script (*memory_limit*) in the configuration of PHP (*php.ini*).

#### What frameworks are supported by progpilot ?
At this moment, these frameworks are supported :
- suiteCRM
- codeIgniter
- wordpress
