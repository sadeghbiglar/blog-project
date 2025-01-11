<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackupController extends Controller
{
    public function createBackup()
    {
        try {
            // مسیر ذخیره فایل
            $backupPath = storage_path('app/backup');
            if (!file_exists($backupPath)) {
                mkdir($backupPath, 0777, true);
            }

            // نام فایل پشتیبان
            $fileName = 'backup_' . date('Y_m_d_H_i_s') . '.sql';

            // دستور برای پشتیبان‌گیری
            $command = sprintf(
                'mysqldump --user=%s --password=%s --host=%s %s > %s',
                env('DB_USERNAME'),   // نام کاربری دیتابیس
                env('DB_PASSWORD'),   // رمز عبور دیتابیس
                env('DB_HOST'),       // میزبان دیتابیس
                env('DB_DATABASE'),   // نام دیتابیس
                $backupPath . '/' . $fileName // مسیر ذخیره فایل
            );

            // اجرای دستور
            exec($command);

            // دانلود فایل پشتیبان
            return response()->download($backupPath . '/' . $fileName)->deleteFileAfterSend();
        } catch (\Exception $e) {
            return back()->with('error', 'خطا در ایجاد نسخه پشتیبان: ' . $e->getMessage());
        }
    }
}
