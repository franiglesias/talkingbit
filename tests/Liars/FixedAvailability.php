<?php

declare (strict_types=1);

namespace Test\TalkingBit\Liars;

use TalkingBit\Hotel\Availability;
use TalkingBit\Hotel\AvailableRooms;

final class FixedAvailability implements Availability
{
    private AvailableRooms $availableRooms;

    public function __construct(AvailableRooms $availableRooms)
    {
        $this->availableRooms = $availableRooms;
    }


    public function byHotelIdAndDates(string $hotelId, string $checkin, string $checkout): AvailableRooms
    {
        return $this->availableRooms;
    }
}
