<?php

declare (strict_types=1);

namespace TalkingBit\Hotel;

use Cassandra\Date;

final class BookingRequest
{

    private string $bookingId;
    private string $hotelId;
    private string $checkin;
    private string $checkout;
    private int $adults;
    private int $children;

    public function __construct(string $bookingId, string $hotelId, string $checkin, string $checkout, int $adults, int $children)
    {
        $this->bookingId = $bookingId;
        $this->hotelId = $hotelId;
        $this->checkin = $checkin;
        $this->checkout = $checkout;
        $this->adults = $adults;
        $this->children = $children;
    }

    public function proposals(Availability $availability)
    {
        $rooms = $availability->byHotelIdAndDates($this->hotelId, $this->checkin, $this->checkout);

        $nights = $this->nights();
        $adults = $this->adults;
        $children = $this->children;

        return $rooms->proposals($nights, $adults, $children);
    }

    private function nights(): int
    {
        $checkin = new \DateTimeImmutable($this->checkin);
        $checkout = new \DateTimeImmutable($this->checkout);

        return $checkout->diff($checkin)->days;
    }
}
