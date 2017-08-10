net time \\pcs-svr01 /set /yes

rem net use x: /home

net use i: \\pcs-svr01\ashare
net use t: \\pcs-svr01\tshare
net use s: \\pcs-svr01\sshare
net use f: \\pcs-svr01\hunter$

net use m: \\pcs-svr21\ashare
net use o: \\pcs-svr21\tshare
net use n: \\pcs-svr21\sshare

rem net use lpt3: \\pcs-svr01\busoff-bw1
rem net use lpt4: \\pcs-svr01\HSoff-bw1
rem net use lpt5: \\pcs-svr01\busoff-bw1
rem net use lpt6: \\pcs-svr01\HSoff-bw1

pause



