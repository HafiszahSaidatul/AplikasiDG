<?php

namespace App\Console\Commands;

use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearCompletedItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {


        try {
            $twoDaysAgo = Carbon::now()->subDays(2)->toDateTimeString();

            // Find items to delete
            $itemsToDelete = Item::where('status', 'complete')
                // ->where('updated_at', '<=', $twoDaysAgo)
                ->get();

            // Loop through each item and delete related records in the 'low' table first
            foreach ($itemsToDelete as $item) {
                $item->low()->delete(); // Assuming 'low' is the related method for 'low' table
                $item->pending()->delete(); // Assuming 'low' is the related method for 'low' table

                $item->delete(); // Now delete the item itself
            }

            $this->info('Deleted items and related records successfully.');
        } catch (\Throwable $th) {
            $this->error('Failed to delete items: ' . $th->getMessage());
        }
    }
}
