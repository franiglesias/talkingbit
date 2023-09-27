<?php

declare (strict_types=1);

namespace TalkingBit\Hotel;


final class Array2JsonPrinter implements Printer
{
    private array $data;


    public function fill(array $data): void
    {
        $this->data = $data;
    }

    public function print(): string
    {
        return json_encode($this->data);
    }
}
