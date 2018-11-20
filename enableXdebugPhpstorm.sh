#|/bun/sh

#Enable docker <-> PHPStorm debug inside container https://github.com/docker/for-mac/issues/770
docker run -d -v /var/run/docker.sock:/var/run/docker.sock -p 127.0.0.1:2375:2375 bobrik/socat TCP-LISTEN:2375,fork UNIX-CONNECT:/var/run/docker.sock
export DOCKER_HOST=tcp://localhost:2375
