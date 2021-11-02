echo off
C:\xampp\mysql\bin\mysqldump.exe -hlocalhost -uroot ormag_db > copia_seguridad_%Date:~6,4%%Date:~3,2%%Date:~0,2%.sql
exit