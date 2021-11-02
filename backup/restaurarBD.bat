@echo off
set /p archivo=Escriba el nombre del backup a restaurar:

C:\xampp\mysql\bin\mysql.exe --user=root ormag_db < C:\xampp\htdocs\backup\%archivo%.sql


exit