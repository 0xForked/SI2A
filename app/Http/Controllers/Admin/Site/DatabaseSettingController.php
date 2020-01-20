<?php

namespace App\Http\Controllers\Admin\Site;

use Carbon\Carbon;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class DatabaseSettingController extends Controller
{

    public function create()
    {
        try {
            Artisan::call('backup:run --only-db');
            Artisan::output();
            Setting::where('key', 'site_db_last_backup')->update([
                'value' => Carbon::now()->toDateTimeString()
            ]);
            return redirect()->back()->with('success', 'Database backup successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', "Failed create new backup ${e}.");
        }
    }

    /**
     * Downloads a backup zip file.
     *
     */
    public function download($file_name)
    {
        $file = config('backup.backup.name') . '/' . $file_name;
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists($file)) {
            $fs = Storage::disk(config('backup.backup.destination.disks')[0])->getDriver();
            $stream = $fs->readStream($file);
            return \Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                "Content-Type" => $fs->getMimetype($file),
                "Content-Length" => $fs->getSize($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);
        } else {
            return redirect()->back()->with('error', "The backup file doesn't exist.");
        }
    }

    /**
     * Deletes a backup file.
     */
    public function delete($file_name)
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists(config('backup.backup.name') . '/' . $file_name)) {
            $disk->delete(config('backup.backup.name') . '/' . $file_name);
            return redirect()->back()->with('success', 'Database delete successfully');
        } else {
            return redirect()->back()->with('error', "The backup file doesn't exist.");
        }
    }

    public function restore(Request $request)
    {
        // store function
        $file_original_ext = $request->site_database->getClientOriginalExtension();
        if($file_original_ext !== 'sql') { // pathinfo($file_original_name, PATHINFO_EXTENSION)
            return redirect()->back()->with('error', "Failed to restore database, Invalid sql file.");
        }
        $file_new_name = "_database_restore.{$file_original_ext}";
        $request->site_database->storeAs('restore/', $file_new_name);
        // validate function
        $disk = Storage::disk('restore');
        if (!$disk->exists($file_new_name)) {
            return redirect()->back()->with('error', "Failed to restore database, Sql file not found.");
        }

        Artisan::call('migrate:reset', ['--force' => true]);

        DB::unprepared(File::get(storage_path('app/restore/').$file_new_name));

        unlink(storage_path('app/restore/'.$file_new_name));

        Auth::logout();

        return redirect('/login')->with('restore', 'Database berhasil direstore silahkan login kembali untuk mengakses aplikasi.');
    }

}
