<?php

declare (strict_types=1);

namespace TalkingBit\Hotel;


final class StandardRoom extends Room
{

    private float $price;

    public function __construct(float $price)
    {
        $this->price = $price;
    }


    public function price($nights, $adults, $children): float
    {
        $priceForAdults = $this->price * $nights * $adults;
        $priceForChildren = $this->price * 0.80 * $nights * $children;

        return $priceForAdults + $priceForChildren;
    }

    public function type(): string
    {
        return "standard";
    }
}
