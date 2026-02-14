# 📦 Sistema de Gestión de Inventario

Sistema moderno y flexible de gestión de inventario desarrollado con Laravel 12 y Filament 5.

Perfecto para gestionar cualquier tipo de productos: tiendas retail, almacenes, equipamiento, suministros o cualquier negocio que necesite control de stock.

## ✨ Características

- 📦 **Gestión Universal de Productos**: Administra productos con operaciones CRUD completas, control de precios, costos y niveles de stock
- 📊 **Dashboard Interactivo**: Estadísticas y tendencias en tiempo real con visualizaciones de Chart.js
  - Tarjetas de resumen con tendencias de últimos 7 días
  - Gráfico de barras: Top 10 productos con mayor stock
  - Gráfico circular: Distribución de productos por categoría
- 🏷️ **Categorías Personalizables**: Sistema flexible de categorías adaptable a cualquier industria
- 🚚 **Gestión de Proveedores**: Rastrea y administra tus proveedores con información de contacto completa
- 📈 **Seguimiento de Movimientos**: 
  - Historial completo de entradas, salidas y ajustes de inventario
  - Actualización automática de stock mediante observadores
  - Trazabilidad completa con referencias y notas
- 🎨 **Tema Moderno**: Diseño profesional con colores ámbar personalizables
- 📱 **Diseño Responsive**: Funciona perfectamente en escritorio, tablet y móvil
- 🔄 **Actualización en Tiempo Real**: Stock actualizado automáticamente con cada movimiento

## 🎯 Casos de Uso

Este sistema es perfecto para:
- 🏪 **Tiendas Retail**: Gestiona el inventario de productos para negocios
- 📦 **Almacenes**: Controla niveles y movimientos de stock
- 🏢 **Oficinas**: Rastrea equipamiento y suministros
- 🔧 **Talleres**: Administra herramientas y materiales
- 💊 **Farmacias**: Control de inventario de medicamentos
- 🍽️ **Restaurantes**: Gestión de ingredientes y suministros
- 🖥️ **Tiendas de Tecnología**: Componentes de hardware y accesorios
- ¡Y cualquier negocio que necesite control de inventario!

## 🛠️ Stack Tecnológico

- **Backend**: Laravel 12
- **Panel Admin**: Filament 5
- **Base de Datos**: MySQL
- **Frontend**: Tailwind CSS
- **Gráficos**: Chart.js
- **Iconos**: Heroicons
- **Build Tool**: Vite

## 📋 Requisitos

- PHP 8.2 o superior
- Composer
- Node.js y NPM
- MySQL 8.0 o superior
- Servidor web (Apache/Nginx) o XAMPP

## 🚀 Instalación

1. Clona el repositorio
```bash
git clone https://github.com/FedeCtr/sistema-gestion-inventario.git
cd sistema-gestion-inventario
```

2. Instala las dependencias de PHP
```bash
composer install
```

3. Instala las dependencias de NPM
```bash
npm install
```

4. Copia el archivo de entorno
```bash
cp .env.example .env
```

5. Genera la clave de la aplicación
```bash
php artisan key:generate
```

6. Configura tu base de datos en `.env`
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventario_db
DB_USERNAME=root
DB_PASSWORD=
```

7. Ejecuta las migraciones y seeders
```bash
php artisan migrate --seed
```

**Nota**: Los seeders crearán datos de ejemplo:
- 10 categorías (Motherboards, Processors, Graphics Cards, etc.)
- 50 productos con datos aleatorios
- Proveedores asociados

8. Compila los assets
```bash
npm run build
# o para desarrollo:
npm run dev
```

9. Inicia el servidor de desarrollo
```bash
php artisan serve
# o usa XAMPP y accede desde http://localhost/inventory_system/public
```

10. Accede al panel de administración en `http://localhost:8000/admin`

**Nota**: Deberás crear un usuario administrador con:
```bash
php artisan make:filament-user
```

## 🎨 Personalización

### Colores del Tema
El sistema usa un tema con colores ámbar como color primario. Puedes modificar los colores en:
```php
// app/Providers/Filament/AdminPanelProvider.php
->colors([
    'primary' => Color::Amber,
])
```

### Fuente Personalizada
El sistema usa la fuente **Poppins**. Puedes cambiarla en:
```php
// app/Providers/Filament/AdminPanelProvider.php
->font('Poppins')
```

