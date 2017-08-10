net time \\pcs-svr01 /set /yes
echo y | net use * /d


REM Setting Personal drive preferences
net use u: \\172.16.2.1\shomefs$  /user:jcaa@pcs.local
net use v: \\172.16.8.10\c$	/user:jcaa@pcs.local
net use w: \\172.16.8.10\d$	/user:jcaa@pcs.local
REM net use y: \\pcs31312\c$	/user:jcaa@pcs.local
REM net use z: \\pcs31312\d$	/user:jcaa@pcs.local

REM Setting Corporate Assigned Drives
net use x: \\172.16.2.1\ahomefs$\%username% 	/user:jcaa@pcs.local
net use t: \\172.16.2.1\tshare	 /user:jcaa@pcs.local
net use s: \\172.16.2.1\sshare	 /user:jcaa@pcs.local
net use i: \\172.16.2.1\ashare	 /user:jcaa@pcs.local
net use f: \\172.16.2.1\hunter$	 /user:jcaa@pcs.local
pause




