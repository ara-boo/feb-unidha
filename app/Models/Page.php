<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    protected $fillable = ['title', 'slug', 'content', 'sort_order'];

    /**
     * Mengubah teks Markdown menjadi HTML.
     * Baris daftar berformat "- nilai | keterangan" ditampilkan sebagai kartu angka.
     */
    public static function markdown(?string $text): string
    {
        $lines = explode("\n", str_replace(["\r\n", "\r"], "\n", (string) $text));

        $html = '';
        $buffer = [];
        $stats = [];

        $flushText = function () use (&$buffer, &$html) {
            $chunk = trim(implode("\n", $buffer));

            if ($chunk !== '') {
                $html .= Str::markdown($chunk, [
                    'html_input' => 'strip',
                    'allow_unsafe_links' => false,
                ]);
            }

            $buffer = [];
        };

        $flushStats = function () use (&$stats, &$html) {
            if ($stats) {
                $html .= self::statGrid($stats);
            }

            $stats = [];
        };

        foreach ($lines as $line) {
            if (preg_match('/^[-*]\s+(.+?)\s+\|\s+(.+)$/', $line, $m)) {
                $flushText();
                $stats[] = [trim($m[1]), trim($m[2])];
            } else {
                $flushStats();
                $buffer[] = $line;
            }
        }

        $flushText();
        $flushStats();

        return str_replace('src="/storage/', 'src="' . asset('storage') . '/', $html);
    }

    private static function statGrid(array $stats): string
    {
        $cells = '';

        foreach ($stats as [$value, $label]) {
            $cells .= '<div class="stat-card"><p class="stat-value">' . e($value)
                . '</p><p class="stat-label">' . e($label) . '</p></div>';
        }

        return '<div class="stat-grid">' . $cells . '</div>';
    }

    /**
     * Memecah isi Markdown menjadi bagian (##) dan sub-bagian (###).
     * Mengembalikan array kosong kalau isi halaman tidak memakai judul ##.
     */
    public function sections(): array
    {
        $content = str_replace(["\r\n", "\r"], "\n", trim((string) $this->content));

        if ($content === '' || ! preg_match('/^##\s+/m', $content)) {
            return [];
        }

        $parts = preg_split('/^##\s+(.+)$/m', $content, -1, PREG_SPLIT_DELIM_CAPTURE);
        $intro = trim((string) array_shift($parts));

        $sections = [];

        for ($i = 0; $i < count($parts); $i += 2) {
            $title = trim($parts[$i]);
            $body = trim($parts[$i + 1] ?? '');

            $sub = preg_split('/^###\s+(.+)$/m', $body, -1, PREG_SPLIT_DELIM_CAPTURE);
            $lead = trim((string) array_shift($sub));

            $items = [];
            for ($j = 0; $j < count($sub); $j += 2) {
                $items[] = [
                    'title' => trim($sub[$j]),
                    'body'  => trim($sub[$j + 1] ?? ''),
                ];
            }

            // Bagian yang isinya hanya daftar singkat (misalnya nilai-nilai) tampil sebagai kartu kecil.
            $list = [];
            if ($lead !== '' && empty($items)) {
                $lines = array_values(array_filter(
                    array_map('trim', explode("\n", $lead)),
                    fn ($line) => $line !== ''
                ));
                $bullets = array_filter($lines, fn ($line) => preg_match('/^[-*]\s+/', $line));

                if (
                    count($lines) > 0
                    && count($lines) === count($bullets)
                    && ! preg_match('/\s\|\s/', $lead)
                ) {
                    $list = array_map(fn ($line) => trim(preg_replace('/^[-*]\s+/', '', $line)), $lines);
                    $lead = '';
                }
            }

            $sections[] = [
                'title'     => $title,
                'id'        => Str::slug($title) ?: 'bagian-' . (intdiv($i, 2) + 1),
                'lead'      => $lead,
                'items'     => $items,
                'list'      => $list,
                'is_vision' => Str::startsWith(Str::lower($title), 'visi'),
            ];
        }

        return ['intro' => $intro, 'sections' => $sections];
    }
}