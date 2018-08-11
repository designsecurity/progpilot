<?php declare(strict_types = 1);

include("test10C.php");

class B
{
    /** @var C */
    private $inner;
    public function __construct(array $inner)
    {
        $this->inner = new C($inner);
    }
    /**
     * @return mixed
     */
    public function getSource(string $index)
    {
        return $this->inner->getSource($index);
    }
}
