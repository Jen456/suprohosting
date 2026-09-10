# Despliegue seguro en Hestia — staging

## Acceso mínimo recomendado

Para conectar este proyecto al entorno ya ejecutado en Hestia se necesitan:

- URL exacta del sitio de desarrollo.
- Usuario SFTP/SSH temporal limitado al dominio de staging; no usar `root`.
- Autenticación con clave temporal, preferiblemente sin contraseña reutilizada.
- Usuario administrador temporal de WordPress solo si la instalación de temas/plugins se hará desde el panel.
- Copia de seguridad verificable antes de reemplazar cualquier archivo.

No se deben enviar claves, contraseñas o tokens dentro del repositorio ni dejarlos escritos en documentación.

## Rutas

La ruta concreta depende del usuario y dominio configurados por Hestia. El destino funcional es:

```text
public_html/wp-content/themes/suprohosting-front/
```

Los paquetes privados se instalan directamente en WordPress o mediante una ruta temporal fuera del repositorio.

## Orden de activación

1. Confirmar que el entorno es staging y que TheGem Elementor está activo.
2. Subir el child theme sin modificar el padre.
3. Activar la plantilla en una página de prueba no indexada.
4. Validar navegación, móvil, formularios y errores PHP.
5. Instalar Dominion y comprobar el modo WHOIS.
6. Mantener pagos y aprovisionamiento deshabilitados hasta que exista backend.

## Ajustes imprescindibles

- `WP_DEBUG_DISPLAY` debe estar desactivado para visitantes.
- Los logs deben escribirse fuera de la salida HTML.
- Staging debe llevar `noindex` y, si es posible, autenticación adicional.
- Las credenciales de Cloudflare, WHMCS, Proxmox e iRedMail jamás deben estar en JavaScript o HTML.
