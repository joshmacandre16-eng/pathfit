#!/bin/bash
cd c:/xampp1/htdocs/pathfit/resources/views

# Replace content-wrapper with content in all blade files
find . -name "*.blade.php" -type f ! -path "./layouts/*" -exec sed -i 's/<div class="content-wrapper">/<div class="content">/g' {} \;
echo "Done"

