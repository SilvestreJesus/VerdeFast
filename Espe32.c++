#include <WiFi.h>
#include <WebServer.h>
#include <DHT.h>  // Librería para el sensor DHT

// 📶 Credenciales de red WiFi
const char* ssid = "123";
const char* password = "123456789";

// 🌐 Configuración IP estática
IPAddress local_IP(192, 168, 1, 100);
IPAddress gateway(192, 168, 1, 1);
IPAddress subnet(255, 255, 255, 0);

// 🔌 Pines para relés
const int relePulso = 25;
const int releRiego = 26;

// 🌡️ Sensor DHT11
#define DHTPIN 4
#define DHTTYPE DHT11
DHT dht(DHTPIN, DHTTYPE);

// 💧 Sensor de humedad de suelo
const int pinHumedadSuelo = 36; // GPIO36 = A0 en el ESP32

// 🧪 Sensor de pH
const int pinPH = 27; // GPIO39 = A3 en ESP32

// 🌐 Servidor web
WebServer server(80);

void setup() {
  Serial.begin(115200);

  // Configurar pines como salida
  pinMode(relePulso, OUTPUT);
  pinMode(releRiego, OUTPUT);
  digitalWrite(relePulso, LOW);
  digitalWrite(releRiego, LOW);

  // Configurar IP estática
  if (!WiFi.config(local_IP, gateway, subnet)) {
    Serial.println("❌ Error al configurar IP estática");
  }

  // Conectar al WiFi
  WiFi.begin(ssid, password);
  Serial.print("Conectando al WiFi");

  int intentos = 0;
  while (WiFi.status() != WL_CONNECTED && intentos < 20) {
    delay(1000);
    Serial.print(".");
    intentos++;
  }

  if (WiFi.status() == WL_CONNECTED) {
    Serial.println("\n✅ Conectado a WiFi");
    Serial.print("📶 Dirección IP asignada: ");
    Serial.println(WiFi.localIP());
  } else {
    Serial.println("\n❌ No se pudo conectar al WiFi");
    return;
  }

  // Iniciar el sensor DHT
  dht.begin();

  // Endpoints para relé de pulsos
  server.on("/activar_pulsos", HTTP_GET, []() {
    digitalWrite(relePulso, HIGH);
    server.send(200, "text/plain", "✅ Pulsos activados");
  });

  server.on("/desactivar_pulsos", HTTP_GET, []() {
    digitalWrite(relePulso, LOW);
    server.send(200, "text/plain", "❌ Pulsos desactivados");
  });

  // Endpoints para relé de riego
  server.on("/activar_riego", HTTP_GET, []() {
    digitalWrite(releRiego, HIGH);
    server.send(200, "text/plain", "✅ Riego activado");
  });

  server.on("/desactivar_riego", HTTP_GET, []() {
    digitalWrite(releRiego, LOW);
    server.send(200, "text/plain", "❌ Riego desactivado");
  });

  // Endpoint para obtener los datos de temperatura y humedad del suelo
 // Dentro del endpoint "/sensores"
server.on("/sensores", HTTP_GET, []() {
  float temperatura = dht.readTemperature();
  int valorHumedadSuelo = analogRead(pinHumedadSuelo);
  int valorPH = analogRead(pinPH);

  if (isnan(temperatura)) {
    Serial.println("❌ Error al leer temperatura");
    server.send(500, "text/plain", "❌ Error al leer temperatura");
    return;
  }

  // 🧮 Calcular humedad como porcentaje
  int humedadPorcentaje = map(valorHumedadSuelo, 0, 4095, 100, 0);
  humedadPorcentaje = constrain(humedadPorcentaje, 0, 100);

  // 📏 Convertir lectura analógica del sensor de pH (calibración simple)
  float voltajePH = valorPH * (3.3 / 4095.0);
  float phValor = 7 + ((2.5 - voltajePH) * 3.5); // Fórmula de ejemplo

  // 🧪 Restringir a rango realista
  phValor = constrain(phValor, 0.0, 14.0);

  // 📦 Respuesta en JSON
  String json = "{";
  json += "\"temperatura\":" + String(temperatura, 1) + ",";
  json += "\"humedadSuelo\":" + String(humedadPorcentaje) + ",";
  json += "\"ph\":" + String(phValor, 2);
  json += "}";

  server.sendHeader("Access-Control-Allow-Origin", "*");
  server.send(200, "application/json", json);
});

  server.begin();
  Serial.println("🌐 Servidor web iniciado en el puerto 80");
}

void loop() {
  server.handleClient();

  // Test DHT11
  float t = dht.readTemperature();
  if (!isnan(t)) {
    Serial.print("Temperatura DHT11: ");
    Serial.println(t);
  }

  // Test humedad del suelo
  int humedadBruta = analogRead(pinHumedadSuelo);
  int humedadPorcentaje = map(humedadBruta, 0, 4095, 100, 0);
  humedadPorcentaje = constrain(humedadPorcentaje, 0, 100);
  Serial.print("Humedad del suelo (%): ");
  Serial.println(humedadPorcentaje);

  // Test sensor de pH
  int valorPH = analogRead(pinPH);
  float voltajePH = valorPH * (3.3 / 4095.0);
  float phValor = 7 + ((2.5 - voltajePH) * 3.5); // Ajusta según calibración
  phValor = constrain(phValor, 0.0, 14.0);
  Serial.print("Valor pH: ");
  Serial.println(phValor, 2);

  delay(3000);
}


