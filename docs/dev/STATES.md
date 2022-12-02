# definition states API

Each definition has at least one state holding attributes like isTainted. The goal is to handle properties and array dataflow.

For simple variable, the defaultState is enough, as dataflow is correctly performed by visitorDataFlow:
```
// block 1
// foo defined in blockid 1 (defaultState = 1)
// state 1 of foo tainted
$foo = $_GET["p"]; 

if(rand()) {
    // block 2
    // bar defined in blockid 2 (defaultState = 2)
    // state 2 of foo bar (get value of foo->currentState()) tainted
    $bar = $foo;
}
else {
    // block 3
    // bar defined in blockid 3 (defaultState = 3)
    // state 3 of foo bar empty
    $bar = null;
}

// block 4
// bar search def:
//    * block2 $bar->getCurrentState()
//    * block3 $bar->getCurrentState()
// merge states on block 4 of echo_arg0
echo $bar;
```

For instances/properties variable, we need different states:
```
// block 1
// instance defined in blockid 1 (defaultState = 1)
$instance = new Object;

if(rand()) {
    // block 2
    // instance defined in blockid 1 (defaultState = 1)
    // state 2 of instance prop tainted
    $instance->prop = $_GET["p"]; 
    echo $instance->prop;
}
else {
    // block 3
    // instance defined in blockid 1 (defaultState = 1)
    // state 3 of instance prop "null"
    $instance->prop = "null";
    echo $instance->prop;
}

// block 4
// we launch dataflow analysis for properties
// parent of 4 = block 2, 3
// state 4 = merge(state 2,3)
echo $instance->prop;
```


Chained calls:
```
// block 1
// instance1 defined in blockid 1 (defaultState = 1)
$instance1 = new Object1;

/*
function func1() {
    // block 2
    // instance2 defined in blockid 2 (defaultState = 2)
    $instance2 = new Object2;
    return $instance2;
}

function func2() {
    // block 3
    // instance3 defined in blockid 3 (defaultState = 3)
    $instance3 = new Object3;
    return $instance3;
}

function func3() {
    echo $this->prop;
}
*/

$instance1->func1()->func2()->func3();
```