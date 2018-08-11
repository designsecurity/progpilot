<?php declare(strict_types=1);
class E
{
    private $var;
    public function get()
    {
        if (! $this->var) {
            $this->var = [];
            foreach (['str', $_GET['e']] as $key => $value) {
                $this->var[$key] = $value;
                echo $value;
                echo $key;
            }
        }
        return $this->var;
    }
}
