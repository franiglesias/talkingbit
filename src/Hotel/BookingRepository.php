<?php

declare (strict_types=1);

namespace TalkingBit\Hotel;


interface BookingRepository
{
    public function byBookingId(string $bookingId): BookingRequest;
}
