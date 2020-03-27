# Output

For a taint-style vulnerability the output of progpilot is:
```javascript
array(1) {
  [0]=>
  array(13) {
    ["source_name"]=>
    array(1) {
      [0]=>
      string(5) "$var1"
    }
    ["source_line"]=>
    array(1) {
      [0]=>
      int(9)
    }
    ["source_column"]=>
    array(1) {
      [0]=>
      int(80)
    }
    ["source_file"]=>
    array(1) {
      [0]=>
      string(85) "/dev/progpilot/projects/tests/tests/generic/alias1.php"
    }
    ["tainted_flow"]=>
    array(1) {
      [0]=>
      array(1) {
        [0]=>
        array(4) {
          ["flow_name"]=>
          string(11) "$_GET["p1"]"
          ["flow_line"]=>
          int(9)
          ["flow_column"]=>
          int(80)
          ["flow_file"]=>
          string(85) "/dev/progpilot/projects/tests/tests/generic/alias1.php"
        }
      }
    }
    ["sink_name"]=>
    string(4) "echo"
    ["sink_line"]=>
    int(14)
    ["sink_column"]=>
    int(138)
    ["sink_file"]=>
    string(85) "/dev/progpilot/projects/tests/tests/generic/alias1.php"
    ["vuln_name"]=>
    string(3) "xss"
    ["vuln_cwe"]=>
    string(6) "CWE_79"
    ["vuln_id"]=>
    string(64) "481a09c1d9c3b30ad07258810483884f193278d1218ce2897963ddbe93820353"
    ["vuln_type"]=>
    string(11) "taint-style"
  }
}
```

- *source_name*, *source_line*, *source_column* are arrays because it can exist many tainted sources for the same sink.  
- *tainted_flow* is also an array: each element of it is the tainted flow from the corresponding source.  
- *sink_name*, *vuln_name*, *vuln_cwe* are defined in [**sinks.json**](./SPECIFY_ANALYSIS.md) data file  

For a custom vulnerability the output is like below:
```javascript
array(1) {
  [0]=>
  array(9) {
    ["vuln_rule"]=>
    string(8) "MUST_NOT_VERIFY_DEFINITION"
    ["vuln_name"]=>
    string(25) "security misconfiguration"
    ["vuln_line"]=>
    int(3)
    ["vuln_column"]=>
    int(7)
    ["vuln_file"]=>
    string(85) "/dev/progpilot/projects/tests/tests/custom/custom4.php"
    ["vuln_description"]=>
    string(51) "Twig_Environment autoescaping should be set to true"
    ["vuln_cwe"]=>
    string(8) "CWE_1004"
    ["vuln_id"]=>
    string(64) "5d19e741522c27c5e6422086e00fffb6436a9bed241efb0180b720530c711834"
    ["vuln_type"]=>
    string(6) "custom"
  }
}
```
- *vuln_rule*, *vuln_description*, *vuln_name*, *vuln_cwe* are defined in [**rules.json**](./CUSTOM_ANALYSIS.md) data file  

Use *vuln_type* element (which takes the value *custom* or *taint-style*) to distinguish the kind of vulnerability.
