<?php

declare (strict_types=1);

namespace TalkingBit\Hotel;


interface Availability
{
    public function byHotelIdAndDates(string $hotelId, string $checkin, string $checkout): AvailableRooms;
}
