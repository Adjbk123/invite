<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parametre extends Model
{
   protected $fillable = [
    'website_name',
    'website_url',
    'meta_description',
    'address',
    'phone1',
    'phone2',
    'email1',
    'email2',
    'rccm',
    'ifu',
    'facebook',
    'twitter',
    'whatsapp',
    'youtube',
    'photo',
    'event_edition',
    'event_edition_ancienne',
    'event_edition_nouvelle',
    'event_date',
    'event_heure',
    'event_lieu',
    'event_motif',
];
}
