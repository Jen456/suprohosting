# Flujo UX de SuproHosting

| Etapa | Acción del visitante | Respuesta visual | Backend futuro |
|---|---|---|---|
| Descubre | Comprende la propuesta | Hero, infraestructura y respaldo local | Contenido administrable |
| Elige | Compara START, GROW y SCALE | Carrusel de planes | Catálogo, impuestos y renovaciones |
| Conecta | Busca o aporta un dominio | WHOIS o modo demostración | Registrar API, DNS y transferencias |
| Configura | Añade correo, migración o soporte | Selección de extras | Cotización y datos del cliente |
| Revisa | Confirma sus decisiones | Resumen previo al pago | Orden idempotente |
| Publica | Ejecuta la simulación | Progreso de activación | Webhooks y aprovisionamiento |
| Administra | Abre el Panel Supro | Servicios, dominios, facturas y soporte | Portal autenticado y SSO |

## Estados obligatorios para la fase de backend

- Dominio disponible, ocupado, premium o no verificable.
- Precio inicial y renovación, incluidos impuestos.
- Pago autorizado, rechazado, pendiente o duplicado.
- Registro exitoso, pendiente, fallido o con acción requerida.
- Aprovisionamiento completo, parcial o revertido.
- Reintentos idempotentes sin duplicar cargos ni recursos.
