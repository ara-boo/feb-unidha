<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OfficialSiteFeed
{
    /**
     * Mengambil berita terbaru dari situs WordPress resmi lewat REST API.
     * Hasil disimpan 30 menit supaya halaman tidak lambat, dan kembali kosong kalau gagal.
     */
    public static function latestPosts(string $siteUrl, int $limit = 3): array
    {
        $base = rtrim($siteUrl, '/');
        $key = 'official-feed:' . md5($base) . ':' . $limit;

        $cached = Cache::get($key);
        if ($cached !== null) {
            return $cached;
        }

        try {
            $response = Http::timeout(5)
                ->acceptJson()
                ->get($base . '/wp-json/wp/v2/posts', [
                    'per_page' => $limit,
                    '_embed'   => 1,
                ]);

            if (! $response->successful()) {
                return [];
            }

            $posts = collect($response->json())
                ->map(function ($post) use ($base) {
                    $link = $post['link'] ?? '';
                    $image = $post['_embedded']['wp:featuredmedia'][0]['source_url'] ?? null;

                    return [
                        'title' => html_entity_decode(
                            strip_tags($post['title']['rendered'] ?? ''),
                            ENT_QUOTES | ENT_HTML5,
                            'UTF-8'
                        ),
                        // Hanya tautan ke situs yang sama yang dipakai.
                        'link'  => Str::startsWith($link, $base) ? $link : null,
                        'date'  => $post['date'] ?? null,
                        'image' => ($image && Str::startsWith($image, 'http')) ? $image : null,
                    ];
                })
                ->filter(fn ($post) => $post['title'] !== '' && $post['link'])
                ->values()
                ->all();

            Cache::put($key, $posts, now()->addMinutes(30));

            return $posts;
        } catch (\Throwable $e) {
            Log::warning('Gagal mengambil berita situs resmi: ' . $e->getMessage());

            return [];
        }
    }
}