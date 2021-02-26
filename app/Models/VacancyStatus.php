<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacancyStatus extends Model
{
    public const statuses = [
        "CONTACTED" => "Contacted", //#DC7633
        "GOT_TASK" => "Got a test task", //#F4D03F
        "WAITING_FOR_FEEDBACK" => "Waiting for a feedback", //#99A3A4
        "SCREENING" => "Screening", //#58D68D
        "TECH_REVIEW" => "Technical review", //#A569BD
        "OFFER" => "Offer", //#1E8449
        "REFUSED" => 'Refused', //#C0392B
        "NO_RESPONSE" => "No response", //#A04000
    ];
}
