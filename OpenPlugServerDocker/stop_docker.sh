#!/bin/bash

source ./vars.sh
sudo docker stop "$DOCKER_NAME" && sudo docker rm "$DOCKER_NAME"
