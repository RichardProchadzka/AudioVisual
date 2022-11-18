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
- If you do mistake that you add invalid link or so, just leave it that way, youtube-dl will handle it.
- Managing of processed files should be done via sftp, ftp, smb or accessing directly from OS files manager, just to have quicker download of the file.
- If your PC is slow for conversion of video, try to lovering preset following this graf.
For example, in ffmpeg.sh change value medium to veryfast.

![encoding-time](https://user-images.githubusercontent.com/97609737/202441027-711330ee-50fd-4ac4-bc79-718609024a69.png)

Source: https://trac.ffmpeg.org

## Issues
I tried to force not to cache the page but it seems that it is not working properly so you need to refresh iframes or clear the cache from browser.
Persons that have access to this tool may see your Telegram Token!
Granted root permissions to www-data user.

# How to deploy - UBUNTU
1. Clone repository to your enviroment. Choose branch by your architecture.
2. ```cd AudioVisual```
3. Run build script with ```sudo bash build.sh```
4. Follow through steps.
5. Add ```client_max_body_size 10G;``` inside nginx.conf. Than press ctrl+x to close and type y to save.
![image](https://user-images.githubusercontent.com/97609737/202452544-c5291b06-53c6-4434-be8d-0fd8ae8bc7c1.png)
6. Than in php.ini find with ctrl+w these parameters and change values.
```post_max_size = 0``` and ```upload_max_filesize = 10G```
![image](https://user-images.githubusercontent.com/97609737/202452923-cb13926a-302d-4394-8354-ebb73db9e43b.png)
![image](https://user-images.githubusercontent.com/97609737/202453084-a66b43b1-e2e2-4b05-86d8-c6e0b2374dd4.png)
7. Carefully read the warning message. It is safe to deploy if you will not share nginx or php to the world.
![image](https://user-images.githubusercontent.com/97609737/202459860-2d9269c4-4b28-4c4d-bc5e-0a7510edfd40.png)
8. Build should be done. Now if everything went good try to access GUI -> ```http://<IP address of machine>:8081```
