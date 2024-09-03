<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourQuery extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'starting_date',
        'return_date',
        'airline_choice',
        'visiting_country',
        'visiting_cities',
        'airline_ticket_category',
        'number_of_adults',
        'number_of_children',
        'accommodation_typer',
        'number_of_rooms',
        'foods_included',
        'guide_required',
        'private_transport',
        'special_requirement',
    ];
}
