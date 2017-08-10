net time \\pcs-svr01 /set /yes
echo y | net use * /d

REM Setting Corporate Assigned Drives
net use x: \\172.16.2.1\thomefs$\%username%
net use t: \\172.16.2.1\tshare
net use s: \\172.16.2.1\sshare

net use o: \\172.16.2.1\tshare
net use n: \\172.16.2.1\sshare
pause




