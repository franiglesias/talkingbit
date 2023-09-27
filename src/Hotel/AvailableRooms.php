<?php

declare (strict_types=1);

namespace TalkingBit\Hotel;


final class AvailableRooms
{
    private array $rooms = [];
    public function __construct()
    {
    }

    public function addRoom(string $type, float $price): void
    {
        $this->rooms[] = Room::ofType($type, $price);
    }

    public function proposals(int $nights, int $adults, int $children): Proposals
    {
        $proposals = new Proposals();
        foreach ($this->rooms as $room) {

            $price = $room->price($nights, $adults, $children);

            $proposals->add($room->type(), $price);
        }
        return $proposals;
    }

}
