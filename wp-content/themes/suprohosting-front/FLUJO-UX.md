# Flujo visual SuproHosting V2

## Recorrido principal

| Etapa | Interacción | Respuesta visual | Backend futuro |
|---|---|---|---|
| Descubre | Comprende infraestructura propia, soporte local y factura ecuatoriana | Hero fotográfico y argumentos superpuestos | Contenido administrable |
| Elige | Compara START, GROW y SCALE | Carrusel TheGem con una estructura común | Catálogo y precios desde WHMCS/ERP |
| Conecta | Registra un dominio, usa uno existente o lo deja para después | Buscador y opciones dentro del configurador | Cloudflare Registrar API, DNS y transferencias |
| Configura | Añade correo, migración o soporte | Extras seleccionables y datos esenciales | Cálculo, impuestos, cliente y consentimientos |
| Revisa | Confirma servicio, dominio, extras y renovación | Resumen único antes de cualquier cobro | Orden idempotente y pasarela |
| Publica | Activa la demostración | Progreso de aprovisionamiento simulado | Webhooks, Proxmox, iRedMail y hosting |
| Administra | Entra al Panel Supro | Servicios, dominios, correo, facturas y soporte | Datos reales y SSO |

## Jerarquía de productos

1. **Hosting** es el ancla y la primera decisión.
2. **Dominio** se conecta al hosting, pero también admite búsqueda independiente.
3. **Correo** funciona como producto y como complemento.
4. **VPS** se explica por casos de uso, no por jerga de recursos.
5. **Ingeniería** se cotiza aparte; no se mezcla con el checkout de autoservicio.

## Flujo de dominio recomendado

`Sugerir → comprobar disponibilidad/precio → mostrar alta y renovación → identificar registrante → confirmar pago → volver a comprobar → registrar → consultar estado → crear DNS → asociar hosting`

Dominion solo cubre la comprobación WHOIS y el enlace de continuación. La Cloudflare Registrar API beta cubrirá búsqueda, check y registro para TLD admitidos; renovaciones, transferencias y cambios de contacto necesitarán otra ruta mientras continúen fuera de la API.

## Principios de interacción

- Una acción primaria por lienzo.
- El hosting se presenta antes que el dominio.
- Se habla de resultados; el detalle técnico aparece como evidencia, no como carga cognitiva.
- Alta y renovación siempre aparecen juntas antes de pagar.
- Verde comunica éxito; azul guía; ámbar distingue ingeniería y atención.
- Ninguna simulación se confunde con una operación real.
- El prototipo no captura tarjeta ni conserva datos.
- Los diálogos funcionan con teclado, cierran con `Esc` y devuelven el foco.
- Los carruseles tienen botones visibles, soporte táctil y fallback por desplazamiento.

## Estados que debe cubrir el backend

- Dominio disponible, no disponible, premium o TLD no admitido.
- Precio modificado entre búsqueda y confirmación.
- Registro exitoso, en progreso, fallido, bloqueado o con acción requerida.
- Pago autorizado pero dominio perdido antes del registro.
- Aprovisionamiento parcial de hosting, correo o DNS.
- Reintentos idempotentes sin duplicar cargos ni servicios.
- Renovación próxima, vencida o manual mientras Cloudflare no la exponga por API.
