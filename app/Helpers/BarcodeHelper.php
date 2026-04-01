<?php

if (!function_exists('generateBarcodeSVG')) {
    function generateBarcodeSVG(string $code, int $barWidth = 2, int $barHeight = 50): string
    {
        // Code-39 character map: 9 bits per char (1=wide, 0=narrow), bar/space alternate
        $charMap = [
            '0' => '000110100', '1' => '100100001', '2' => '001100001',
            '3' => '101100000', '4' => '000110001', '5' => '100110000',
            '6' => '001110000', '7' => '000100101', '8' => '100100100',
            '9' => '001100100', 'A' => '100001001', 'B' => '001001001',
            'C' => '101001000', 'D' => '000011001', 'E' => '100011000',
            'F' => '001011000', 'G' => '000001101', 'H' => '100001100',
            'I' => '001001100', 'J' => '000011100', 'K' => '100000011',
            'L' => '001000011', 'M' => '101000010', 'N' => '000010011',
            'O' => '100010010', 'P' => '001010010', 'Q' => '000000111',
            'R' => '100000110', 'S' => '001000110', 'T' => '000010110',
            'U' => '110000001', 'V' => '011000001', 'W' => '111000000',
            'X' => '010010001', 'Y' => '110010000', 'Z' => '011010000',
            '-' => '010000101', '.' => '110000100', ' ' => '011000100',
            '*' => '010010100',
        ];

        $code = strtoupper(preg_replace('/[^A-Z0-9\-\. ]/', '', $code));
        $fullCode = '*' . $code . '*';

        $narrowW = $barWidth;
        $wideW   = $barWidth * 3;
        $gapW    = $barWidth;

        $x = 0;
        $bars = [];

        foreach (str_split($fullCode) as $char) {
            if (!isset($charMap[$char])) continue;
            $pattern = $charMap[$char];

            foreach (str_split($pattern) as $i => $bit) {
                $w = ($bit === '1') ? $wideW : $narrowW;
                $isBar = ($i % 2 === 0);
                if ($isBar) {
                    $bars[] = ['x' => $x, 'w' => $w];
                }
                $x += $w;
            }
            $x += $gapW;
        }

        $totalWidth  = $x;
        $totalHeight = $barHeight + 12;

        $rects = '';
        foreach ($bars as $bar) {
            $rects .= sprintf(
                '<rect x="%d" y="0" width="%d" height="%d" fill="#000"/>',
                $bar['x'], $bar['w'], $barHeight
            );
        }

        return sprintf(
            '<svg xmlns="http://www.w3.org/2000/svg" width="%d" height="%d" viewBox="0 0 %d %d">%s</svg>',
            $totalWidth, $totalHeight, $totalWidth, $totalHeight, $rects
        );
    }
}
