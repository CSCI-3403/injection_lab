FROM tomsik68/xampp

ADD ./files/part4.txt /part4.txt
ADD ./files/startup.sh /startup.sh
ADD ./files/init.sql /tmp/init.sql

RUN chmod 666 /part4.txt

EXPOSE 22
EXPOSE 80