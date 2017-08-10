Dim usrname
Dim pword
Dim position
Dim domain

usrname=Inputbox("Enter User Name","Enter Name")
pword = Inputbox("Enter Password","Enter Password")
position=Inputbox("Are you an Admin, Teacher, or Student? Please select the appropriate number below." & vbcrlf & _
			"1:Admins" & vbcrlf & "2:Teachers" & vbcrlf & "3:Students", "Choose")
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

if position = 1 then
WShell.Run "net use x: \\pcs-svr01\ahomefs$\" & usrname & " " & pword & "/user:" & usrname & "@" & domain
else
	if position = 2 then 
		WShell.Run "net use x: \\pcs-svr01\thomefs$\" & usrname & " " & pword & "/user:" & usrname & _
			"@" & domain
	else
		if position = 3 then
			WShell.Run "net use x: \\pcs-svr01\shomefs$\" & usrname & " " & pword & "/user:" & usrname & _
				"@" & domain
		end if
	end if
end if
