use std::fs;
use std::io::Write;
use std::path::PathBuf;

fn main() -> Result<(), Box<dyn std::error::Error>> {
    println!("🌍 Abriendo mapa. Añade IPs desde la propia página.");
    let html_template = fs::read_to_string("templates/map_template.html")?;

    let mut path: PathBuf = std::env::temp_dir();
    path.push("geolocator_map.html");
    let mut file = fs::File::create(&path)?;
    file.write_all(html_template.as_bytes())?;

    println!("Mapa generado en: {}", path.display());
    let file_url = format!("file://{}", path.display());
    let _ = webbrowser::open(&file_url);

    Ok(())
}