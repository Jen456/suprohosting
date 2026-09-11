# SuproHosting — frontend

Primera fase visual y navegable de la nueva experiencia de SuproHosting. El proyecto conserva a **SuproHosting** como marca madre y presenta primero el servicio de hosting administrado sobre infraestructura propia, con soporte real en español y facturación ecuatoriana.

El recorrido principal es:

`Elige → Conecta → Configura → Publica`

## Estado actual

- Rama de trabajo: `frontend`.
- Base WordPress integrada: `produccion@7e94b03`.
- Alcance: únicamente el sitio raíz `suprohosting.com`; `inmobiliaria/` y `store/` permanecen intactos.
- Tema hijo compatible con **TheGem Elementor**.
- Landing responsive con cards, carruseles, composición bento, configurador visual y demostración del panel del cliente.
- Integración opcional con **Dominion Pro 2.2.1** para consulta WHOIS.
- Sin cobros, registro de dominios, creación de usuarios ni aprovisionamiento real en esta fase.

## Estructura

```text
contract/                         Contrato preliminar para el backend
docs/                            Arquitectura, flujo y despliegue
preview/                         Demostración estática navegable
scripts/                         Construcción y validación sin dependencias
wp-content/themes/
  suprohosting-front/             Tema hijo propio
```

## Vista previa

No requiere instalar dependencias:

```bash
npm run build:preview
npm run check
```

Después abre `preview/index.html` en un navegador.

## Instalación en WordPress

1. Confirma que el tema padre **TheGem Elementor** adquirido por SuproHosting esté instalado.
2. Despliega la rama `frontend` primero en staging.
3. Activa **SuproHosting Front** desde WordPress; el tema ya vive en `wp-content/themes/suprohosting-front`.
4. Define la portada o asigna la plantilla `SuproHosting — Landing V2` a una página.
5. Instala Dominion únicamente en staging si se habilitará la consulta WHOIS.

Consulta [Despliegue en Hestia](docs/HESTIA-STAGING.md) y [dependencias privadas](docs/DEPENDENCIAS-PRIVADAS.md) antes de intervenir el servidor.

## Protección de licencias y secretos

Este repositorio es privado, pero los ZIP de ThemeForest/CodeCanyon, credenciales, tokens, `wp-config.php`, copias de base de datos y archivos `.env` permanecen fuera del control de versiones. El código propio vive en el tema hijo para que TheGem y Dominion puedan actualizarse sin perder personalizaciones.

## Separación frontend/backend

El frontend solo consume contratos públicos. Las credenciales de Cloudflare, WHMCS, Proxmox, iRedMail, pasarelas y servidores pertenecen exclusivamente al backend. El borrador está en [contract/openapi.yaml](contract/openapi.yaml).
