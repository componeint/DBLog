<?php

namespace App\Components\DBLog\Models;

use Illuminate\Database\Eloquent\Model;

class DBLog extends Model
{
    protected $table      = 'dblog';
    protected $primaryKey = 'id';
    protected $fillable   = [
        "level",
        "message",
        "request_full_url",
        "request_url",
        "request_uri",
        "request_method",
        "devices",
        "os",
        "os_version",
        "browser_name",
        "browser_version",
        "browser_accept_language",
        "robot",
        "client_ip",
    ];
}
