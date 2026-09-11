# SuproHosting Front V2.1

Tema hijo instalable para **TheGem Elementor**. Esta versión construye primero la experiencia visual y conserva el backend como una fase separada: no crea órdenes, no procesa pagos y no aprovisiona servicios.

## Tesis de la experiencia

El ancla comercial ya no es el dominio. Es el **hosting sobre infraestructura propia**, respaldado por virtualización Proxmox, correo iRedMail, soporte humano en español y factura ecuatoriana. El dominio se conecta después de escoger el servicio.

La identidad usa las reglas entregadas por SuproHosting:

- Azul `#00A0E4`, celeste `#43AFDC`, verde `#9ABF55`, azul marino `#0B2346` y ámbar `#F4A33A`.
- Roboto Condensed Bold para títulos y Roboto Regular/Bold para contenido e interfaz.
- Órbitas, nodos, rutas y curvas derivados del isotipo.
- Fotografía contextual de operación, negocio e infraestructura.
- Promesa de marca: **Transformación digital sin límites**.

## Qué incluye

- Hero editorial con fotografía, capas flotantes y prueba de infraestructura.
- Tres argumentos diferenciales en tarjetas superpuestas.
- Carrusel de planes START / GROW / SCALE usando **Owl Carousel incluido por TheGem**.
- Lienzo independiente para búsqueda y conexión de dominio.
- Sección de correo con composición fotográfica y tarjetas bento.
- Carrusel de casos VPS: comercio, ERP, seguridad y desarrollo.
- Recorrido guiado `Elige → Conecta → Configura → Publica`.
- Panel de cliente demostrativo con servicios, dominios, correo, facturas y soporte.
- Bloque de ingeniería separado del autoservicio.
- Carrusel con testimonios reales ya publicados por SuproHosting.
- Diez preguntas frecuentes.
- Navegación por teclado, cierre con `Esc` y movimiento reducido.

## Compatibilidad

- Tema padre: `thegem-elementor`.
- Motor de carruseles: `owl`, registrado por TheGem; no se duplica otra biblioteca.
- Constructor del sitio actual: Elementor.
- Plugin opcional: Dominion 2.2.1.
- La integración conserva el formulario accesible de SuproHosting y consume la consulta WHOIS de Dominion; WPBakery no es necesario.

## Instalación segura

1. Haz una copia de seguridad y prueba primero en staging.
2. Verifica que **TheGem Elementor** esté instalado; no reemplaces el padre por la variante WPBakery.
3. Sube el ZIP del tema hijo desde `Apariencia > Temas > Añadir nuevo` y actívalo.
4. Opcional: instala `the_dominion.zip` desde el paquete adquirido.
5. Crea una página con la plantilla **SuproHosting — Landing V2**, o define esa página como portada desde `Ajustes > Lectura`.
6. Configura el logotipo desde el personalizador si deseas sustituir el recurso incluido.
7. Revisa enlaces, catálogo y capacidades reales antes de publicar.

## Dominion: alcance real

El código suministrado de Dominion:

- consulta disponibilidad mediante servidores WHOIS;
- muestra disponible/no disponible;
- genera un botón hacia una URL de compra configurable.

No registra, renueva, transfiere, cobra ni aprovisiona dominios. En V2.1 se usa únicamente como consulta WHOIS inicial; el resultado disponible abre el configurador visual de SuproHosting.

La URL de continuación puede personalizarse:

```php
add_filter( 'supro_front_domain_purchase_url', function () {
    return home_url( '/configurar/?domain=' );
} );
```

## Cloudflare Registrar API

Desde abril de 2026 Cloudflare ofrece una **Registrar API en beta** que permite buscar, comprobar disponibilidad/precio en tiempo real y registrar dominios admitidos. Documentación oficial: <https://developers.cloudflare.com/registrar/registrar-api/>.

Esto hace viable una integración propia, pero no convierte a Dominion en el conector. El backend deberá:

1. llamar a `domain-search` para sugerencias;
2. llamar a `domain-check` como fuente de verdad y mostrar alta/renovación;
3. confirmar el pago del cliente y sus datos de registrante;
4. volver a comprobar disponibilidad inmediatamente antes del alta;
5. crear la registration y consultar su estado si responde en modo asíncrono;
6. crear DNS y asociar el dominio con el hosting;
7. registrar auditoría, errores y acciones pendientes.

La API es beta y solo admite parte de las extensiones. A septiembre de 2026 todavía no ofrece renovación, transferencia ni actualización de contactos por API. La cuenta Cloudflare necesita permiso Registrar Write, perfil de pago y contacto predeterminado. El token nunca debe llegar al navegador.

Antes de vender a terceros se debe validar contractualmente el modelo de reventa/intermediación, titularidad del dominio, soporte de cada TLD —en especial `.ec` y `.com.ec`—, tratamiento de datos y conciliación contable.

## Valores pendientes del catálogo

Los PDF no entregan una tabla definitiva de precios, renovaciones ni capacidades. La interfaz dice “Cotización automática” de forma deliberada; no se inventaron valores. Antes de producción se deben definir:

- precio inicial y renovación de START / GROW / SCALE;
- capacidades medibles por plan;
- extensiones de dominio incluidas y elegibles;
- impuestos, moneda y medios de pago;
- alcance exacto de migración y soporte.

## Límites de esta versión

- No crea usuarios, tickets ni órdenes.
- No guarda los datos escritos en la demostración.
- No solicita datos de tarjeta.
- No registra dominios ni aprovisiona hosting/correo/VPS.
- No sustituye todavía WHMCS ni el futuro panel de operación.

Estas operaciones pertenecen a la fase de backend y requieren APIs, webhooks, autenticación, idempotencia, auditoría y controles de seguridad.
