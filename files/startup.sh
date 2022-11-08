/opt/lampp/lampp start
/usr/bin/supervisord

sleep 1

/opt/lampp/bin/mysql < /tmp/init.sql

sleep infinity