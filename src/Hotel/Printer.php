<?php

declare (strict_types=1);

namespace TalkingBit\Hotel;

interface Printer
{
    public function fill(array $data): void;

    public function print(): string;
}
