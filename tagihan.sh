#!/bin/bash
clear
cat banner.txt
cd "/public_html/billing"
php artisan send:tagihan
