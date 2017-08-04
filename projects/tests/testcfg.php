<?php

    require_once './vendor/autoload.php';

    $code = "<?php function testf(\$param){	return [\$param, \"nono\"];}\$var = testf(\$_GET[\"p\"])[0];echo \$var;?>";
    
    $context = new \progpilot\Context;
    $analyzer = new \progpilot\Analyzer;

    $context->inputs->set_sources("./data/sources.json");
    $context->inputs->set_sinks("./data/sinks.json");
    $context->inputs->set_sanitizers("./data/sanitizers.json");
    $context->inputs->set_validators("./data/validators.json");
    $context->set_analyze_js(false);
    $context->set_analyze_includes(false);
    $context->inputs->set_code($code);
    try 
    {
        $analyzer->run($context);
    }
    catch (Exception $e) 
    {
        echo 'Exception : ',  $e->getMessage(), "\n";
    }
       
    $results = $context->outputs->get_ast();
    
    var_dump($results); 
?>



