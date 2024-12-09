<?php

namespace App\Enums;

class StatusEnum
{
    const CREATE_ORDER = "Create Order";
    const AWAITING_DEPOSIT = "Awaiting Deposit";
    const CONFIRMING_DEPOSIT = "Confirming Deposit";
    const EXCHANGING = "Exchanging";
    const SENDING = "Sending";
    const COMPLETE = "Complete";
    const REFUND = "Refund";
    const FAILED = "Failed";
    const ACTION_REQUEST = "Action Request";
}

