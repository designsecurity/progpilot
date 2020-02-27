<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Representations;

class DFSVisitor
{
    private $rules;
    private $context;

    public function __construct($context, $rules)
    {
        $this->rules = $rules;
        $this->context = $context;
    }

    public function initializeNode($node)
    {
        $node->setColor("white");
        $node->setNbViews(0);
    }

    public function examineNode($node)
    {
        $node->setNbViews($node->getNbViews() + 1);

        foreach ($this->rules as $rule) {
            foreach ($rule->getSequence() as $sequence) {
                if ($node->getName() === $sequence->getName()
                    && ((!$sequence->isInstance() && is_null($node->getMyClass()))
                        || (!is_null($node->getMyClass()) && $sequence->isInstance()
                            && $sequence->getInstanceOfName() === $node->getMyClass()->getName()))) {
                    $mod = count($rule->getSequence());
                    $rule->setCurrentOrderNumber($rule->getCurrentOrderNumber() + 1);

                    if (($rule->getCurrentOrderNumber() % $mod)
                                !== ($sequence->getOrderNumberExpected() % $mod)) {
                        $hashIdVuln = hash("sha256", $node->getLine()."-".$rule->getAction()."-".$node->getFile());

                        if (is_null($this->context->inputs->getFalsePositiveById($hashIdVuln))) {
                            $temp["vuln_rule"] = \progpilot\Utils::encodeCharacters($rule->getAction());
                            $temp["vuln_line"] = $node->getLine();
                            $temp["vuln_column"] = $node->getColumn();
                            $temp["vuln_file"] = \progpilot\Utils::encodeCharacters($node->getFile());
                            $temp["vuln_description"] = \progpilot\Utils::encodeCharacters($rule->getDescription());
                            $temp["vuln_name"] = \progpilot\Utils::encodeCharacters($rule->getAttack());
                            $temp["vuln_cwe"] = \progpilot\Utils::encodeCharacters($rule->getCwe());
                            $temp["vuln_id"] = $hashIdVuln;
                            $temp["vuln_type"] = "custom";
                            
                            $this->context->outputs->addResult($temp);
                        }
                    }
                }
            }
        }
    }

    public function examineNodeTarget($node)
    {
        if ($node->getNbViews() >= $node->getNbParents()) {
            $node->setColor("black");
        }
    }
}
