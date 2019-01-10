<?php

namespace App\Commands;

use App\Services\SaveAccountImageService;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class Crawling extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'crawling';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Crawling start';

    /**
     * @param SaveAccountImageService $service
     * @return int
     */
    public function handle(SaveAccountImageService $service)
    {
        $this->info("command: start");
        try {
            $fileName = $this->ask("TSVファイル名を入力");

            if ($fileName == "") {
               throw new \ErrorException("empty fileName");
            }

            $this->info("ファイル名 : $fileName");
            if ($this->confirm('この内容で実行してよろしいですか?')) {
                $service->execute($fileName);
            } else {
                $this->info('command: cancel');
            }
        } catch (\Throwable $e) {
            $this->error($e->getMessage());
            return 1;
        }
        $this->info("command: end");
        return 0;
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
