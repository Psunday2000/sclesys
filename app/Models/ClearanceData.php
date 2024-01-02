<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClearanceData extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'registration_number',
        'name_of_student',
        'programme',
        'library_card_image',
        'id_card_image',
        'convocation_fee_rrr',
        'first_year_school_fees_image',
        'second_year_school_fees_image',
        'created_at',
        'updated_at'	
    ];
}
