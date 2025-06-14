
#include <Servo.h>

const int trigpin1 = 10;
const int echopin1 = 9;
const int trigpin2 = 6;
const int echopin2 = 5;

Servo servoMotor;

float distance1;
float duration1;
float distance2;
float duration2;

int carCount = 0;
int maxCapacity = 10;


void setup() {
  Serial.begin(9600);
  pinMode(trigpin1, OUTPUT);
  pinMode(echopin1, INPUT);
  pinMode(trigpin2, OUTPUT);
  pinMode(echopin2, INPUT);
  servoMotor.attach(3);
}

// the loop function runs over and over again forever
void loop() {
  digitalWrite(trigpin1, LOW);
  delayMicroseconds(2);
  digitalWrite(trigpin1, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigpin1, LOW);
  duration1 = pulseIn(echopin1, HIGH);
  distance1 = (duration1 * 0.034) / 2;

  digitalWrite(trigpin2, LOW);
  delayMicroseconds(2);
  digitalWrite(trigpin2, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigpin2, LOW);
  duration2 = pulseIn(echopin2, HIGH);
  distance2 = (duration2 * 0.034) / 2;

  if (distance1 > 0 && distance1 < 10 && carCount < 10) {
    servoMotor.write(180);
    delay(5000);
    carCount++;
    Serial.println(carCount);
  } else {
    servoMotor.write(0);
    delay(10);
  }

  if (distance2 > 0 && distance2 < 10 && carCount > 0) {
    servoMotor.write(180);
    delay(5000);
    carCount--;
    Serial.println(carCount);

  } else {
    servoMotor.write(0);
    delay(10);
  }

  delay(500);
}
