# Usa PHP 8.3 como base
FROM php:8.3


# Copia todos los archivos del proyecto al contenedor
COPY . /var/www/html/

# Establece el directorio de trabajo
WORKDIR /var/www/html/

# Expone el puerto 9100
EXPOSE 9100

# Comando para iniciar el servidor en 0.0.0.0 (permite conexión desde otras máquinas)
CMD ["php", "-S", "0.0.0.0:9100", "-t", "/var/www/html"]
