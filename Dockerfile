# Beware! This is a fat container. Why do we do this? Legacy Applications are not designed the microservice way.
# docker build --rm --no-cache -t efa .
# docker kill efa && docker rm efa && docker run --privileged --name efa -v /sys/fs/cgroup:/sys/fs/cgroup:ro -p 8081:8081 -d  efa:latest
# docker kill efa && docker rm efa && docker run --privileged --name efa -v /sys/fs/cgroup:/sys/fs/cgroup:ro -p 8080:8080 -ti efa:latest

FROM centos/systemd:latest

MAINTAINER "Björn Dieding" <bjoern@xrow.de>

ENV container=docker
ENV TERM=dumb


# Fix for rename Overlay Issue
RUN yum clean all;
RUN yum -y update; yum clean all;

ADD build /build/
RUN bash /build/build.bash
# RUN systemctl enable ???
EXPOSE 80 25 443