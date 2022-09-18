#!/bin/sh
filename=$(pwd)
parentdir=$(dirname "${filename}/..")

if ! [ -x "$(command -v setfacl)" ]; then
  echo 'Error: setfacl is not installed.' >&2
  exit 1
fi

HTTPDUSER=$(ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1)
sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX ${parentdir}/var
sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX ${parentdir}/var

