#!/bin/bash
if [ "$EUID" -ne 0 ]
then
echo "Please run as root"
exit
fi
#install prerequisites
apt update
apt install rename curl jq youtube-dl nginx php7.4-fpm python3-pip-y
pip install yt-dlp
echo ""
echo ""
systemctl is-active --quiet php7.4-fpm && echo "php7.4-fpm is running"
systemctl is-active --quiet nginx && echo "Nginx is running"
echo ""
echo ""
#configure nginx server to share website on port 8081
echo "" >> /etc/nginx/sites-available/default
echo "server {" >> /etc/nginx/sites-available/default
echo "  listen 8081 default_server;" >> /etc/nginx/sites-available/default
echo "  listen [::]:8081 default_server;" >> /etc/nginx/sites-available/default
echo "  root /var/www/html/audiovisual;" >> /etc/nginx/sites-available/default
echo "  index audiovisual.php;" >> /etc/nginx/sites-available/default
echo "  server_name _;" >> /etc/nginx/sites-available/default
echo "  autoindex on;" >> /etc/nginx/sites-available/default
echo "  location ~ \.php$ {" >> /etc/nginx/sites-available/default
echo "    include snippets/fastcgi-php.conf;" >> /etc/nginx/sites-available/default
echo "    fastcgi_pass unix:/run/php/php7.4-fpm.sock;" >> /etc/nginx/sites-available/default
echo "  }" >> /etc/nginx/sites-available/default
echo "}" >> /etc/nginx/sites-available/default
echo ""
echo ""
#configure nginx to allow posting larger file
echo "Please add client_max_body_size 10G; inside http{} in /etc/nginx/nginx.conf"
sleep 10s
sudo nano /etc/nginx/nginx.conf
echo ""
echo ""
#configure all php.ini files to allow proccess large files
echo "Please edit post_max_size = 0 and upload_max_filesize = 10G in /etc/php/7.4/fpm/php.ini"
sleep 10s
sudo nano /etc/php/7.4/fpm/php.ini
echo ""
cp -r audiovisual /var/www/html/
mkdir /var/www/html/audiovisual/Downloads
mkdir /var/www/html/audiovisual/Convert
chmod -R 777 /var/www/html/audiovisual/
echo ""
echo ""
systemctl restart nginx
systemctl restart php7.4-fpm
#configure permissions
echo ""
echo ""
echo -e "WARNING! It is necessary to grant root permissions to user www-data if you want to use this PHP gui."
echo -e "Do not allow this when you share any website over the internet unless, you are behind VPN, well secured firewall, well secured router."
echo ""
sleep 5s
read -p "Do you allow user www-data to have root privileges? (y/n) Your answer: " CONDITION;
if [ "$CONDITION" == "y" ]; then
echo ""
echo "You allowed user www-data to have root privileges. You accepted the risk of exposing your pc enviroment to the internet unless, you are behind VPN, well secured firewall, well secured router."
echo "www-data ALL=(ALL) NOPASSWD: ALL" >> /etc/sudoers
echo ""
echo "[www-data ALL=(ALL) NOPASSWD: ALL] was added in /etc/sudoers"
else
echo ""
echo "You denied user www-data to have root privileges. Nothing has changed."
fi
echo "Build complete."
