<?php

declare (strict_types=1);

namespace TalkingBit\Hotel;


final class Proposals
{
    private array $proposals = [];
    public function __construct()
    {
    }

    public function add($type, $price): void
    {
        $this->proposals[] = new Proposal($type, $price);
    }

    public function print(Array2JsonPrinter $printer): Printer
    {
        $data = [];
        foreach ($this->proposals as $proposal) {
            $data[] = $proposal->print();
        }
        $printer->fill($data);
        return $printer;
    }
}
