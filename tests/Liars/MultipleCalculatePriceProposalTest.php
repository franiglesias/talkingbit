<?php

declare (strict_types=1);

namespace Test\TalkingBit\Liars;

use ApprovalTests\Approvals;
use ApprovalTests\CombinationApprovals;
use PHPUnit\Framework\TestCase;
use TalkingBit\Hotel\Array2JsonPrinter;
use TalkingBit\Hotel\AvailableRooms;
use TalkingBit\Hotel\BookingRequest;
use TalkingBit\Hotel\CalculatePriceProposal;
use TalkingBit\Hotel\CalculateProposalRequest;
use TalkingBit\Hotel\Proposals;


final class MultipleCalculatePriceProposalTest extends TestCase
{
    /** @test
     */
    public function shouldCalculateAllProposals(): void
    {
        $checkin = ['2024-09-18', '2024-09-19', '2024-09-20', '2024-09-21'];
        $checkout = ['2024-09-22'];
        $adults = [1, 2];
        $children = [0, 1, 2];
        $standardPrice = [80.45, 105.00, 120.47];
        $superiorPrice = [90.65, 135.00, 230.43];

        CombinationApprovals::verifyAllCombinations6(
            [$this, 'calculateProposals'],
            $checkin,
            $checkout,
            $adults,
            $children,
            $standardPrice,
            $superiorPrice
        );
    }

    public function calculateProposals(string $checkin, string $checkout, int $adults, int $children, float $standardPrice, float $superiorPrice): string
    {
        $booking = new BookingRequest(
            'bookingId',
            'hotelId',
            $checkin,
            $checkout,
            $adults,
            $children,
        );
        $bookingRepository = new FixedBookingRepository($booking);

        $availableRooms = new AvailableRooms();
        $availableRooms->addRoom('standard', $standardPrice);
        $availableRooms->addRoom('superior', $superiorPrice);
        $availability = new FixedAvailability($availableRooms);

        $calculateProposal = new CalculatePriceProposal(
            $bookingRepository,
            $availability
        );

        $request = new CalculateProposalRequest('bookingId');

        $proposals = $calculateProposal->forBooking($request);

        return $proposals->print(new Array2JsonPrinter())->print();
    }
}
