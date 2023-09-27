<?php

declare (strict_types=1);

namespace TalkingBit\Hotel;


final class CalculateProposalRequest
{

    private string $bookingId;

    public function __construct(string $bookingId)
    {
        $this->bookingId = $bookingId;
    }

    public function bookingId(): string
    {
        return $this->bookingId;
    }
}
