import serial
import requests
import time

# Set your Arduino's serial port here
SERIAL_PORT = 'COM6'  # Or '/dev/ttyUSB0' depending on your system
BAUD_RATE = 9600

ser = serial.Serial(SERIAL_PORT, BAUD_RATE, timeout=1)
time.sleep(2)  # Give Arduino time to reset

print("Listening to Arduino...")
carCount = 0

try:
    while True:
        line = ser.readline().decode('utf-8').strip()
        if line:
            try:
                value = int(line)
                if value != 0:
                    res = requests.post('http://192.168.30.164/Hackathon/car-parking-web/api.php', data={"data": line})
                    print(f"Car Count Sent: {line}")
            except ValueError:
                print(f"Invalid input: {line}")
except KeyboardInterrupt:
    print("Stopped.")
finally:
    ser.close()
