<?php

declare (strict_types=1);

namespace Test\TalkingBit\Liars;

use PHPUnit\Framework\TestCase;
use TalkingBit\Hotel\Array2JsonPrinter;
use TalkingBit\Hotel\Availability;
use TalkingBit\Hotel\AvailableRooms;
use TalkingBit\Hotel\BookingRepository;
use TalkingBit\Hotel\BookingRequest;
use TalkingBit\Hotel\CalculatePriceProposal;
use TalkingBit\Hotel\CalculateProposalRequest;


final class GoodCalculatePriceProposalTest extends TestCase
{
    /** @test
     */
    public function shouldCalculateAllProposals(): void
    {
        $booking = new BookingRequest(
            'bookingId',
            'hotelId',
            '2024-09-18',
            '2024-09-22',
            2,
            1,
        );

        $availableRooms = new AvailableRooms();
        $availableRooms->addRoom('standard', 105.00);
        $availableRooms->addRoom('superior', 135.00);

        $bookingRepository = $this->createStub(BookingRepository::class);
        $availability = $this->createStub(Availability::class);

        $bookingRepository
            ->method('byBookingId')
            ->willReturn($booking);
        $availability
            ->method('byHotelIdAndDates')
            ->willReturn($availableRooms);

        $calculateProposal = new CalculatePriceProposal(
            $bookingRepository,
            $availability
        );

        $request = new CalculateProposalRequest('bookingId');
        $proposals = $calculateProposal->forBooking($request);
        $showed = $proposals->print(new Array2JsonPrinter())->print();
        $expected = <<<EOD
[{"room_type":"standard","stay_price":1176},{"room_type":"superior","stay_price":1485}]
EOD;

        self::assertJsonStringEqualsJsonString($expected, $showed);
    }
}
