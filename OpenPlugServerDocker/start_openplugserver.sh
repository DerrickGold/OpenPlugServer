#!/bin/bash

source ./vars.sh

setfacl -d -m u::rwx,g::rwx,o::rwx "$DBDIR"


case "$1" in
    "shell")
	echo "Starting shell..."
	eval "$COMMAND -ti $OPTIONS $REPO /bin/bash"
	;;
    
    *) eval "$COMMAND -d $OPTIONS $REPO"
       ;;
esac