### Widgets del Dashboard
Los widgets del dashboard se pueden personalizar en:
```
app/Filament/Widgets/
├── CardsWidgets.php        # Tarjetas de resumen
├── ChartBarWidget.php      # Gráfico de barras (Top 10 productos)
└── ChartPieWidget.php      # Gráfico circular (Categorías)
```

### Iconos de Navegación
Los iconos se configuran en cada recurso usando Heroicons:
```php
protected static string|BackedEnum|null $navigationIcon = Heroicon::Squares2x2;
```

## 📊 Módulos Principales

### Productos
- CRUD completo de productos
- SKU único para identificación
- Control de precio y costo
- Stock actual y mínimo
- Descripción detallada
- Relación con categoría y proveedor
- Campos con validación y selectores searchable

### Categorías
- Organización simple y eficiente
- Gráfico circular en dashboard
- Estadísticas por categoría
- Relación one-to-many con productos

### Proveedores
- Información completa de contacto (email, teléfono, dirección)
- Relación con productos suministrados
- Gestión centralizada

### Movimientos de Stock
- **Tipos de movimiento**:
  - `in`: Entrada de stock (suma)
  - `out`: Salida de stock (resta)
  - `adjust`: Ajuste directo al valor especificado
- Cantidad y referencia
- Notas adicionales
- Usuario responsable
- **Actualización automática**: El stock se actualiza mediante un Observer al crear movimientos
- Validación de stock suficiente en salidas

## 🔧 Estructura del Proyecto

```
app/
├── Filament/
│   ├── Resources/
│   │   ├── Categories/      # Recurso de categorías
│   │   ├── Products/        # Recurso de productos
│   │   ├── StockMovements/  # Recurso de movimientos
│   │   └── Suppliers/       # Recurso de proveedores
│   └── Widgets/             # Widgets del dashboard
├── Models/
│   ├── Category.php
│   ├── Product.php
│   ├── StockMovement.php
│   └── Supplier.php
└── Observers/
    └── StockMovementObserver.php  # Lógica de actualización automática

database/
├── factories/               # Factories para datos de prueba
├── migrations/              # Migraciones de base de datos
└── seeders/                # Seeders con datos de ejemplo
```

## 🔐 Observadores (Observers)

El sistema utiliza un **Observer** para actualizar automáticamente el stock:

### StockMovementObserver
- **Evento**: `created` en StockMovement
- **Funcionalidad**:
  - Usa transacciones de base de datos
  - Lock pessimista para evitar race conditions
  - Validación de stock suficiente en salidas
  - Actualización automática del modelo Product

```php
// Ejemplo de uso
StockMovement::create([
    'product_id' => 1,
    'type' => 'in',
    'quantity' => 10,
    'reference' => 'PO-001',
    'user_id' => 1,
]);
// El stock del producto se actualiza automáticamente
```

## 🚦 Roadmap

- [ ] Sistema de roles y permisos con Spatie
- [ ] Reportes PDF exportables
- [ ] Códigos de barras / QR para productos
- [ ] Alertas automáticas de stock mínimo
- [ ] API REST para integraciones externas
- [ ] Soporte multi-almacén/sucursales
- [ ] Historial de cambios de precios
- [ ] Sistema de notificaciones por email
- [ ] Exportación a Excel/CSV
- [ ] Importación masiva de productos
- [ ] Dashboard personalizable por usuario
- [ ] Auditoría completa de cambios

## 🤝 Contribuciones

Las contribuciones son bienvenidas. Por favor:

1. Haz fork del proyecto
2. Crea una rama para tu característica (`git checkout -b feature/nueva-caracteristica`)
3. Commit tus cambios (`git commit -m 'Agrega nueva característica'`)
4. Push a la rama (`git push origin feature/nueva-caracteristica`)
5. Abre un Pull Request

## 📝 Licencia

Este proyecto está bajo la licencia [MIT](LICENSE).

## 👨‍💻 Autor

FedeCtr - [@FedeCtr](https://github.com/FedeCtr)

## ⭐ Apoya el Proyecto

Si este proyecto te fue útil, ¡dale una ⭐️!

## 📧 Contacto

¿Preguntas o sugerencias? Abre un [issue](https://github.com/FedeCtr/sistema-gestion-inventario/issues).

---

**Hecho con ❤️ usando Laravel 12 y Filament 5**
