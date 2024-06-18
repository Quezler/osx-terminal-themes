#!/bin/bash

# usage: bash tools/photo_all.sh (and then copy paste all those lines)

for file in themes/*; do
    if [ -f "$file" ]; then
        echo "bash tools/photo_one.sh \"$file\""
    fi
done
