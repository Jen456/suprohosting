# Arquitectura del frontend

## Objetivo de esta fase

Construir primero la experiencia visual y la interacción, sin acoplarla a proveedores ni automatizaciones todavía inexistentes. La landing debe explicar la propuesta en pocos segundos y permitir recorrer una contratación simulada sin confundirla con una compra real.

## Jerarquía comercial

1. **Hosting administrado:** producto ancla.
2. **Dominio:** se registra, conecta o deja para después.
3. **Correo corporativo:** producto independiente o complemento.
4. **VPS:** se presenta por casos de uso.
5. **Ingeniería:** proyectos a medida fuera del autoservicio.

## Capas

| Capa | Responsabilidad actual | Evolución prevista |
|---|---|---|
| Plantillas PHP | Estructura semántica, textos y formularios | Consumir datos del catálogo |
| CSS del child theme | Branding, responsive, cards, carruseles y estados | Design tokens administrables |
| JavaScript | Modales, configurador, navegación y demo | Cliente de API con estados reales |
| Dominion | Consulta WHOIS informativa | Sustituir o complementar con API registradora |
| Backend | No implementado en esta rama | Pagos, órdenes, DNS y aprovisionamiento |

## Decisiones que no se deben romper

- El tema padre es `thegem-elementor`, coincidiendo con el sitio actual.
- No se modifica TheGem ni Dominion directamente.
- El formulario nunca recibe tokens de Cloudflare ni credenciales del servidor.
- La disponibilidad WHOIS no equivale a precio ni garantiza el registro.
- Los estados de pago y aprovisionamiento visibles son demostrativos hasta conectar el backend.
- Ninguna cifra de SLA se publica sin contrato o medición que la respalde.

## Flujo de interfaz

`Descubre → Elige hosting → Conecta dominio → Añade extras → Revisa → Simula activación → Abre panel demo`

Los detalles completos están en [FLUJO-UX.md](FLUJO-UX.md).
