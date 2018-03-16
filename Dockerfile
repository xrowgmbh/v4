# Beware! This is a fat container. Why do we do this? Legacy applications aren't designed the microservice way. Use kubernetes for healthiness of the service
# docker build --rm --no-cache -t efa:latest .
# docker kill efa && docker rm efa && docker run --privileged --name efa -v /sys/fs/cgroup:/sys/fs/cgroup:ro -p 8081:8081 -d  efa:latest
# docker kill efa && docker rm efa && docker run --privileged --name efa -v /sys/fs/cgroup:/sys/fs/cgroup:ro -p 8080:8080 -ti efa:latest

FROM centos/systemd:latest

MAINTAINER "Björn Dieding" <bjoern@xrow.de>

ENV container=docker
ENV TERM=dumb
ENV lang en_US

RUN yum -y install wget;\
    mkdir /var/log/eFa;\
    mkdir /usr/src/eFa;\
    /usr/bin/wget -q -O /usr/src/eFa/build.bash -o /var/log/eFa/wget.log https://dl.eFa-project.org/build/4/build.bash ;\
    chmod 700 /usr/src/eFa/build.bash

RUN /usr/src/eFa/build.bash

# RUN systemctl enable ???
# EXPOSE 80 25 443