# 🌍 Mapa Interactivo por IP

Este proyecto es una aplicación web que utiliza **Leaflet** para mostrar ubicaciones geográficas a partir de direcciones IP. Permite añadir direcciones IP manualmente, mostrar/ocultar marcadores y radios, alternar entre mapa oscuro y satélite, y mostrar la ubicación de tu propia IP pública.

## ✨ Características

- **Añadir direcciones IP manualmente** y mostrar su ubicación en el mapa.
- **Mostrar/Ocultar marcadores** y **radios de 5 km** alrededor de cada punto.
- **Cambiar estilo de mapa** entre vista satélite (Esri World Imagery) y mapa oscuro (Carto Dark Matter).
- **Mostrar mi IP**: localiza tu dirección IP pública y la marca con un marcador azul y un círculo de 5 km.
- **Botón de guardar mapa** (captura de imagen del mapa usando `leaflet-image`).

## 🏁 Inicio rápido

Sigue estos pasos para poner en marcha el proyecto en tu entorno local:

1. **Instala Rust**  
   Si aún no lo tienes, instala Rust y Cargo desde [https://rustup.rs/](https://rustup.rs/).

2. **Clona este repositorio**  
   ```bash
   git clone https://github.com/allepuzandresgithub/GeoLocator
   cd GeoLocator
   cargo build       # compila en modo debug
   cargo build --release   # compila optimizado para producción
   cargo run         # compila (si es necesario) y ejecuta en modo debug
   cargo run --release   # compila optimizado y ejecuta
   


   

