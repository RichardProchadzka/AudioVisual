# AudioVisual
Audiovisual is youtube-dl with ffmpeg GUI hosted via nginx and PHP. (I know PHP.... blah, blah... But it works!)

This project was created because I wanted some youtube-dl GUI on my weak OrangePI board.
I saw a lot of cool GUI`s on Github but none of them was suitable for my weak OrangePI :D.
When I started this project I thought that ffmpeg feature will be nice to have so I added basic conversion with basic video and audio formats.
Also you can get notification via Telegram.

If you find something that can improve this project feel free to help me improve this project.

## Warning!
- Do not host this or any webpage over the internet.
- I granted root permissions to www-data user.
- This should be deployed only in local network area or accessed via VPN!
- Use only with well secured firewall or well secured router.
- I am not responsible for the future of your system.

# How to use
![image](https://user-images.githubusercontent.com/97609737/201710218-ee626066-86fd-4c69-ab53-9c133e8355ce.png)
## Good to know
- The page is refreshing every 60s.
- Youtube-dl can throw error on download even if it is good link, so you can find every failed link in audiovisual.log
- Youtube-dl does not support shorts.
- If you do mistake that you add invalid link or so, just leave it that way, it will handle it.



## Issues
I tried to force not to cache the page but it seems that is not working properly so you need to refresh iframes or clear the cache from browser.
