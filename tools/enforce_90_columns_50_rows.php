<?php

// php tools/enforce_90_columns_50_rows.php

$themes = scandir('themes/');

array_shift($themes); // `.`
array_shift($themes); // `..`

function handle_theme($theme) {
    $lines = explode(PHP_EOL, file_get_contents('themes/' . $theme));
    $has_columncount = false;
    $has_rowcount = false;
    $name_line = null;

    foreach ($lines as $i => $line) {
        if (str_contains($line, '<key>columnCount</key>')) {
            echo $lines[$i+1] . PHP_EOL;
            $lines[$i+1] = "\t<integer>90</integer>";
            $has_columncount = true;
        }

        if (str_contains($line, '<key>rowCount</key>')) {
            echo $lines[$i+1] . PHP_EOL;
            $lines[$i+1] = "\t<integer>50</integer>";
            $has_rowcount = true;
        }

        if (str_contains($line, '<key>name</key>')) {
            $name_line = $i;
        }

        // if (str_contains($line, '<key>FontHeightSpacing</key>')) {
        //     $lines[$i+1] = "\t<real>1</real>"; // e.g. monokai pro (filter spectrum) has custom line heights (breaks the screenshot)
        // }

        // if (str_contains($line, '<key>Font</key>')) {
        //     $lines[$i] = "\t<key>Font[DO NOT COMMIT]</key>"; // e.g. gruvbox contains a different font (breaks the screenshot)
        // }
    }

    if ($name_line === null) throw new LogicException();

    if (!$has_columncount) {
        $lines[$name_line] = "\t<key>columnCount</key>\n\t<integer>90</integer>\n" . $lines[$name_line];
    }

    if (!$has_rowcount) {
        $lines[$name_line+1] = $lines[$name_line+1] . "\n\t<key>rowCount</key>\n\t<integer>50</integer>";
    }

    file_put_contents('themes/' . $theme, implode(PHP_EOL, $lines));
}

foreach($themes as $theme) {
  echo $theme . PHP_EOL;
  handle_theme($theme);
}
