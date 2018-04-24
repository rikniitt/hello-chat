if [ -z "$WS_URI" ]; then
  WS_URI="localhost:8080"
fi

if [ -z "$1" ]; then
  WS_PATH="/"
else
  WS_PATH="$1"
fi

curl --verbose \
     --include \
     --no-buffer \
     --header "Connection: Upgrade" \
     --header "Upgrade: websocket" \
     --header "Host: $WS_URI" \
     --header "Origin: http://$WS_URI$WS_PATH" \
\ #     --header "Sec-WebSocket-Key: SGVsbG8sIHdvcmxkIQ==" \
     --header "Sec-WebSocket-Version: 13" \
     http://"$WS_URI$WS_PATH"
