<?php

declare (strict_types=1);

namespace Test\TalkingBit\Liars;

use TalkingBit\Hotel\BookingRepository;
use TalkingBit\Hotel\BookingRequest;

final class FixedBookingRepository implements BookingRepository
{
    private BookingRequest $booking;

    public function __construct(BookingRequest $booking)
    {
        $this->booking = $booking;
    }

    public function byBookingId(string $bookingId): BookingRequest
    {
        return $this->booking;

    }
}
