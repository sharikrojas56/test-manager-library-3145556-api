# test-manager-library-3145556-api

> **Prueba técnica · Ficha ADSO 3145556**
> Entrega: **martes 13 de octubre de 2026, a las 5:00 p. m.** (17:00, hora Colombia).

Este repositorio es el **backend** de *Manager Library*, en **PHP con Laravel** con arquitectura hexagonal. Basado en la especificación en `test-manager-library-3145556-docs/spec-php/`.

## 📋 Estado del Proyecto

### ✅ Completado
- **Estructura hexagonal** (Domain, Application, Infrastructure)
- **Migraciones iniciales** (categories, users, books según spec)
- **Endpoint `/health`** funcionando (T-01)
- **Configuración Laravel 11** con JWT authentication
- **Variables de entorno** seguras (.env.example)

### 🚧 En Progreso
- Modelo de dominio (aggregates, value objects)
- Casos de uso (application services)
- Adaptadores de persistencia
- Endpoints completos del API contract

## 🏗️ Arquitectura Hexagonal

```
app/
├── Domain/               # Aggregates, value objects (Article I)
├── Application/          # Use cases, ports (Article II)
├── Infrastructure/       # HTTP, persistence, security adapters
├── Providers/           # Service binding (Article III)
└── Console/             # Commands
```

## 🐳 Desarrollo con Docker

```bash
# 1. Levantar infraestructura (desde test-manager-library-3145556-infra)
make dev

# 2. Instalar dependencias
composer install

# 3. Configurar entorno
cp .env.example .env
php artisan key:generate
php artisan jwt:secret

# 4. Ejecutar migraciones
php artisan migrate

# 5. Iniciar servidor
php artisan serve
```

## 📚 Especificación Implementada

Basado en `spec-php/`:
- **API Contract:** `api-contract.md`
- **Data Model:** `data-model.md` 
- **Architecture:** `architecture.md`
- **ADR:** `adr/` (decisiones arquitectónicas)

## 🔗 Conexión a Base de Datos

Configurar en `.env`:
```env
DB_CONNECTION=pgsql
DB_HOST=postgres      # o 127.0.0.1
DB_PORT=5432
DB_DATABASE=manager_library
DB_USERNAME=manager_library
DB_PASSWORD=secretpassword
```

## 🧪 Pruebas

```bash
# Unit tests
php artisan test tests/Unit

# Feature tests  
php artisan test tests/Feature

# Architecture tests (Articles I-III)
php artisan test tests/Architecture
```

## 📦 Dependencias Principales

- Laravel 11
- JWT Auth (tymon/jwt-auth)
- PostgreSQL (pgsql)
- Doctrine DBAL

## ⚠️ Entrega

- **Hora límite:** 5:00 p.m. (17:00)
- **Commits pequeños:** Subir avances frecuentemente
- **Especificación:** Seguir `spec-php/` exactamente
- **Arquitectura:** Respetar Articles I-XII de constitution.md

---

**Nota:** Este proyecto sigue **Spec-Driven Development (SDD)**. El código implementa la especificación `spec-php/` traducida de Python/.NET a Laravel.
