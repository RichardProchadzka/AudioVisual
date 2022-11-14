#!/bin/bash
#Youtube-dl link -> https://youtube-dl.org/
video=$(jq -r '.[0.].video' config.json)
audio=$(jq -r '.[0.].audio' config.json)
telegram_token=$(jq -r '.[0.].telegram_token' config.json)
telegram_chat=$(jq -r '.[0.].telegram_chat' config.json)
links=$(sed -n '=' youtube-dl.txt | tail -n 1)
i=1
timeStamp=$(date '+%Y-%m-%d %H:%M:%S')
echo $timeStamp >> audiovisual.txt

videoOnly(){
    echo "Downloading video" >> audiovisual.txt
    cat youtube-dl.txt | while read line
    do
    link=$(sed $i'q;d' youtube-dl.txt)
    let "i=i+1"
    format=$(youtube-dl $link --no-playlist -F | grep "video only" | awk '{print $1}' | tail -n 1)
    if ! youtube-dl --no-playlist $link -o 'Downloads/%(title)s.%(ext)s' -f $format  >> audiovisual.txt;
    then
    echo "Failed to download this link: $link. Please try again." >> audiovisual.txt
    fi
    done
}
audioOnly(){
    echo "Downloading audio" >> audiovisual.txt
    cat youtube-dl.txt | while read line 
    do
    link=$(sed $i'q;d' youtube-dl.txt)
    let "i=i+1"
    if ! youtube-dl --no-playlist $link -o 'Downloads/%(title)s.%(ext)s' --extract-audio --audio-format mp3  >> audiovisual.txt;
    then
    echo "Failed to download this link: $link. Please try again." >> audiovisual.txt
    fi
    done
}
audioVideo(){
    echo "Downloading Video & Audio" >> audiovisual.txt
    cat youtube-dl.txt | while read line
    do
    link=$(sed $i'q;d' youtube-dl.txt)
    let "i=i+1"
    if ! youtube-dl --no-playlist $link -o 'Downloads/%(title)s.%(ext)s'  >> audiovisual.txt;
    then
    echo "Failed to download this link: $link. Please try again." >> audiovisual.txt
    fi
    done
}

if [[ $video == "1" && $audio == "0" ]]
then
videoOnly
fi

if [[ $video == "0" && $audio == "1" ]]
then
audioOnly
fi

if [[ $video == "1" && $audio == "1" ]]
then
audioVideo
fi

if [[ $video == "0" && $audio == "0" ]]
then
echo "You set Video to $video & Audio to $audio" >> audiovisual.txt
sleep 1
fi

curl "https://api.telegram.org/bot$telegram_token/sendMessage?chat_id=$telegram_chat&text=Audiovisual%20Tool:%20Job%20is%20done!"
sed -i -e 's/"job":"running"/"job":"stopped"/g' config.json