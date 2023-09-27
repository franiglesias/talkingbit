<?php

declare (strict_types=1);

namespace TalkingBit\Hotel;


abstract class Room
{

    public static function ofType(string $type, float $price): Room
    {
        switch ($type) {
            case 'standard':
                return new StandardRoom($price);
            case 'superior':
                return new SuperiorRoom($price);
        }
        throw new \InvalidArgumentException('Unsupported room type');
    }

    abstract public function price($nights, $adults, $children): float;
    abstract public function type(): string;
}
