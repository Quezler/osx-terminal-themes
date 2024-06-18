#!/bin/bash

# usage: bash tools/photo_one.sh "themes/Afterglow.terminal"

open "${*}"
osascript tools/preview.scpt
#convert tools/screenshot-in.png -crop 640x340+0+90 tools/screenshot-out.png
convert tools/screenshot-in.png -crop 730x365+0+40 tools/screenshot-out.png

screenshot="${*/themes/screenshots}"
screenshot=$(echo "$screenshot" | tr '[:upper:]' '[:lower:]' | tr ' ' '_' | tr '(' '_' | tr ')' '_')
screenshot="${screenshot/.terminal/.png}"

echo $screenshot
cp tools/screenshot-out.png $screenshot
