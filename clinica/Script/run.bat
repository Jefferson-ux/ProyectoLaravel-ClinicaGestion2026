@echo off
echo 🏥 Iniciando Entorno de Desarrollo para MedaCare...

:: Abre el servidor de Laravel en una nueva ventana
start "Laravel Backend" cmd /k "php artisan serve"

:: Abre el servidor de Vite en otra ventana
start "Vite Frontend" cmd /k "npm run dev"

echo 🚀 ¡Servidores en ejecucion en ventanas independientes!