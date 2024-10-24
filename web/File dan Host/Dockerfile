# Gunakan image PHP bawaan dengan apache
FROM php:8.1-apache

# Salin file PHP ke direktori kerja dalam container
COPY index.php /var/www/html/index.php

# Salin file flag.txt ke /etc/flag.txt di dalam container
COPY flagg.txt /etc/flag.txt

# Salin folder 'list' berisi file teks ke dalam /var/www/html/list
COPY list /var/www/html/list

# Set permission agar file flag.txt dapat dibaca
RUN chmod 644 /etc/flag.txt

# Expose port 80 untuk akses HTTP
EXPOSE 80

