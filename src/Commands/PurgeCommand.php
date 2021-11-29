<?php

namespace Timgreenwood\Scout\Commands;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

class PurgeCommand extends Command
{

    /**
     * The URL for the scout api
     *
     * @var string
     */
    private const SCOUT_URL = 'https://scout.cloudabove.com/api/';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scout:purge';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Purge Cloudabove Scout cache';

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $client = new Client([
            'base_uri' => self::SCOUT_URL,
            'timeout' => 2.0,
            'headers' => [
                'Accept' => 'application/json',
            ],
            'http_errors' => false,
        ]);

        try {
            $response = $client->get('cache/purge');
            if ($response->getStatusCode() === 200) {
                $this->info(json_decode($response->getBody())->message);
            } else {
                $this->error(json_decode($response->getBody())->message);
            }
        } catch (GuzzleException $e) {
            $this->error($e->getMessage());
        }
    }
}
