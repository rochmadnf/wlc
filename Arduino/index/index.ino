/*
 * SmartBin made by Proaction Palu 
 * Author Code : Rochmad Nurul Fahmi || https://github.com/rochmadnf
 * Circuits    : Amran
 * Mechanics   : Hayadi & Sahabudin L. Siama
*/

// Include libraries
#include <FlowMeter.h>
#include <AntaresESP32HTTP.h>
#include <ArduinoJson.h>

// Initialization Pin
// Sensor Ultrasonic Pin
#define TRIG 32
#define ECHO 35

// Water Flow Sensor Pin
#define INTERRUPT 25

// Relay Pin
#define TRIGGER 14

// Antares Initialization
// Setting access key, wifi ssid and password
#define ACCESSKEY "your-access-key"
#define WIFISSID "your-wifi-ssid"
#define PASSWORD "your-wifi-password"

// Initialization application and device
#define projectName "your-project-name"
#define deviceName "your-project-name"

// Flow Meter Initialization
FlowSensorProperties MySensor = {60.0f, 5.5f, {1, 1, 1, 1, 1, 1, 1, 1, 1, 1}};

// Making Object
FlowMeter *WaterMeter;
AntaresESP32HTTP antares(ACCESSKEY);

// Global Variable
long period = 1000;
long lastTime = 0;
float WaterTotal, WaterCurrentTotal, sendWaterTotal;
long currentTime, duration, durationUltra;
int distanceUltra, getDis, sPump;
int afterSendData = 3000;

void setup()
{
  // prepare serial communication
  Serial.begin(115200);

  // get a new FlowMeter instance for an uncalibrated flow sensor on pin 2
  WaterMeter = new FlowMeter(digitalPinToInterrupt(INTERRUPT), MySensor, MeterISR, RISING);

  // Ultrasonic Mode
  pinMode(TRIG, OUTPUT);
  pinMode(ECHO, INPUT);

  // Pump
  pinMode(TRIGGER, OUTPUT);

  antares.setDebug(true);
  antares.wifiConnection(WIFISSID, PASSWORD);

  antares.get(projectName, deviceName);

  // Get total water from antares
  WaterTotal = antares.getFloat("waterTotal");
  Serial.print("Water Total: ");
  Serial.println(WaterTotal);
}

void MeterISR()
{
  // let our flow meter count the pulses
  WaterMeter->count();
}

void uploadToAntares(int Ds, float Wt, int Pu)
{
  antares.add("waterLevel", Ds);
  antares.add("waterTotal", Wt);
  antares.add("statPump", Pu);
  antares.send(projectName, deviceName);
  delay(afterSendData);
}

int getDistance()
{
  digitalWrite(TRIG, LOW);
  delayMicroseconds(20);
  digitalWrite(TRIG, HIGH);
  delayMicroseconds(300);
  durationUltra = pulseIn(ECHO, HIGH);
  distanceUltra = durationUltra * 0.034 / 2;
  return distanceUltra;
}

void loop()
{
  currentTime = millis();
  duration = currentTime - lastTime;
  // wait between display updates
  if (duration >= period)
  {
    getDis = getDistance();
    Serial.print("Distance: ");
    Serial.println(getDis);
    WaterMeter->tick(duration);
    WaterCurrentTotal = WaterMeter->getTotalVolume();
    Serial.print("Total Water: ");
    Serial.println(WaterCurrentTotal);

    if (getDis <= 10)
    {
      // Turn Off Pump
      digitalWrite(TRIGGER, LOW);
      sendWaterTotal = WaterTotal + WaterCurrentTotal - 0.3;
      uploadToAntares(10, sendWaterTotal, 0);
    }
    else
    {
      if (getDis >= 57)
      {
        // Turn On Pump
        digitalWrite(TRIGGER, HIGH);
        sendWaterTotal = WaterTotal + WaterCurrentTotal - 0.3;
        uploadToAntares(getDis, sendWaterTotal, 1);
      }
      else
      {
        // Update Data to Antares
        sPump = digitalRead(TRIGGER);
        sendWaterTotal = WaterTotal + WaterCurrentTotal - 0.3;
        uploadToAntares(getDis, sendWaterTotal, sPump);
      }
    }

    // for next cycle
    lastTime = currentTime;
  }
}
