#!/bin/bash

DOCKER_NAME="plugserve"

DIR=$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)
DBDIR="$DIR/storage"

COMMAND="sudo docker run"
OPTIONS="--name $DOCKER_NAME -v $DBDIR:/OpenPlugServer/storage/db -p 25222:25222"
REPO="openplug:latest"
