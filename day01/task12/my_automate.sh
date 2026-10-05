#!/bin/bash

task_count=$1
day=$2

day_number=$(printf "%02d" "$day")

mkdir "day$day_number"

for ((i=1; i<=task_count; i++))
do
    task_number=$(printf "%02d" "$i")
    mkdir "day$day_number/task$task_number"
done
