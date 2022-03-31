<?php

namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HistoryLog extends Model
{
    use HasFactory, SoftDeletes, LogsActivity, Userstamps;

    protected $fillable = [ 'pesan', 'modul', 'created_by', 'updated_by', 'deleted_by', ];

	protected static $logAttributes = [ 'pesan', 'modul', 'modul_id','created_by', 'updated_by', 'deleted_by',   ];
}
