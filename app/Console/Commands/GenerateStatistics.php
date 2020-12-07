<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Term;
use App\Models\Visited;
use App\Models\MostVisited;
use App\Models\MostRequested;

class GenerateStatistics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generatestatistics:fiveminutes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate statistics every 5 minutes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
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
        $terms = Term::select([
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
