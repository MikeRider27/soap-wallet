# 💸 SOAP - WALLET

Este proyecto implementa un **servicio SOAP en Laravel** que actúa como núcleo de una billetera virtual. Es parte de la prueba técnica para ePayco y **se comunica con un servicio REST intermedio y un cliente React por separado**.

---

## 📦 Tecnologías usadas

- PHP 8.4 con Laravel
- Laravel Sail (Docker)
- MySQL externo
- Eloquent ORM (no DB Facades)
- Servidor SOAP personalizado

---

## 🚀 Requisitos

- Docker y Docker Compose instalados
- Puerto `9000` libre para el servidor SOAP
- Conexión a base de datos MySQL externa o interna

---

## ⚙️ Instalación

1. Clona el repositorio:
   ```bash
   git clone https://github.com/MikeRider27/soap-wallet.git
   cd soap-wallet
   ```

2. Copia el archivo `.env`:
   ```bash
   cp .env.example .env
   ```

3. ⚠️ **Nota sobre la base de datos**:

   > Si vas a utilizar **MySQL dentro del contenedor Docker (Laravel Sail)**:
   > ```env
   > DB_HOST=mysql
   > ```
   >  
   > Si vas a usar una **base de datos MySQL externa**, coloca la IP o dominio correspondiente:
   > ```env
   > DB_HOST=192.168.11.220
   > ```

   Asegúrate de tener esta configuración básica en `.env`:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=192.168.11.220
   DB_PORT=3306
   DB_DATABASE=soap_wallet
   DB_USERNAME=root
   DB_PASSWORD=123
   APP_PORT=9000
   ```

4. Levanta el entorno con Sail:
   ```bash
   ./vendor/bin/sail up -d
   ```

5. Instala dependencias PHP:
   ```bash
   ./vendor/bin/sail composer install
   ```

6. Crea las tablas necesarias:
   ```bash
   ./vendor/bin/sail artisan migrate
   ```

---

## 🧪 Probar el servicio SOAP

Puedes testear el endpoint desde un navegador o Postman:

```
http://localhost:9000/soap/server
```

Este endpoint no devuelve una vista amigable en navegador, pero puedes enviar peticiones `POST` desde un cliente SOAP y acceder a los métodos disponibles:

- `registroCliente`
- `recargarBilletera`
- `generarCompra`
- `confirmarPago`
- `consultarSaldo`

---

## 📂 Estructura relevante

```
app/
├── Http/
│   └── Controllers/
│       └── Soap/
│           └── WalletSoapController.php   ← Lógica SOAP
├── Models/
│   ├── Cliente.php
│   └── Compra.php
routes/
└── soap.php (si configurado, o rutas web/api según arquitectura)
```

---

## 🧼 Buenas prácticas aplicadas

- ✅ Validación manual de parámetros en cada método
- ✅ Uso exclusivo de Eloquent (ORM)
- ✅ Laravel Sail para aislar el entorno
- ✅ Separación de lógica en servicios independientes

---

## 🧑‍💻 Autor

**Miguel Villalba**  
Backend Developer - Prueba Técnica ePayco  
✉️ mike.mavc27@gmail.com

---

## 📄 Licencia

Este proyecto está bajo licencia MIT.
