#!/bin/bash

TOMD5=$(date +"%Y_%m_%d_%I_%M_%S_%p_%A")
echo "$TOMD5" | md5sum