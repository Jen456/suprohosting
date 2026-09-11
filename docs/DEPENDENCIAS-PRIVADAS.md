# Dependencias privadas

Los paquetes comerciales se utilizan como dependencias instaladas en WordPress. Aunque el repositorio es privado, **no se publican como ZIP ni se redistribuyen fuera del proyecto licenciado**.

## TheGem Elementor

- Paquete revisado: TheGem `5.12.3.1`.
- Tema esperado por el child theme: `thegem-elementor`.
- El sitio público actual también carga `thegem-elementor`; no se debe cambiar a la variante WPBakery.
- Los carruseles reutilizan el handle `owl` registrado por TheGem.

## Dominion Pro

- Versión revisada: `2.2.1`.
- Requiere WordPress `5.9+` y PHP `7.4+` según el encabezado del plugin.
- El paquete declara pruebas hasta WordPress `6.8.3`; debe validarse en staging antes de usarlo con una versión posterior.
- SuproHosting usa únicamente su consulta WHOIS. Dominion no cobra, registra, renueva ni transfiere dominios.
- Mantén desactivada su carga de Bootstrap salvo que una prueba de staging demuestre que es necesaria; puede colisionar con TheGem.

## Regla de actualización

1. Respaldar archivos y base de datos.
2. Probar la actualización en staging.
3. Verificar portada, carruseles, buscador y consola del navegador.
4. Confirmar que no se muestran avisos PHP al visitante.
5. Promover a producción únicamente después de la validación.
