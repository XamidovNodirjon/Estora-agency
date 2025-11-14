<?php

namespace App\Console\Commands;

use App\Models\CurrencyRate;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchExchangeRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-exchange-rates';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch currency rates from exchangerate.host';

    /**
     * Execute the console command.
     */


    public function handle()
    {
        $response = Http::withHeaders([
            'apikey' => config('services.exchangerate.key'),
        ])->get(config('services.exchangerate.base_url').'latest', [
            'base' => 'UZS',
            'symbols' => 'USD,EUR'
        ]);


        if ($response->successful()) {
            $rates = $response->json('rates');
            CurrencyRate::updateOrCreate(
                ['base' => 'UZS'],
                ['rates' => $rates, 'fetched_at' => now()]
            );
            $this->info('Currency rates updated!');
        } else {
            $this->error('API error: ' . $response->body());
        }
    }




}
