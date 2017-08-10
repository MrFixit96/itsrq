Dim usrname
Dim pword
usrname="jcaa"
pword = Inputbox("Enter Password","Enter Password")
domain=Inputbox("What Domain are you logging into?" & "Please select the appropriate number below." & vbcrlf & _
		"1:peoriachristian.org" & vbcrlf & "2:ms.peoriachristian.org")
if domain = 1 then
	domain = "peoriachristian.org"
else
	if domain = 2 then
		domain = "ms.peoriachristian.org"
	end if
end if

Set WShell = CreateObject("WScript.Shell")
WShell.Run "net use s: \\pcs-svr01\sshare " & pword & "/user:" & usrname & "@" & domain
WShell.Run "net use t: \\pcs-svr01\tshare " & pword & "/user:" & usrname & "@" & domain
WShell.Run "net use x: \\pcs-svr01\ahomefs$\" & usrname & " " & pword & "/user:" & usrname & "@" & domain