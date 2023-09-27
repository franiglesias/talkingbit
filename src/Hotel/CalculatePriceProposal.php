<?php

declare (strict_types=1);

namespace TalkingBit\Hotel;


final class CalculatePriceProposal
{

    private BookingRepository $bookingRepository;
    private Availability $availability;

    public function __construct(BookingRepository $bookingRepository, Availability $availability)
    {
        $this->bookingRepository = $bookingRepository;
        $this->availability = $availability;
    }

    public function forBooking(CalculateProposalRequest $request)
    {
        $bookingId = $request->bookingId();

        $booking = $this->bookingRepository->byBookingId($bookingId);

        return $booking->proposals($this->availability);
    }
}
