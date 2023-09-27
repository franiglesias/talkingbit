<?php

declare (strict_types=1);

namespace TalkingBit\Hotel;


final class Proposal
{

    private string $type;
    private float $price;

    public function __construct(string $type, float $price)
    {
        $this->type = $type;
        $this->price = $price;
    }

    public function print(): array
    {
        return [
            'room_type' => $this->type,
            'stay_price' => $this->price,
        ];
    }
}
