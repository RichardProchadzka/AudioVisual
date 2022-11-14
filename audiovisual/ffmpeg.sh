#!/bin/bash
#FFmpeg link -> https://ffmpeg.org/
format=$(jq -r '.[0.].format' config.json)
filename=$(jq -r '.[0.].filename' config.json)
name=$(echo ${filename%.*})
telegram_token=$(jq -r '.[0.].telegram_token' config.json)
telegram_chat=$(jq -r '.[0.].telegram_chat' config.json)
timeStamp=$(date '+%Y-%m-%d %H:%M:%S')
echo $timeStamp >> audiovisual.txt
echo "Converting $filename to $name.$format" >> audiovisual.txt
if ! ffmpeg -i Convert/$filename -c:v libx264 -preset medium -crf 17 Downloads/$name.$format
    then
    echo "Error: Failed to convert $filename to $name.$format" >> audiovisual.txt
    fi
rm Convert/$filename
rename 's/_/ /g' Downloads/*
curl "https://api.telegram.org/bot$telegram_token/sendMessage?chat_id=$telegram_chat&text=Audiovisual%20Tool:%20Job%20is%20done!"
sed -i -e 's/"job":"running"/"job":"stopped"/g' config.json