# **GUÍA DE INSTALACIÓN**

## **Paso 1: Descargar e Instalar XAMPP**
1. Descarga **XAMPP Portable para Windows** desde el siguiente enlace:  
   ➡ [Descargar XAMPP Portable](https://www.apachefriends.org/download.html)
2. Extrae el contenido del archivo descargado.
3. Ejecuta el archivo `setup_xampp.bat` para configurar el entorno.

## **Paso 2: Descargar y Extraer el Proyecto**
1. Descarga la última versión del proyecto desde GitHub:  
   ➡ [Descargar Golazo](https://github.com/Learning4tech/golazo/archive/refs/heads/main.zip)
2. Extrae el archivo ZIP para obtener la carpeta `golazo`.

## **Paso 3: Mover el Proyecto a XAMPP**
1. Copia la carpeta `golazo` extraída.
2. Pega la carpeta dentro del directorio `htdocs` en la instalación de XAMPP (por defecto en `C:\xampp\htdocs\golazo`).

## **Paso 4: Ejecutar el Archivo SQL en phpMyAdmin**
1. Inicia **XAMPP** y activa los servicios de **Apache** y **MySQL**.
2. Abre tu navegador y accede a **phpMyAdmin**:
   ```
   http://localhost/phpmyadmin
   ```
3. Crea una nueva base de datos con el nombre `golazo`.
4. Importa el archivo SQL que se encuentra en la carpeta `recursos`:
   - Archivo SQL: `recursos/golazo.sql`

## **Paso 5: Acceder al Proyecto**
1. Asegúrate de que **Apache** y **MySQL** siguen en ejecución en XAMPP.
2. Abre un navegador y accede a:
   ```
   http://localhost/golazo
   ```

## **Información Adicional**
En la carpeta `recursos`, encontrarás:
- 📄 **`briefing.pdf`** → Documento con la descripción del proyecto.  
- 📊 **`tablas.csv`** → Archivo con la lógica de las tablas.  
- 📂 **`golazo.sql`** → Archivo SQL completo para importar en phpMyAdmin.

✅ **¡Listo!** Ahora deberías poder ejecutar el proyecto en tu servidor local. 🚀  
Si tienes algún problema, revisa que todos los servicios estén activos en XAMPP o consulta la documentación del proyecto.
