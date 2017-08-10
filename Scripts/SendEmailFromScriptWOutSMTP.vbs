Set objEmail = CreateObject("CDO.Message")
objEmail.From = "janderton@peoriachristian.org"
objEmail.To = "janderton@peoriachristian.org"
objEmail.Subject = "Server down"
objEmail.Textbody = "Server1 is no longer accessible over the network."
objEmail.Configuration.Fields.Item _
("http://schemas.microsoft.com/cdo/configuration/sendusing") = 2
objEmail.Configuration.Fields.Item _
("http://schemas.microsoft.com/cdo/configuration/smtpserver") = _
"mail.peoriachristian.org" 
objEmail.Configuration.Fields.Item _
("http://schemas.microsoft.com/cdo/configuration/smtpserverport") = 25
objEmail.Configuration.Fields.Update
objEmail.Send