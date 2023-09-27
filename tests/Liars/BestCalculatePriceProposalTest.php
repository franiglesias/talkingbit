<?php

declare (strict_types=1);

namespace Test\TalkingBit\Liars;

use PHPUnit\Framework\TestCase;
use TalkingBit\Hotel\Array2JsonPrinter;
use TalkingBit\Hotel\AvailableRooms;
use TalkingBit\Hotel\BookingRequest;
use TalkingBit\Hotel\CalculatePriceProposal;
use TalkingBit\Hotel\CalculateProposalRequest;
use TalkingBit\Hotel\Proposals;

final class BestCalculatePriceProposalTest extends TestCase
{
    /** @test
     */
    public function shouldCalculateAllProposals(): void
    {
        $calculateProposal = $this->buildCalculateProposal();

        $request = new CalculateProposalRequest('bookingId');

        $proposals = $calculateProposal->forBooking($request);

        $this->verifyProposals($proposals);
    }

    private function buildCalculateProposal(): CalculatePriceProposal
    {
        $booking = new BookingRequest(
            'bookingId',
            'hotelId',
            '2024-09-18',
            '2024-09-22',
            2,
            1,
        );
        $bookingRepository = new FixedBookingRepository($booking);

        $availableRooms = new AvailableRooms();
        $availableRooms->addRoom('standard', 105.00);
        $availableRooms->addRoom('superior', 135.00);
        $availability = new FixedAvailability($availableRooms);

        return new CalculatePriceProposal(
            $bookingRepository,
            $availability
        );
    }

    public function verifyProposals(Proposals $proposals): void
    {
        $showed = $proposals->print(new Array2JsonPrinter())->print();
        $expected = <<<EOD
[{"room_type":"standard","stay_price":1176},{"room_type":"superior","stay_price":1485}]
EOD;

        self::assertJsonStringEqualsJsonString($expected, $showed);
    }
}
