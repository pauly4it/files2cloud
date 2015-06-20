<?php namespace App\Domain\Core;

use Illuminate\Bus\Queueable;

abstract class Job
{
    use Queueable;
}
