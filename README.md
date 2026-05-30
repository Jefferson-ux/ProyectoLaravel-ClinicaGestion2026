# MediaCare - Sistema de Gestión Clínica Integral 🏥

**MediaCare** es una plataforma web moderna para la optimización y administración de centros médicos. El sistema centraliza el control de especialidades, personal médico, expedientes de pacientes, programación de citas, emisión de recetas y flujos de pago, ofreciendo una interfaz reactiva de alta velocidad.

---

## 🚀 Herramientas y Stack Tecnológico

El proyecto despliega la arquitectura **TALL Stack** combinada con entornos de desarrollo de última generación:

* **Backend:** Laravel 12 (PHP 8.2+)
* **Frontend Interactivo:** Livewire 3 & Alpine.js
* **Diseño y Estilos:** Tailwind CSS & DaisyUI (UI Component Framework)
* **Entorno Local:** Laragon (Servidor Nginx/Apache + MySQL)
* **Editor de Código:** Cursor ("Visual Studio Deidad")
* **Gestor de Base de Datos:** DBeaver

---

## 📂 Estructura Principal del Proyecto

El sistema se rige bajo el patrón arquitectónico **MVC (Modelo-Vista-Controlador)** optimizado para componentes reactivos:

```text
mediacare/
├── app/
│   ├── Http/Controllers/   # Controladores (Lógica intermedia)
│   ├── Livewire/           # Componentes reactivos en PHP (Tablas, Buscadores)
│   └── Models/             # Modelos de Eloquent (Representación de la BD)
├── config/                 # Archivos de configuración global
├── database/
│   ├── migrations/         # Control de versiones de la Base de Datos en PHP
│   └── seeders/            # Datos de prueba automatizados
├── resources/
│   ├── css/app.css         # Configuración e inyección de Tailwind y DaisyUI
│   └── views/              # Vistas estructuradas en Blade
│       ├── layouts/        # Plantillas de diseño base (Breeze)
│       └── livewire/       # Interfaces reactivas correspondientes a Livewire
├── routes/
│   └── web.php             # Mapeo de rutas y accesos del sistema
└── .env                    # Variables de entorno y credenciales (Excluido de Git)
```


## 🛠️ Comandos de Instalación y Despliegue
Siga este orden estricto en su terminal Warp para inicializar el proyecto desde cero:

### Clonar e ingresar al directorio:
```bash
    cd /laragon/www/
    git clone <URL_DEL_REPOSITORIO> clinica
    cd clinica
```

### Instalar dependencias del Backend (PHP):
```bash
    composer install
```

### Instalar dependencias del Frontend (Node.js):
```bash
    npm install
```

### Configurar el entorno global:
Copie el archivo de ejemplo a un entorno local .env y configure sus credenciales de base de datos.
```bash
    cp .env.example .env
```






