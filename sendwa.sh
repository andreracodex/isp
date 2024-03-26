#!/bin/bash
# Change text color to black on light green
echo -e "\e[32;40m"
# Display the contents of banner.txt file
cat banner.txt
# Change directory to the specified path
cd "/home/u422026669/domains/berdikari.web.id/public_html/billing/"
# Run the PHP artisan command
php artisan send:tagihanwa
# Pause the script
read -p "Press Enter to continue..."
