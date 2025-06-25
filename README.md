# 🧠 Smart Inventory API – Laravel 12 + Sanctum + Docker

API RESTful para la gestión de inventario, productos, usuarios y categorías, con control de roles (`admin`, `user`), autenticación mediante Laravel Sanctum, arquitectura en capas y despliegue automático vía Docker.

---

## 🚀 Tecnologías Usadas

* PHP 8.3
* Laravel 12
* Sanctum (API Token Authentication)
* PostgreSQL
* Docker / Docker Compose
* Postman
* Git & GitHub

---

## 📦 Características Principales

* 🔐 Registro y autenticación de usuarios con tokens
* 🛡️ Protección por roles `admin | user`
* 🗂️ CRUD completo de productos y categorías
* ✅ Validación desacoplada con `FormRequest`
* ♻️ Arquitectura limpia y escalable (Controllers → Services → Models → Resources → Requests)
* 🔍 Búsqueda y detalles de productos
* 🚫 Acceso denegado a usuarios no autorizados
* 🐳 Despliegue 100% automatizado vía Docker
* 🧪 Pruebas con Postman / Swagger
* 📚 Documentación clara y detallada

---

## 🖥️ Requisitos del Sistema

* Docker & Docker Compose

---

## ⚙️ Instalación Local Rápida

```bash
git clone https://github.com/Jhormanarias/API-Inventory-Management.git
cd API-Inventory-Management
cp .env.example .env
cd api
cp .env.example .env
docker compose up --build
```

👉 Laravel se ejecutará en: `http://localhost:8000`

En caso de obtener algún error o que laravel no se ejecute correctamente,
verificamos que docker si haya instalado correctamente composer y ejecutamos las migraciones con el seeder del usuario admin.

User admin:
email: admin@example.com
password: 123456

De ser ese el caso, ejecutamos:
```bash
docker exec -it api-inventory-management-api-smart-talent-1 bash
composer install
php artisan migrate:fresh --seed
//Lo siguiente es para evitar el error de permisos con storage
cd /var/www
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
ctrl + D para salir del contenedor
```
---

## 🗝️ Variables de Entorno (ejemplo .env)

Para facilitar la instalación puse credenciales genéricas en el .env.example y si se ejecutó por consola los pasos anteriores no deberíamos tener ningún problema

```env
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=inventory_db
DB_USERNAME=postgres
DB_PASSWORD=secret

APP_URL=http://localhost:8000
```

---

## 🔐 Autenticación

### Registro `/api/register`

* Usuarios normales se registran como `user`.
* Solo `admin` autenticados pueden registrar usuarios con rol `admin`.

### Login `/api/login`

Devuelve token de autenticación.

### Logout `/api/logout`

Invalida el token actual.

---

## 🛒 Endpoints del Inventario

### Productos (`/api/products`)

| Método | Ruta           | Rol requerido |
| ------ | -------------- | ------------- |
| GET    | /products      | Auth          |
| GET    | /products/{id} | Auth          |
| POST   | /products      | Admin         |
| PUT    | /products/{id} | Admin         |
| DELETE | /products/{id} | Admin         |

### Categorías (`/api/categories`)

| Método | Ruta             | Rol requerido |
| ------ | ---------------- | ------------- |
| GET    | /categories      | Auth          |
| POST   | /categories      | Admin         |
| PUT    | /categories/{id} | Admin         |
| DELETE | /categories/{id} | Admin         |

---

## 📑 Validación

* Todas las peticiones pasan por clases `FormRequest`
* Mensajes personalizados y respuestas estructuradas en JSON
* Errores manejados con try/catch en capa `Service`

---

## 🧱 Estructura del Proyecto

```
app/
├── Http/
│   ├── Controllers/
│   ├── Requests/
│   ├── Resources/
│   ├── Services/
│   └── Middleware/
├── Models/
routes/
├── api.php
```

---

## 🧪 Pruebas de API

### Postman

Archivo: (./docs/postman_collection.json)

* Registra usuarios
* Autenticación (Login / Logout)
* Crear / listar / editar / eliminar productos y categorías


---

## 🌍 Despliegue Público

La api se desplegó en un VPS propio con ubuntu 22.04 y se desplegó de la misma manera probandolo como si fuese en local.
Se le añadió un proxy inverso con nginx para acceder desde la siguiente ruta con certificado SSL para conexión segura.

👉 API desplegada en:
`https://api-inventory-management.ganantech.com`

Todas las rutas tanto en localhost como en la api pública están dentro de api, ejemplo:
`https://api-inventory-management.ganantech.com/api/products`
`https://api-inventory-management.ganantech.com/api/categories`

---

## 📌 Decisiones de diseño

| Tema                   | Decisión                                                      |
| ---------------------- | ------------------------------------------------------------- |
| Enum vs tabla de roles | Se usó `enum('admin','user')` para simplificar                |
| Middleware de rol      | Implementado como `EnsureUserIsAdmin.php`                     |
| Autenticación          | Laravel Sanctum por su simplicidad para APIs RESTful          |
| Arquitectura           | Controllers delegan en `Services`, respuestas con `Resources` |
| Base de datos          | PostgreSQL con relaciones, integridad referencial y cascadas  |

---

## 🧠 Buenas prácticas aplicadas

* Código limpio (KISS, SOLID)
* Principio de responsabilidad única (SRP)
* Inyección de dependencias
* Separación de capas y responsabilidades
* Uso de recursos para respuestas API
* Manejo explícito de errores

---

## 👨‍💻 Autor

**Jhorman Arías**
Desarrollador Backend PHP (Laravel)
GitHub: [@Jhormanarias](https://github.com/Jhormanarias)

---
