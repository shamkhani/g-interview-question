#!/bin/bash

TIMEOUT=2
HOST=$DB_HOST
PORT=$DB_PORT
CHILD=$1

wait_for_host()
{
    if [[ $TIMEOUT -gt 0 ]]; then
         echo "waiting $TIMEOUT seconds for $HOST:$PORT"
    else
        echo "waiting for $HOST:$PORT without a timeout"
    fi
    start_ts=$(date +%s)
    while :
    do
        (echo > /dev/tcp/$HOST/$PORT) >/dev/null 2>&1
        result=$?

        if [[ $result -eq 0 ]]; then
            end_ts=$(date +%s)
            echo "$HOST:$PORT is available after $((end_ts - start_ts)) seconds"
            break
        fi
        sleep 1
    done
    return $result
}


if [[ CHILD -eq 1 ]]; then
    wait_for_host
    RESULT=$?
    exit $RESULT
else
    if [[ $TIMEOUT -gt 0 ]]; then
        timeout $TIMEOUT $0 1
        RESULT=$?
    else
        wait_for_host
        RESULT=$?
    fi
fi

if [[ $RESULT -ne 0 ]]; then
    echo "connecting to host FILAED!"
    exit $RESULT
fi

echo "executing command"

exec "$@"