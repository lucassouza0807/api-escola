<?php

namespace App\Interfaces ;

interface MessageInterface
{
    public function sendMessageToCandidate($message, $candidate);
}