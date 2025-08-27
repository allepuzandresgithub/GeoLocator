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
   Si aún no lo tienes, instala Rust y Cargo desde [https://rustup.rs/].
   ```bash
   curl --proto '=https' --tlsv1.2 -sSf https://sh.rustup.rs | sh
   
2. **Añade rust al PATH recargando la configuración del shell**  
   ```bash
   source $HOME/.cargo/env

3. **Clona este repositorio**  
   ```bash
   git clone https://github.com/allepuzandresgithub/GeoLocator
   cd GeoLocator

4. **Intala las dependencias**
   ```bash
   sudo apt update
   sudo apt install build-essential curl

5. **Compila y ejecuta el programa**
   ```bash
   cargo build       
   cargo run         
