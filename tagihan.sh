#!/bin/bash
clear
cat banner.txt
cd "/home/u422026669/domains/berdikari.web.id/public_html/billing/"
php artisan send:tagihan
