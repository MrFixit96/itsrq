Dim usrname
Dim pword
Dim domain
Dim wShell

Set WShell = CreateObject("WScript.Shell")
WShell.Run ("net use * /d")

usrname = Inputbox("Enter Username","Enter Username")
pword = Inputbox("Enter Password","Enter Password")
domain = Inputbox("What Domain are you logging into?" & "Please select the appropriate number below." & vbcrlf & _
		"1:pcs.local" & vbcrlf & "2:ms.peoriachristian.org")
if domain = "1" then
	domain = "pcs.local"
else
	if domain = "2" then
		domain = "ms.peoriachristian.org"
	end if
end if


WShell.Run ("net use s: \\pcs-svr32\sshare " & pword & " /user:" & usrname & "@" & domain)
WShell.Run ("net use t: \\pcs-svr32\tshare " & pword & " /user:" & usrname & "@" & domain)
WShell.Run ("net use x: \\pcs-svr32\thomefs$\" & usrname & " " & pword & " /user:" & usrname & "@" & domain)