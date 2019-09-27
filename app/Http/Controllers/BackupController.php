<?php
/**
 * Created by PhpStorm.
 * User: amirreza
 * Date: 9/27/19
 * Time: 4:54 PM
 */

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class BackupController extends Controller
{
    public function index()
    {
        return view('owner.backup');
    }

    public function store()
    {
        $process = new Process(sprintf(
            'mysqldump -u%s %s > %s',
            config('database.connections.mysql.username'),
            config('database.connections.mysql.database'),
            storage_path('backups/backup.sql')
        ));

        try {
            $process->mustRun();
        } catch (ProcessFailedException $exception) {
            Log::error($exception);
        }
    }

}