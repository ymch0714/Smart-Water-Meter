#include <ESP8266WiFi.h>
#include <WiFiClient.h> 
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>
#include <SoftwareSerial.h>

SoftwareSerial HC12(D5, D6);

const char *ssid = "SSID";
const char *password = "PASSWORD";
const char *host = "EXAMPLE.COM";
String Data="", station, postData;
byte incomingByte;
 
void setup() {
  pinMode(D7,OUTPUT);
  digitalWrite(D7,HIGH);
  delay(1000);
  Serial.begin(4800);
  HC12.begin(4800);
  WiFi.mode(WIFI_OFF);
  delay(1000);
  WiFi.mode(WIFI_STA);
  
  WiFi.begin(ssid, password);
  Serial.println("");
 
  Serial.print("Connecting");

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected to ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
}

void loop() {
  while (HC12.available()) {
    incomingByte = HC12.read();   
    Data += char(incomingByte);
  }
  while (Serial.available()) {
    HC12.write(Serial.read());
  }
  delay(100);
  if (Data != ""){
    upload();
  }
}

void upload(){
  Serial.print(Data);
  HTTPClient http;

  station = "1";
  postData = "status=" + Data + "&station=" + station ;

  http.begin("http://EXAMPLE.COM/post");
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");

  int httpCode = http.POST(postData);
  String payload = http.getString();

  Serial.println(httpCode);
  Serial.println(payload);

  http.end();
  Data="";
}