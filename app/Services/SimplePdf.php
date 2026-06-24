<?php

namespace App\Services;

class SimplePdf
{
    public function renderTextReport(string $title, array $lines): string
    {
        $pages = array_chunk($lines, 44);
        $objects = [];
        $pageIds = [];
        $fontId = 3;
        $nextId = 4;

        $objects[1] = '<< /Type /Catalog /Pages 2 0 R >>';
        $objects[$fontId] = '<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>';

        foreach ($pages as $pageLines) {
            $pageId = $nextId++;
            $contentId = $nextId++;
            $pageIds[] = $pageId;

            $stream = $this->contentStream($title, $pageLines);
            $objects[$pageId] = "<< /Type /Page /Parent 2 0 R /MediaBox [0 0 612 792] /Resources << /Font << /F1 {$fontId} 0 R >> >> /Contents {$contentId} 0 R >>";
            $objects[$contentId] = "<< /Length ".strlen($stream)." >>\nstream\n{$stream}\nendstream";
        }

        $objects[2] = '<< /Type /Pages /Kids ['.implode(' ', array_map(fn ($id) => "{$id} 0 R", $pageIds)).'] /Count '.count($pageIds).' >>';
        ksort($objects);

        $pdf = "%PDF-1.4\n";
        $offsets = [0];

        foreach ($objects as $id => $object) {
            $offsets[$id] = strlen($pdf);
            $pdf .= "{$id} 0 obj\n{$object}\nendobj\n";
        }

        $xrefOffset = strlen($pdf);
        $pdf .= "xref\n0 ".(count($objects) + 1)."\n";
        $pdf .= "0000000000 65535 f \n";

        for ($i = 1; $i <= count($objects); $i++) {
            $pdf .= sprintf("%010d 00000 n \n", $offsets[$i]);
        }

        $pdf .= "trailer\n<< /Size ".(count($objects) + 1)." /Root 1 0 R >>\n";
        $pdf .= "startxref\n{$xrefOffset}\n%%EOF";

        return $pdf;
    }

    private function contentStream(string $title, array $lines): string
    {
        $commands = [
            'BT',
            '/F1 18 Tf',
            '72 742 Td',
            '('.$this->escape($title).') Tj',
            '/F1 10 Tf',
            '0 -28 Td',
        ];

        foreach ($lines as $line) {
            $commands[] = '('.$this->escape((string) $line).') Tj';
            $commands[] = '0 -14 Td';
        }

        $commands[] = 'ET';

        return implode("\n", $commands);
    }

    private function escape(string $text): string
    {
        $text = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text) ?: $text;

        return str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], $text);
    }
}
