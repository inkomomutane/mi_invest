#!/bin/bash

# Usage: ./replace_op.sh /path/to/folder
# generate a script to rename all content in a folder as well as it file names 
# 




TARGET_DIR="${1:-.}"



# find "$TARGET_DIR" -type f -print0 | while IFS= read -r -d '' file; do
#     if grep -q 'bairros' "$file"; then
#         sed -i 's/bairros/neighborhoods/g' "$file"
#         echo "✅ Updated: $file"
#     fi
# done

SOURCE_NAME="negocio"
TARGET_NAME="businessRule"

# replace content in files
find "$TARGET_DIR" -type f -print0 | while IFS= read -r -d '' file; do
    if grep -q "$SOURCE_NAME" "$file"; then
        sed -i "s/$SOURCE_NAME/$TARGET_NAME/g" "$file"
        echo "✅ Updated content in: $file"
    fi
done
# rename file names  if folder does not exist create it

find "$TARGET_DIR" -type f -name "*$SOURCE_NAME*" -print0 | while IFS= read -r -d '' file; do
    new_file=$(echo "$file" | sed "s/$SOURCE_NAME/$TARGET_NAME/g")
    # Create the target directory if it doesn't exist

    target_dir=$(dirname "$new_file")
    mkdir -p "$target_dir"
    # Rename the file
    if [ -e "$new_file" ]; then
        echo "⚠️ Skipping rename for $file: Target file already exists."
        continue
    fi
    # Move the file to the new name

    mv "$file" "$new_file"
    echo "✅ Renamed file: $file to $new_file"
done