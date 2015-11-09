# 【・ヘ・?】 -- Readme
#  2015-11-09
#  ʕ•ᴥ•ʔ -- Morgan Aasdam
#  Public Domain

Depends on: http://wiringpi.com/, PHP, Apache httpd
Runs on: Raspberry Pi (Type: Model B, Revision: 1, Memory: 256MB)

Simple set of scripts to automate and remote control a heater.
Makes use of a relay connected to the Pi's GPIO port 1, 5v and GND.

Current functionality:
- Turn On Heater
- Turn Off Heater
- Turn On/Off Heater based on schedule
- Set schedule

Additional requirement:
- Set a cron job for cron.php as follows:
*/5 * * * * php /var/www/html/cron.php > /var/www/html/cronlog.log

Note:
- No security features implemented. Quick hack for home use.