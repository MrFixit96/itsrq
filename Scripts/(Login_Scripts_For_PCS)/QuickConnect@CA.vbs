Dim usrname
Dim pword
usrname="PUT_USER_NAME_HERE"
pword = Inputbox("Enter Password","Enter Password")

Set WShell = CreateObject("WScript.Shell")
WShell.Run "net use s: \\pcs-svr01\sshare " & pword & "/user:" & usrname & "@peoriachristian.org"
WShell.Run "net use t: \\pcs-svr01\tshare " & pword & "/user:" & usrname & "@peoriachristian.org"
WShell.Run "net use x: \\pcs-svr01\thomefs$\" & usrname & " " & pword & "/user:" & usrname & "@peoriachristian.org"