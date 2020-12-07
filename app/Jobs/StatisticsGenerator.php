<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use App\Models\Term;
use App\Models\Visited;
use App\Models\MostVisited;
use App\Models\MostRequested;

class StatisticsGenerator implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Generate most visited statistics
        $visiteds = Visited::select([
            'item',
            DB::raw('COUNT(1) as views')
        ])
        ->groupBy('item')
        ->get();

        MostVisited::truncate();
        foreach ($visiteds as $visited) {
            (new MostVisited)
                ->fill([
                    'item' => $visited->item,
                    'views' => $visited->views,
                ])
                ->save();
        }

        // Generate most searched statistics
        $terms = Terms::select([
            'term',
            DB::raw('COUNT(1) as views')
        ])
        ->groupBy('term')
        ->get();
        foreach ($terms as $term) {
            (new MostRequested)
                ->fill([
                    'term' => $term->term,
                    'views' => $term->views,
                ])
                ->save();
        }

    }
}
